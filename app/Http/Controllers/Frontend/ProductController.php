<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        
        if (request()->expectsJson()) {
            return ProductResource::collection($products);
        }
        
        return view('frontend.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product = $this->productService->getProduct($product->id);
        
        if (request()->expectsJson()) {
            return new ProductResource($product);
        }
        
        return view('frontend.products.show', compact('product'));
    }
}
