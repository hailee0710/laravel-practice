<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('frontend.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('frontend.categories.show', compact('category'));
    }
}
