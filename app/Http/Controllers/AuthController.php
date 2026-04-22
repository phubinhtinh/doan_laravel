<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\CartItem;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Merge guest cart items to user cart
            $this->mergeGuestCart($request);

            return redirect()->intended(route('home'))
                ->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        // Merge guest cart items to user cart
        $this->mergeGuestCart($request);

        return redirect()->route('home')
            ->with('success', 'Đăng ký thành công! Chào mừng bạn đến với ATELIER.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Đã đăng xuất.');
    }

    /**
     * Merge guest cart items (by session) into the user's cart after login/register.
     */
    private function mergeGuestCart(Request $request): void
    {
        $sessionId = $request->session()->getId();
        $userId = Auth::id();

        CartItem::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->update([
                'user_id' => $userId,
                'session_id' => null,
            ]);
    }
}
