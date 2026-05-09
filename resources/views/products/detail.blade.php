@extends('layouts.app')

@section('title', 'ATELIER — ' . $product->name)

@section('content')
<section class="max-w-[1920px] mx-auto px-8 md:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 items-start pt-8 pb-24">
    {{-- Left: Images --}}
    <div class="lg:col-span-7 flex flex-col gap-12" data-animate>
        <div class="bg-surface-variant aspect-[3/4] overflow-hidden group">
            <img alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ $product->image }}"/>
        </div>
        @if($product->image2 || $product->image3)
        <div class="grid grid-cols-2 gap-8">
            @if($product->image2)
            <div class="bg-surface-variant aspect-square overflow-hidden">
                <img alt="{{ $product->name }} detail" class="w-full h-full object-cover" src="{{ $product->image2 }}"/>
            </div>
            @endif
            @if($product->image3)
            <div class="bg-surface-variant aspect-[3/4] mt-12 overflow-hidden">
                <img alt="{{ $product->name }} runway" class="w-full h-full object-cover" src="{{ $product->image3 }}"/>
            </div>
            @endif
        </div>
        @endif
    </div>

    {{-- Right: Product Info --}}
    <div class="lg:col-span-5 lg:sticky lg:top-40 space-y-12" data-animate>
        <div class="space-y-4">
            <p class="font-body text-xs uppercase tracking-[0.3em] text-outline">
                {{ $product->category->name ?? 'Collection' }}
            </p>
            <h1 class="text-5xl lg:text-7xl font-headline tracking-tight text-on-background leading-tight">{{ $product->name }}</h1>
            <p class="text-xl font-body font-light text-secondary">${{ number_format($product->price, 2) }}</p>
        </div>
        <div class="space-y-6">
            <p class="text-on-surface-variant leading-relaxed text-lg max-w-lg">
                {{ $product->description }}
            </p>
            <details class="group border-none">
                <summary class="flex justify-between items-center cursor-pointer list-none py-4 border-b border-outline-variant/30">
                    <span class="font-body text-sm uppercase tracking-widest">Details &amp; Composition</span>
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <div class="py-4 text-sm text-on-surface-variant space-y-2 font-body font-light">
                    <p>• Color: {{ $product->color }}</p>
                    <p>• Stock: {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ')' : 'Out of Stock' }}</p>
                    <p>• Category: {{ $product->category->name ?? 'N/A' }}</p>
                </div>
            </details>
        </div>

        {{-- Size Selection --}}
        @if($product->size_options && count($product->size_options) > 0)
        <div class="space-y-6">
            <div class="flex justify-between items-end">
                <label class="font-body text-xs uppercase tracking-widest text-on-surface">Select Size</label>
                <button class="text-[10px] uppercase tracking-widest text-outline border-b border-outline-variant/50 hover:text-primary transition-colors">Size Guide</button>
            </div>
            <div class="flex flex-wrap gap-3" id="size-selector">
                @foreach($product->size_options as $index => $size)
                <button type="button" data-size="{{ $size }}" class="size-btn w-14 h-14 flex items-center justify-center border {{ $index === 0 ? 'border-primary bg-primary text-on-primary selected' : 'border-outline-variant/30 hover:border-primary' }} text-sm font-light transition-all">{{ $size }}</button>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Actions --}}
        <div class="flex flex-col gap-4 pt-4">
            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" id="selected-size" value="{{ $product->size_options[0] ?? '' }}">
                <input type="hidden" name="color" value="{{ $product->color }}">
                
                <div class="flex items-center justify-between mb-6">
                    <label class="font-body text-xs uppercase tracking-widest text-on-surface">Số lượng</label>
                    <div class="flex items-center border border-outline-variant/30 h-12 w-32">
                        <button type="button" class="w-10 h-full flex items-center justify-center text-outline hover:text-primary transition-colors" onclick="this.nextElementSibling.stepDown()">
                            <span class="material-symbols-outlined text-sm">remove</span>
                        </button>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock > 0 ? $product->stock : 1 }}" class="w-12 h-full bg-transparent text-center font-body text-sm outline-none" style="-moz-appearance: textfield; -webkit-appearance: none; margin: 0;">
                        <button type="button" class="w-10 h-full flex items-center justify-center text-outline hover:text-primary transition-colors" onclick="this.previousElementSibling.stepUp()">
                            <span class="material-symbols-outlined text-sm">add</span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-on-primary py-6 text-sm uppercase tracking-[0.2em] font-medium hover:bg-primary-dim transition-all shadow-xl shadow-primary/10 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    {{ $product->stock > 0 ? 'Add to Bag' : 'Out of Stock' }}
                </button>
            </form>
            <button class="w-full bg-surface-container-low text-on-background py-6 text-sm uppercase tracking-[0.2em] font-medium hover:bg-surface-container-high transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">favorite</span> Wishlist
            </button>
        </div>
    </div>
</section>

{{-- You May Also Like --}}
@if($relatedProducts->isNotEmpty())
<section class="pb-24 max-w-[1920px] mx-auto px-8 md:px-12">
    <div class="flex flex-col md:flex-row justify-between items-baseline mb-16 gap-4" data-animate>
        <h2 class="text-3xl md:text-4xl font-headline tracking-tight">You May Also Like</h2>
        <a class="font-body text-xs uppercase tracking-widest text-outline hover:text-primary border-b border-outline-variant/30 pb-1" href="{{ route('products.catalog') }}">View Collection</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($relatedProducts as $item)
        <a href="{{ route('products.detail', $item->slug) }}" class="group cursor-pointer" data-animate>
            <div class="bg-surface-container-low aspect-[3/4] mb-6 overflow-hidden relative">
                <img alt="{{ $item->name }}" class="w-full h-full object-cover grayscale-[0.3] group-hover:grayscale-0 transition-all duration-700" src="{{ $item->image }}"/>
            </div>
            <div class="space-y-1">
                <h3 class="font-body text-sm uppercase tracking-widest text-on-background">{{ $item->name }}</h3>
                <p class="font-body text-sm text-outline">${{ number_format($item->price, 0) }}</p>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sizeSelector = document.getElementById('size-selector');
    if (sizeSelector) {
        sizeSelector.addEventListener('click', function(e) {
            const btn = e.target.closest('.size-btn');
            if (!btn) return;
            // Remove selected from all
            sizeSelector.querySelectorAll('.size-btn').forEach(b => {
                b.classList.remove('border-primary', 'bg-primary', 'text-on-primary', 'selected');
                b.classList.add('border-outline-variant/30');
            });
            // Add selected to clicked
            btn.classList.add('border-primary', 'bg-primary', 'text-on-primary', 'selected');
            btn.classList.remove('border-outline-variant/30');
            // Update hidden field
            document.getElementById('selected-size').value = btn.dataset.size;
        });
    }
});
</script>
@endsection
