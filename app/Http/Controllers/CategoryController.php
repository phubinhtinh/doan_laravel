<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()->paginate(12);
        $categories = Category::withCount('products')->get();

        return view('products.catalog', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
            'totalProducts' => $category->products()->count(),
        ]);
    }
}
