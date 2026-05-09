<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'Admin | ATELIER')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">

    {{-- Sidebar --}}
    <aside class="admin-sidebar" id="admin-sidebar">
        <div class="admin-sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                <span class="admin-logo-icon">
                    <span class="material-symbols-outlined">diamond</span>
                </span>
                <span class="admin-logo-text">ATELIER</span>
            </a>
            <span class="admin-logo-badge">ADMIN</span>
        </div>

        <nav class="admin-nav">
            <span class="admin-nav-label">QUẢN LÝ</span>

            <a href="{{ route('admin.dashboard') }}"
               class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Tổng quan</span>
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="admin-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span>Sản phẩm</span>
                <span class="admin-nav-count">{{ \App\Models\Product::count() }}</span>
            </a>

            <span class="admin-nav-label" style="margin-top: 1.5rem;">HỆ THỐNG</span>

            <a href="{{ route('home') }}" class="admin-nav-item" target="_blank">
                <span class="material-symbols-outlined">storefront</span>
                <span>Xem cửa hàng</span>
                <span class="material-symbols-outlined" style="font-size: 14px; margin-left: auto;">open_in_new</span>
            </a>
        </nav>

        <div class="admin-sidebar-footer">
            <div class="admin-user-card">
                <div class="admin-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="admin-user-info">
                    <span class="admin-user-name">{{ auth()->user()->name }}</span>
                    <span class="admin-user-role">Quản trị viên</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="admin-logout-btn" title="Đăng xuất">
                    <span class="material-symbols-outlined">logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="admin-main">
        {{-- Top Bar --}}
        <header class="admin-topbar">
            <button class="admin-sidebar-toggle" id="admin-sidebar-toggle">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="admin-topbar-title">
                <h1>@yield('page-title', 'Dashboard')</h1>
                <p class="admin-breadcrumb">@yield('breadcrumb', 'Admin')</p>
            </div>
            <div class="admin-topbar-actions">
                @yield('actions')
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success') || session('error'))
        <div class="admin-flash" id="admin-flash">
            @if(session('success'))
            <div class="admin-flash-success">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="admin-flash-close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div class="admin-flash-error">
                <span class="material-symbols-outlined">error</span>
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="admin-flash-close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            @endif
        </div>
        <script>setTimeout(() => { const el = document.getElementById('admin-flash'); if (el) el.style.display = 'none'; }, 5000);</script>
        @endif

        {{-- Page Content --}}
        <div class="admin-content">
            @yield('content')
        </div>
    </main>

    <script>
        // Sidebar toggle for mobile
        const toggle = document.getElementById('admin-sidebar-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        if (toggle && sidebar) {
            toggle.addEventListener('click', () => sidebar.classList.toggle('open'));
        }
    </script>
    @stack('scripts')
</body>
</html>
