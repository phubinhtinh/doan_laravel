@extends('layouts.app')

@section('title', 'ATELIER — Order Successful')

@section('content')
<div class="px-6 md:px-12 max-w-screen-md mx-auto min-h-[70vh] flex flex-col justify-center items-center text-center py-24" data-animate>
    <div class="mb-8 p-6 rounded-full bg-green-50 text-green-600 inline-flex items-center justify-center">
        <span class="material-symbols-outlined text-5xl">check_circle</span>
    </div>
    <h1 class="font-headline text-4xl lg:text-5xl text-primary mb-6 tracking-tight">Thanh toán thành công!</h1>
    <p class="font-body text-secondary text-lg mb-4">
        Cảm ơn bạn đã mua sắm tại ATELIER. Mã đơn hàng của bạn là <strong class="text-on-surface">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>.
    </p>
    <p class="font-body text-secondary mb-12">
        Thông tin chi tiết và xác nhận đơn hàng sẽ được gửi đến email <strong class="text-on-surface">{{ $order->email }}</strong> trong ít phút tới.
    </p>

    <div class="w-full bg-surface-container-low p-8 text-left mb-12">
        <h2 class="font-headline text-xl text-primary mb-6 border-b border-outline-variant/30 pb-4">Order Details</h2>
        <div class="space-y-4 mb-6">
            @foreach($order->orderItems as $item)
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div>
                        <p class="font-body text-sm font-medium text-on-surface">{{ $item->name }}</p>
                        <p class="font-body text-xs text-secondary mt-1">
                            @if($item->size)Size: {{ $item->size }}@endif
                            @if($item->size && $item->color) | @endif
                            @if($item->color)Color: {{ $item->color }}@endif
                            <span class="mx-2">x{{ $item->quantity }}</span>
                        </p>
                    </div>
                </div>
                <span class="font-body text-sm text-primary">${{ number_format($item->price * $item->quantity, 2) }}</span>
            </div>
            @endforeach
        </div>
        <div class="space-y-4 border-t border-outline-variant/30 pt-6">
            <div class="flex justify-between font-body text-sm text-secondary">
                <span>Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between font-body text-sm text-secondary">
                <span>Shipping</span><span>${{ $order->shipping == 0 ? 'Free' : number_format($order->shipping, 2) }}</span>
            </div>
            <div class="flex justify-between font-body text-sm text-secondary">
                <span>Taxes</span><span>${{ number_format($order->tax, 2) }}</span>
            </div>
            <div class="flex justify-between font-headline text-lg text-primary pt-4 border-t border-outline-variant/30 mt-4">
                <span>Total</span><span>${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="flex gap-6 justify-center">
        <a href="{{ route('products.catalog') }}" class="bg-primary text-on-primary py-4 px-8 font-label uppercase tracking-[0.2em] text-xs font-medium hover:bg-primary-dim transition-colors">
            Continue Shopping
        </a>
    </div>
</div>
@endsection
