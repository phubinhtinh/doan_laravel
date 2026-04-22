<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'ATELIER | The Digital Atelier')</title>
    <meta name="description" content="@yield('description', 'ATELIER — A curated dialogue between structure and fluidity.')"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface antialiased font-body">

    @include('partials.navbar')

    <main class="pt-24">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
