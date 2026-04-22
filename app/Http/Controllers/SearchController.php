<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $products = collect();
        $totalResults = 0;

        if (!empty($query)) {
            $products = Product::with('category')
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('color', 'like', '%' . $query . '%')
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->paginate(12);

            $totalResults = $products->total();
        }

        return view('search', compact('products', 'query', 'totalResults'));
    }
}
