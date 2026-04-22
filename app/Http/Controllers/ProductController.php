<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function catalog(Request $request)
    {
        $query = Product::with('category');

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by color
        if ($request->filled('color')) {
            $query->where('color', 'like', '%' . $request->color . '%');
        }

        // Filter by size
        if ($request->filled('size')) {
            $query->whereJsonContains('size_options', $request->size);
        }

        // Sort
        $sort = $request->get('sort', 'featured');
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            default: // featured
                $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();
        $totalProducts = Product::count();

        return view('products.catalog', compact('products', 'categories', 'totalProducts'));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.detail', compact('product', 'relatedProducts'));
    }
}
