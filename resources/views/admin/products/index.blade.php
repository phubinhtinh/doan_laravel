@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm | Admin ATELIER')
@section('page-title', 'Sản phẩm')
@section('breadcrumb', 'Admin / Sản phẩm')

@section('actions')
    <a href="{{ route('admin.products.create') }}" class="admin-btn admin-btn-primary">
        <span class="material-symbols-outlined">add</span>
        Thêm sản phẩm
    </a>
@endsection

@section('content')
    {{-- Stats Cards --}}
    <div class="admin-stats">
        <div class="admin-stat-card">
            <div class="admin-stat-icon" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                <span class="material-symbols-outlined">inventory_2</span>
            </div>
            <div>
                <span class="admin-stat-value">{{ $totalProducts }}</span>
                <span class="admin-stat-label">Tổng sản phẩm</span>
            </div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                <span class="material-symbols-outlined">star</span>
            </div>
            <div>
                <span class="admin-stat-value">{{ $products->where('is_featured', true)->count() }}</span>
                <span class="admin-stat-label">Nổi bật</span>
            </div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                <span class="material-symbols-outlined">category</span>
            </div>
            <div>
                <span class="admin-stat-value">{{ $categories->count() }}</span>
                <span class="admin-stat-label">Danh mục</span>
            </div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                <span class="material-symbols-outlined">warning</span>
            </div>
            <div>
                <span class="admin-stat-value">{{ \App\Models\Product::where('stock', '<=', 5)->count() }}</span>
                <span class="admin-stat-label">Sắp hết hàng</span>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <form method="GET" action="{{ route('admin.products.index') }}" class="admin-filters">
            <div class="admin-search-box">
                <span class="material-symbols-outlined">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm..." class="admin-search-input"/>
            </div>
            <select name="category" class="admin-select">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="admin-btn admin-btn-secondary">
                <span class="material-symbols-outlined">filter_list</span>
                Lọc
            </button>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn-ghost">
                    <span class="material-symbols-outlined">close</span>
                    Xóa bộ lọc
                </a>
            @endif
        </form>

        {{-- Products Table --}}
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Kho</th>
                        <th>Nổi bật</th>
                        <th style="width: 120px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="admin-table-img">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}"/>
                            </div>
                        </td>
                        <td>
                            <div class="admin-product-name">{{ $product->name }}</div>
                            <div class="admin-product-slug">{{ $product->slug }}</div>
                        </td>
                        <td>
                            <span class="admin-badge">{{ $product->category->name ?? '—' }}</span>
                        </td>
                        <td>
                            <span class="admin-price">${{ number_format($product->price, 2) }}</span>
                        </td>
                        <td>
                            <span class="admin-stock {{ $product->stock <= 5 ? 'admin-stock-low' : 'admin-stock-ok' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            @if($product->is_featured)
                                <span class="admin-featured-badge">
                                    <span class="material-symbols-outlined">star</span>
                                </span>
                            @else
                                <span class="admin-not-featured">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="admin-actions">
                                <a href="{{ route('admin.products.edit', $product) }}" class="admin-action-btn admin-action-edit" title="Chỉnh sửa">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action-btn admin-action-delete" title="Xóa">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="admin-table-empty">
                            <span class="material-symbols-outlined" style="font-size: 48px; opacity: 0.3;">inventory_2</span>
                            <p>Không tìm thấy sản phẩm nào.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="admin-pagination">
            {{ $products->links() }}
        </div>
        @endif
    </div>
@endsection
