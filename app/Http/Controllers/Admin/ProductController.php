<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->authorizeResource(Product::class, 'product');
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();

        if (request()->expectsJson()) {
            return ProductResource::collection($products);
        }

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct(
            $request->validated(),
            $request->hasFile('image') ? $request->file('image') : null
        );

        if ($request->expectsJson()) {
            return new ProductResource($product);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        if (request()->expectsJson()) {
            return new ProductResource($product);
        }

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $updated = $this->productService->updateProduct(
            $product,
            $request->validated(),
            $request->hasFile('image') ? $request->file('image') : null
        );

        if ($request->expectsJson()) {
            return $updated
                ? new ProductResource($product)
                : response()->json(['message' => 'Failed to update product'], 500);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $deleted = $this->productService->deleteProduct($product);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => $deleted ? 'Product deleted successfully' : 'Failed to delete product'
            ], $deleted ? 200 : 500);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
