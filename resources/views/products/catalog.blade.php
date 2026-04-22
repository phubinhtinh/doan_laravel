@extends('layouts.app')

@section('title', isset($currentCategory) ? 'ATELIER — ' . $currentCategory->name : 'ATELIER — Collections')
@section('description', 'Explore the ATELIER collections. La Nouvelle Silhouette — Spring/Summer 2024.')

@section('content')
<div class="pb-24 px-8 max-w-[1920px] mx-auto">
    {{-- Header --}}
    <header class="mb-16 pt-8" data-animate>
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-2xl">
                <p class="font-label text-xs tracking-[0.3em] uppercase text-secondary mb-4">Spring / Summer 2024</p>
                <h1 class="font-headline text-5xl md:text-7xl font-light tracking-tight text-on-background leading-tight">
                    {{ isset($currentCategory) ? $currentCategory->name : 'La Nouvelle Silhouette' }}
                </h1>
            </div>
            <div class="flex items-center gap-12 border-b border-outline-variant/30 pb-4">
                <div class="flex items-center gap-2">
                    <span class="font-label text-[11px] uppercase tracking-widest text-secondary">Sort by:</span>
                    <form method="GET" action="{{ isset($currentCategory) ? route('category.show', $currentCategory->slug) : route('products.catalog') }}" id="sort-form">
                        <select name="sort" class="bg-transparent border-none font-label text-[11px] uppercase tracking-widest focus:ring-0 cursor-pointer p-0 pr-6" onchange="document.getElementById('sort-form').submit()">
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High-Low</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low-High</option>
                        </select>
                    </form>
                </div>
                <div class="font-label text-[11px] uppercase tracking-widest text-secondary">Showing {{ $products->total() }} items</div>
            </div>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row gap-16">
        {{-- Sidebar Filters --}}
        <aside class="w-full lg:w-64 flex-shrink-0 space-y-12" data-animate>
            <section>
                <h3 class="font-headline text-lg mb-6">Categories</h3>
                <ul class="space-y-4">
                    @foreach($categories as $category)
                    <li>
                        <a class="font-label text-sm {{ (isset($currentCategory) && $currentCategory->id === $category->id) || request('category') === $category->slug ? 'text-primary font-medium flex items-center justify-between' : 'text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('category.show', $category->slug) }}">
                            {{ $category->name }}
                            @if((isset($currentCategory) && $currentCategory->id === $category->id) || request('category') === $category->slug)
                            <span class="w-1 h-1 bg-primary rounded-full"></span>
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
            </section>
            <section>
                <h3 class="font-headline text-lg mb-6">Size</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                    <a href="{{ request()->fullUrlWithQuery(['size' => $size]) }}" class="px-4 py-2 border {{ request('size') === $size ? 'border-primary bg-primary text-on-primary' : 'border-outline-variant/30 hover:border-primary' }} text-[10px] uppercase tracking-widest transition-colors">{{ $size }}</a>
                    @endforeach
                </div>
            </section>
            <a href="{{ route('products.catalog') }}" class="font-label text-[10px] uppercase tracking-[0.2em] text-secondary border-b border-secondary/30 pb-1 hover:text-primary hover:border-primary transition-colors inline-block">Clear All Filters</a>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-1">
            @if($products->isEmpty())
            <div class="text-center py-24">
                <p class="font-headline text-2xl text-secondary">Không tìm thấy sản phẩm nào.</p>
                <a href="{{ route('products.catalog') }}" class="inline-block mt-6 font-label text-sm uppercase tracking-widest text-primary border-b border-primary pb-1">Xem tất cả sản phẩm</a>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-8 gap-y-16">
                @foreach($products as $product)
                <a href="{{ route('products.detail', $product->slug) }}" class="group cursor-pointer" data-animate>
                    <div class="relative aspect-[3/4] bg-surface-container overflow-hidden mb-6">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $product->image }}" alt="{{ $product->name }}"/>
                        <div class="absolute top-4 right-4"><span class="material-symbols-outlined text-white/80 hover:text-white transition-colors">favorite</span></div>
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-headline text-xl mb-1 group-hover:opacity-70 transition-opacity">{{ $product->name }}</h4>
                            <p class="font-label text-xs uppercase tracking-widest text-on-surface-variant">{{ $product->color }}</p>
                        </div>
                        <span class="font-label text-sm text-primary">${{ number_format($product->price, 0) }}</span>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
            <nav class="mt-24 flex items-center justify-center">
                {{ $products->links() }}
            </nav>
            @endif
            @endif
        </div>
    </div>
</div>
@endsection
