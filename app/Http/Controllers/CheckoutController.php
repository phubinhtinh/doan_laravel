<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = $this->getCartItems($request);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng trống! Hãy thêm sản phẩm trước khi thanh toán.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $shipping = $subtotal > 1500 ? 0 : 25;
        $tax = round($subtotal * 0.08, 2);
        $total = $subtotal + $shipping + $tax;

        return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'payment_method' => ['required', 'in:credit-card,apple-pay'],
        ]);

        $cartItems = $this->getCartItems($request);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng trống!');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $shipping = $subtotal > 1500 ? 0 : 25;
        $tax = round($subtotal * 0.08, 2);
        $total = $subtotal + $shipping + $tax;

        $orderId = null;
        DB::transaction(function () use ($validated, $cartItems, $subtotal, $shipping, $tax, $total, $request, &$orderId) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'payment_method' => $validated['payment_method'],
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
            ]);
            $orderId = $order->id;

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                ]);
            }

            // Clear cart
            $this->clearCart($request);
        });

        $request->session()->put('last_order_id', $orderId);
        return redirect()->route('checkout.success');
    }

    public function success(Request $request)
    {
        $orderId = $request->session()->get('last_order_id');
        if (!$orderId) {
            return redirect()->route('home');
        }

        $order = Order::with('orderItems')->find($orderId);
        if (!$order) {
            return redirect()->route('home');
        }

        return view('checkout-success', compact('order'));
    }

    private function getCartItems(Request $request)
    {
        if (Auth::check()) {
            return CartItem::with('product')->where('user_id', Auth::id())->get();
        }
        return CartItem::with('product')->where('session_id', $request->session()->getId())->get();
    }

    private function clearCart(Request $request): void
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            CartItem::where('session_id', $request->session()->getId())->delete();
        }
    }
}
