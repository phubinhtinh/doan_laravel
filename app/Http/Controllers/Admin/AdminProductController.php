<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $categories = Category::all();
        $totalProducts = Product::count();

        return view('admin.products.index', compact('products', 'categories', 'totalProducts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url',
            'image2' => 'nullable|url',
            'image3' => 'nullable|url',
            'color' => 'nullable|string|max:100',
            'size_options' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);
        $validated['is_featured'] = $request->boolean('is_featured');

        // Convert size_options string to array
        if (!empty($validated['size_options'])) {
            $validated['size_options'] = array_map('trim', explode(',', $validated['size_options']));
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url',
            'image2' => 'nullable|url',
            'image3' => 'nullable|url',
            'color' => 'nullable|string|max:100',
            'size_options' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        // Convert size_options string to array
        if (!empty($validated['size_options'])) {
            $validated['size_options'] = array_map('trim', explode(',', $validated['size_options']));
        } else {
            $validated['size_options'] = null;
        }

        // Only regenerate slug if name changed
        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
