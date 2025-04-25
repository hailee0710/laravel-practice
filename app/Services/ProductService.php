<?php

namespace App\Services;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductService
{
    private const CACHE_TTL = 3600; // 1 hour
    private const CACHE_KEY_ALL = 'all';
    private const CACHE_KEY_PRODUCT = 'product.';

    public function getAllProducts(): Collection
    {
        return Cache::tags(['products'])->remember(self::CACHE_KEY_ALL, self::CACHE_TTL, function () {
            Log::info('Fetching all products from database');
            return Product::with('category')->get();
        });
    }

    public function getProduct(int $id): ?Product
    {
        return Cache::tags(['products'])->remember(self::CACHE_KEY_PRODUCT . $id, self::CACHE_TTL, function () use ($id) {
            Log::info('Fetching product from database', ['product_id' => $id]);
            return Product::with('category')->find($id);
        });
    }

    public function createProduct(array $data, ?UploadedFile $image = null): Product
    {
        if ($image) {
            $data['image'] = $this->handleImageUpload($image);
        }

        $product = Product::create($data);

        Log::info('Product created successfully', [
            'product_id' => $product->id,
            'product_name' => $product->name
        ]);

        $this->clearCache();

        return $product;
    }

    public function updateProduct(Product $product, array $data, ?UploadedFile $image = null): bool
    {
        if ($image) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $data['image'] = $this->handleImageUpload($image);
        }

        $updated = $product->update($data);

        if ($updated) {
            Log::info('Product updated successfully', [
                'product_id' => $product->id,
                'product_name' => $product->name
            ]);

            $this->clearCache();
        } else {
            Log::error('Failed to update product', [
                'product_id' => $product->id,
                'product_name' => $product->name
            ]);
        }

        return $updated;
    }

    public function deleteProduct(Product $product): bool
    {
        if ($product->image) {
            Storage::delete($product->image);
        }

        $deleted = $product->delete();

        if ($deleted) {
            Log::info('Product deleted successfully', [
                'product_id' => $product->id,
                'product_name' => $product->name
            ]);

            $this->clearCache();
        } else {
            Log::error('Failed to delete product', [
                'product_id' => $product->id,
                'product_name' => $product->name
            ]);
        }

        return $deleted;
    }

    private function handleImageUpload(UploadedFile $image): string
    {
        $path = $image->store('products', 'public');
        Log::info('Product image uploaded successfully', ['path' => $path]);
        return $path;
    }

    private function clearCache(): void
    {
        Cache::tags(['products'])->flush();
        Log::info('Product cache cleared');
    }
}
