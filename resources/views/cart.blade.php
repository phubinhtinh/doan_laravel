@extends('layouts.app')

@section('title', 'ATELIER — Your Selection')

@section('content')
<div class="pb-24 px-8 max-w-[1920px] mx-auto min-h-screen">
    <div class="mb-20 pt-8" data-animate>
        <h1 class="text-6xl md:text-8xl tracking-tight leading-none mb-4 font-light italic font-headline">Your Selection</h1>
        <p class="font-body text-secondary text-sm uppercase tracking-[0.3em]">The digital atelier / spring-summer 24</p>
    </div>

    @if($cartItems->isEmpty())
    <div class="text-center py-24" data-animate>
        <span class="material-symbols-outlined text-6xl text-outline-variant mb-8">shopping_bag</span>
        <p class="font-headline text-2xl text-secondary mb-4">Giỏ hàng của bạn đang trống</p>
        <p class="font-body text-secondary text-sm mb-8">Khám phá bộ sưu tập của chúng tôi và tìm kiếm những món đồ yêu thích.</p>
        <a href="{{ route('products.catalog') }}" class="inline-block bg-primary text-on-primary px-12 py-5 font-label text-sm uppercase tracking-[0.2em] hover:bg-primary-dim transition-colors duration-500">Explore Collections</a>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
        {{-- Cart Items --}}
        <div class="lg:col-span-8 space-y-12">
            @foreach($cartItems as $index => $item)
            <div class="flex flex-col md:flex-row {{ $index % 2 === 0 ? '' : 'md:flex-row-reverse' }} gap-8 {{ $index % 2 === 0 ? 'bg-surface-container-low' : 'bg-surface-container' }} p-8 relative group" data-animate>
                <div class="w-full md:w-64 h-80 bg-surface-variant overflow-hidden">
                    <img alt="{{ $item->product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $item->product->image }}"/>
                </div>
                <div class="flex-1 flex flex-col justify-between py-2">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-3xl font-light tracking-tight text-on-surface font-headline">{{ $item->product->name }}</h2>
                            <span class="text-2xl font-light font-headline">${{ number_format($item->product->price, 2) }}</span>
                        </div>
                        <p class="text-on-surface-variant font-light text-sm max-w-md leading-relaxed mb-6">{{ Str::limit($item->product->description, 100) }}</p>
                        <div class="flex gap-8 text-[11px] uppercase tracking-widest text-secondary font-medium">
                            @if($item->size)<div>Size: {{ $item->size }}</div>@endif
                            @if($item->color)<div>Color: {{ $item->color }}</div>@endif
                        </div>
                    </div>
                    <div class="flex justify-between items-end mt-8">
                        <div class="qty-control flex items-center gap-6 border-b border-outline-variant/30 pb-2">
                            <form method="POST" action="{{ route('cart.update') }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                <button type="submit" class="text-secondary hover:text-on-surface transition-colors"><span class="material-symbols-outlined text-sm">remove</span></button>
                            </form>
                            <span class="font-body text-sm font-medium w-4 text-center">{{ str_pad($item->quantity, 2, '0', STR_PAD_LEFT) }}</span>
                            <form method="POST" action="{{ route('cart.update') }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                <button type="submit" class="text-secondary hover:text-on-surface transition-colors"><span class="material-symbols-outlined text-sm">add</span></button>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('cart.remove') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                            <button type="submit" class="text-secondary hover:text-error transition-colors uppercase text-[10px] tracking-[0.2em]">Remove from bag</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Order Summary --}}
        <aside class="lg:col-span-4 sticky top-32" data-animate>
            <div class="bg-surface-container-high p-10 space-y-10">
                <div class="space-y-6">
                    <h3 class="text-2xl font-light tracking-tight font-headline border-b border-outline-variant/20 pb-4">Order Summary</h3>
                    <div class="space-y-4 font-body text-sm">
                        <div class="flex justify-between text-on-surface-variant"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
                        <div class="flex justify-between text-on-surface-variant"><span>Shipping {{ $shipping == 0 ? '(Free)' : '(Express)' }}</span><span>${{ number_format($shipping, 2) }}</span></div>
                        <div class="flex justify-between text-on-surface-variant"><span>Taxes (Estimated)</span><span>${{ number_format($tax, 2) }}</span></div>
                        <div class="pt-6 flex justify-between text-xl font-medium text-on-surface">
                            <span class="font-headline">Total</span><span class="font-headline">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <a href="{{ route('checkout') }}" class="block w-full bg-primary text-on-primary py-5 text-[11px] uppercase tracking-[0.3em] font-medium hover:bg-primary-dim transition-all duration-300 text-center">Proceed to Checkout</a>
                    <p class="text-[10px] text-on-surface-variant text-center uppercase tracking-widest leading-relaxed px-4">Complimentary carbon-neutral shipping on orders over $1,500.</p>
                </div>
                <div class="pt-10 border-t border-outline-variant/20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="material-symbols-outlined text-secondary">lock</span>
                        <span class="text-[10px] uppercase tracking-widest text-secondary">Secure Checkout Guaranteed</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    @endif
</div>
@endsection
