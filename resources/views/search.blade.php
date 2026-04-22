@extends('layouts.app')

@section('title', 'ATELIER — Search')

@section('content')
<div class="pb-32">
    {{-- Search Header --}}
    <section class="px-6 md:px-12 max-w-screen-2xl mx-auto mb-24 pt-8" data-animate>
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto">
            <form method="GET" action="{{ route('search') }}" class="w-full relative group">
                <input name="q" class="w-full bg-transparent border-none focus:ring-0 text-center font-headline italic text-4xl md:text-6xl text-on-surface placeholder-outline-variant pb-6 outline-none border-b border-outline-variant/30" placeholder="Search our archive..." type="text" value="{{ $query }}"/>
                <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-3 text-outline hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-2xl">search</span>
                </button>
            </form>
            @if(!empty($query))
            <p class="mt-8 font-label text-[11px] uppercase tracking-[0.2em] text-secondary">Showing {{ $totalResults }} results for '{{ $query }}'</p>
            @else
            <p class="mt-8 font-label text-[11px] uppercase tracking-[0.2em] text-secondary">Enter a keyword to search</p>
            @endif
        </div>
    </section>

    @if(!empty($query))
    {{-- Results Grid --}}
    <section class="px-6 md:px-12 max-w-screen-2xl mx-auto">
        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->isEmpty())
        <div class="text-center py-24">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-8">search_off</span>
            <p class="font-headline text-2xl text-secondary mb-4">Không tìm thấy kết quả</p>
            <p class="font-body text-secondary text-sm">Thử tìm kiếm với từ khóa khác.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-24 items-start">
            @foreach($products as $i => $product)
            <a href="{{ route('products.detail', $product->slug) }}" class="flex flex-col group cursor-pointer {{ $i === 1 ? 'md:mt-16 lg:mt-32' : ($i === 2 ? 'lg:mt-12' : '') }}" data-animate>
                <div class="relative w-full aspect-[3/4] bg-surface-variant overflow-hidden mb-6">
                    <img class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-1000 ease-out" src="{{ $product->image }}" alt="{{ $product->name }}"/>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500"></div>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex flex-col gap-1">
                        <h2 class="font-body text-sm font-medium text-on-surface">{{ $product->name }}</h2>
                        <span class="font-label text-xs text-secondary">{{ $product->color }}</span>
                    </div>
                    <span class="font-body text-sm text-on-surface">${{ number_format($product->price, 0) }}</span>
                </div>
            </a>
            @endforeach
        </div>

        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
        <div class="mt-32 flex justify-center">
            {{ $products->appends(['q' => $query])->links() }}
        </div>
        @endif
        @endif
    </section>
    @endif
</div>
@endsection
