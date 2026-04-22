@extends('layouts.app')

@section('title', 'ATELIER — Checkout')

@section('content')
<div class="pb-32 px-6 md:px-12 max-w-screen-2xl mx-auto min-h-screen flex flex-col lg:flex-row gap-16 lg:gap-32 pt-8">
    <section class="w-full lg:w-3/5 flex flex-col gap-16" data-animate>
        <div>
            <h1 class="font-headline text-4xl lg:text-5xl text-primary mb-12 tracking-tight">Checkout</h1>
            <form method="POST" action="{{ route('checkout.placeOrder') }}" id="checkout-form">
                @csrf
                <div class="space-y-12">
                    {{-- Contact Info --}}
                    <div class="space-y-6">
                        <h2 class="font-headline text-2xl text-secondary">Contact Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="relative">
                                <input class="peer w-full bg-transparent border-0 border-b border-outline-variant/30 text-on-surface py-3 px-0 focus:ring-0 focus:border-primary transition-colors placeholder-transparent" id="email" name="email" placeholder="Email" type="email" required value="{{ old('email', auth()->user()->email ?? '') }}"/>
                                <label class="absolute left-0 -top-3.5 text-xs font-label text-secondary transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs" for="email">Email Address</label>
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative">
                                <input class="peer w-full bg-transparent border-0 border-b border-outline-variant/30 text-on-surface py-3 px-0 focus:ring-0 focus:border-primary transition-colors placeholder-transparent" id="phone" name="phone" placeholder="Phone" type="tel" value="{{ old('phone') }}"/>
                                <label class="absolute left-0 -top-3.5 text-xs font-label text-secondary transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs" for="phone">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    {{-- Shipping --}}
                    <div class="space-y-6">
                        <h2 class="font-headline text-2xl text-secondary">Shipping Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="relative md:col-span-2">
                                <input class="peer w-full bg-transparent border-0 border-b border-outline-variant/30 text-on-surface py-3 px-0 focus:ring-0 focus:border-primary transition-colors placeholder-transparent" id="name" name="name" placeholder="Name" type="text" required value="{{ old('name', auth()->user()->name ?? '') }}"/>
                                <label class="absolute left-0 -top-3.5 text-xs font-label text-secondary transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs" for="name">Full Name</label>
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative md:col-span-2">
                                <input class="peer w-full bg-transparent border-0 border-b border-outline-variant/30 text-on-surface py-3 px-0 focus:ring-0 focus:border-primary transition-colors placeholder-transparent" id="address" name="address" placeholder="Address" type="text" required value="{{ old('address') }}"/>
                                <label class="absolute left-0 -top-3.5 text-xs font-label text-secondary transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs" for="address">Address</label>
                                @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative">
                                <input class="peer w-full bg-transparent border-0 border-b border-outline-variant/30 text-on-surface py-3 px-0 focus:ring-0 focus:border-primary transition-colors placeholder-transparent" id="city" name="city" placeholder="City" type="text" required value="{{ old('city') }}"/>
                                <label class="absolute left-0 -top-3.5 text-xs font-label text-secondary transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs" for="city">City</label>
                                @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative">
                                <input class="peer w-full bg-transparent border-0 border-b border-outline-variant/30 text-on-surface py-3 px-0 focus:ring-0 focus:border-primary transition-colors placeholder-transparent" id="postal" name="postal_code" placeholder="Postal" type="text" value="{{ old('postal_code') }}"/>
                                <label class="absolute left-0 -top-3.5 text-xs font-label text-secondary transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs" for="postal">Postal Code</label>
                            </div>
                        </div>
                    </div>
                    {{-- Payment --}}
                    <div class="space-y-6">
                        <h2 class="font-headline text-2xl text-secondary">Payment Method</h2>
                        <div class="flex flex-col gap-4">
                            <label class="flex items-center gap-4 p-6 bg-surface-container-low border border-outline-variant/15 cursor-pointer">
                                <input checked name="payment_method" type="radio" value="credit-card" class="text-primary focus:ring-primary bg-transparent border-outline-variant"/>
                                <span class="font-label text-sm tracking-wide text-on-surface">Credit Card</span>
                                <span class="material-symbols-outlined ml-auto text-secondary font-light">credit_card</span>
                            </label>
                            <label class="flex items-center gap-4 p-6 bg-surface border border-outline-variant/15 cursor-pointer hover:bg-surface-container-low transition-colors">
                                <input name="payment_method" type="radio" value="apple-pay" class="text-primary focus:ring-primary bg-transparent border-outline-variant"/>
                                <span class="font-label text-sm tracking-wide text-on-surface">Apple Pay</span>
                                <span class="material-symbols-outlined ml-auto text-secondary font-light">phone_iphone</span>
                            </label>
                        </div>
                        @error('payment_method')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{-- Order Summary --}}
    <aside class="w-full lg:w-2/5" data-animate>
        <div class="sticky top-40 bg-surface-container-lowest p-8 md:p-12 border border-outline-variant/15">
            <h2 class="font-headline text-2xl text-primary mb-8">Order Summary</h2>
            <div class="space-y-8 mb-12">
                @foreach($cartItems as $item)
                <div class="flex gap-6">
                    <div class="w-24 h-32 bg-surface-variant flex-shrink-0">
                        <img alt="{{ $item->product->name }}" class="w-full h-full object-cover" src="{{ $item->product->image }}"/>
                    </div>
                    <div class="flex flex-col justify-between py-1 w-full">
                        <div>
                            <h3 class="font-body text-sm font-medium text-on-surface uppercase tracking-wider">{{ $item->product->name }}</h3>
                            <p class="font-body text-xs text-secondary mt-1">
                                @if($item->size)Size: {{ $item->size }}@endif
                                @if($item->size && $item->color) | @endif
                                @if($item->color)Color: {{ $item->color }}@endif
                            </p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-body text-xs text-secondary">Qty: {{ $item->quantity }}</span>
                            <span class="font-headline text-lg text-primary">${{ number_format($item->product->price * $item->quantity, 0) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="space-y-4 pt-8 border-t border-outline-variant/15 mb-10">
                <div class="flex justify-between font-body text-sm text-secondary"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
                <div class="flex justify-between font-body text-sm text-secondary"><span>Shipping</span><span>${{ $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) }}</span></div>
                <div class="flex justify-between font-body text-sm text-secondary"><span>Taxes</span><span>${{ number_format($tax, 2) }}</span></div>
            </div>
            <div class="flex justify-between items-end mb-12">
                <span class="font-headline text-xl text-primary">Total</span>
                <span class="font-headline text-3xl text-primary">${{ number_format($total, 2) }}</span>
            </div>
            <button type="submit" form="checkout-form" class="w-full bg-primary text-on-primary py-5 font-label uppercase tracking-[0.2em] text-[10px] font-medium hover:opacity-90 transition-opacity">Place Order</button>
            <p class="font-body text-[10px] text-center text-secondary mt-6 uppercase tracking-widest">Secure Encrypted Checkout</p>
        </div>
    </aside>
</div>
@endsection
