<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = $this->getCartItems($request);

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = $subtotal > 1500 ? 0 : 45;
        $tax = round($subtotal * 0.08, 2);
        $total = $subtotal + $shipping + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['integer', 'min:1'],
            'size' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if item already in cart
        $existingItem = $this->findCartItem($request, $product->id, $request->size, $request->color);

        if ($existingItem) {
            $existingItem->update([
                'quantity' => $existingItem->quantity + ($request->quantity ?? 1),
            ]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : $request->session()->getId(),
                'product_id' => $product->id,
                'quantity' => $request->quantity ?? 1,
                'size' => $request->size,
                'color' => $request->color ?? $product->color,
            ]);
        }

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_item_id' => ['required', 'exists:cart_items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);

        // Verify ownership
        if (!$this->ownsCartItem($request, $cartItem)) {
            abort(403);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'cart_item_id' => ['required', 'exists:cart_items,id'],
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);

        if (!$this->ownsCartItem($request, $cartItem)) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    /**
     * Get all cart items for current user or session.
     */
    private function getCartItems(Request $request)
    {
        if (Auth::check()) {
            return CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();
        }

        return CartItem::with('product')
            ->where('session_id', $request->session()->getId())
            ->get();
    }

    /**
     * Find a cart item by product, size, color for current user/guest.
     */
    private function findCartItem(Request $request, int $productId, ?string $size, ?string $color)
    {
        $query = CartItem::where('product_id', $productId)
            ->where('size', $size)
            ->where('color', $color);

        if (Auth::check()) {
            return $query->where('user_id', Auth::id())->first();
        }

        return $query->where('session_id', $request->session()->getId())->first();
    }

    /**
     * Check if the current user/guest owns this cart item.
     */
    private function ownsCartItem(Request $request, CartItem $cartItem): bool
    {
        if (Auth::check()) {
            return $cartItem->user_id === Auth::id();
        }

        return $cartItem->session_id === $request->session()->getId();
    }
}
