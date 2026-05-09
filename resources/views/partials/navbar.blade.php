{{-- Mobile Menu Overlay --}}
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <button class="absolute top-8 right-8" id="mobile-menu-close">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <a class="font-headline tracking-widest uppercase text-lg text-neutral-800 hover:text-neutral-500 transition-colors" href="{{ route('products.catalog') }}">Collections</a>
    <a class="font-headline tracking-widest uppercase text-lg text-neutral-800 hover:text-neutral-500 transition-colors" href="#">Runway</a>
    <a class="font-headline tracking-widest uppercase text-lg text-neutral-800 hover:text-neutral-500 transition-colors" href="#">Archive</a>
    <a class="font-headline tracking-widest uppercase text-lg text-neutral-800 hover:text-neutral-500 transition-colors" href="#">Journal</a>
</div>

{{-- Navbar --}}
<nav class="fixed top-0 w-full z-50 bg-stone-50/80 backdrop-blur-2xl" id="main-navbar">
    <div class="flex justify-between items-center w-full px-8 py-6 max-w-[1920px] mx-auto">
        <div class="flex items-center">
            <a class="font-headline text-2xl tracking-[0.2em] font-medium text-neutral-800" href="{{ route('home') }}">ATELIER</a>
        </div>
        <div class="hidden md:flex items-center space-x-12">
            <a class="font-headline tracking-widest uppercase text-sm font-light {{ request()->is('products*') ? 'text-neutral-900 border-b border-neutral-800 pb-1' : 'text-neutral-500 hover:text-neutral-800' }} transition-colors duration-300" href="{{ route('products.catalog') }}">Collections</a>
            <a class="font-headline tracking-widest uppercase text-sm font-light text-neutral-500 hover:text-neutral-800 transition-colors duration-300" href="#">Runway</a>
            <a class="font-headline tracking-widest uppercase text-sm font-light text-neutral-500 hover:text-neutral-800 transition-colors duration-300" href="#">Archive</a>
            <a class="font-headline tracking-widest uppercase text-sm font-light text-neutral-500 hover:text-neutral-800 transition-colors duration-300" href="#">Journal</a>
        </div>
        <div class="flex items-center space-x-6">
            <a href="{{ route('search') }}" class="hover:opacity-70 transition-opacity duration-500 text-neutral-700">
                <span class="material-symbols-outlined">search</span>
            </a>
            <a href="{{ route('cart') }}" class="hover:opacity-70 transition-opacity duration-500 text-neutral-700 relative">
                <span class="material-symbols-outlined">shopping_bag</span>
                @php
                    $cartCount = 0;
                    if (auth()->check()) {
                        $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
                    } else {
                        $cartCount = \App\Models\CartItem::where('session_id', session()->getId())->sum('quantity');
                    }
                @endphp
                @if($cartCount > 0)
                <span class="absolute -top-2 -right-2 bg-primary text-on-primary text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-medium">{{ $cartCount }}</span>
                @endif
            </a>
            @auth
                <div class="hidden md:flex items-center relative">
                    @if(auth()->user()->isAdmin())
                        <div class="relative">
                            <button type="button" class="cursor-pointer py-2 px-2 flex items-center border-none bg-transparent" onclick="document.getElementById('admin-dropdown').classList.toggle('hidden')">
                                <span class="text-sm text-neutral-800 font-body font-medium">Admin</span>
                            </button>
                            
                            <div id="admin-dropdown" class="hidden absolute top-[100%] left-1/2 -translate-x-1/2 mt-1 w-32 z-50">
                                <div class="bg-stone-50/80 backdrop-blur-2xl shadow-md flex flex-col py-1">
                                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-1.5 text-sm font-body text-neutral-700 hover:bg-stone-200/50 transition-colors text-center">Dashboard</a>
                                    <form method="POST" action="{{ route('logout') }}" class="w-full m-0 p-0">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-1.5 text-sm font-body text-neutral-700 hover:bg-stone-200/50 transition-colors text-center">Đăng xuất</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Script to close dropdown when clicking outside --}}
                        <script>
                            document.addEventListener('click', function(event) {
                                var dropdown = document.getElementById('admin-dropdown');
                                var button = dropdown?.previousElementSibling;
                                if (dropdown && !dropdown.contains(event.target) && !button.contains(event.target)) {
                                    dropdown.classList.add('hidden');
                                }
                            });
                        </script>
                    @else
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-neutral-500 font-body">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="hover:opacity-70 transition-opacity duration-500 text-neutral-700" title="Đăng xuất">
                                    <span class="material-symbols-outlined">logout</span>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:opacity-70 transition-opacity duration-500 text-neutral-700 hidden md:block">
                    <span class="material-symbols-outlined">person</span>
                </a>
            @endauth
            <button class="md:hidden hover:opacity-70 transition-opacity" id="mobile-menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success') || session('error'))
<div class="fixed top-24 right-8 z-[100] max-w-sm" id="flash-message">
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 text-sm font-body shadow-lg">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 text-sm font-body shadow-lg">
        {{ session('error') }}
    </div>
    @endif
</div>
<script>
    setTimeout(() => {
        const el = document.getElementById('flash-message');
        if (el) el.style.display = 'none';
    }, 4000);
</script>
@endif
