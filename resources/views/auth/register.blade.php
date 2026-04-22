<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Atelier — Sign Up</title>
    <meta name="description" content="Join the ATELIER. Curated access to exclusive collections."/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body min-h-screen flex flex-col antialiased">
<main class="flex-grow flex flex-col md:flex-row w-full min-h-screen">
    {{-- Image Section --}}
    <section class="hidden md:block md:w-1/2 relative bg-surface-variant overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center"></div>
        <div class="absolute inset-0 bg-surface/20 backdrop-blur-[2px]"></div>
    </section>
    {{-- Form Section --}}
    <section class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-surface relative z-10">
        <div class="w-full max-w-md space-y-12">
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="font-headline italic text-sm tracking-[0.2em] text-secondary hover:text-primary transition-colors mb-4 inline-block">← ATELIER</a>
                <h1 class="font-headline italic text-4xl lg:text-5xl font-light tracking-wide text-primary">Join the Atelier.</h1>
                <p class="font-body text-secondary text-sm md:text-base leading-relaxed max-w-sm">Curated access. Exclusive collections. Begin your journey.</p>
            </div>
            <form class="space-y-8" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="relative">
                    <input class="block w-full px-0 py-3 bg-transparent border-0 border-b border-outline-variant text-on-surface font-body text-base focus:ring-0 focus:border-primary transition-colors peer placeholder-transparent" id="full-name" name="name" placeholder="Full Name" required type="text" value="{{ old('name') }}"/>
                    <label class="absolute left-0 -top-3.5 text-secondary text-sm font-label transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-outline peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-secondary peer-focus:text-sm" for="full-name">Full Name</label>
                    @error('name')
                    <p class="text-red-500 text-xs mt-2 font-body">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative">
                    <input class="block w-full px-0 py-3 bg-transparent border-0 border-b border-outline-variant text-on-surface font-body text-base focus:ring-0 focus:border-primary transition-colors peer placeholder-transparent" id="email" name="email" placeholder="Email" required type="email" value="{{ old('email') }}"/>
                    <label class="absolute left-0 -top-3.5 text-secondary text-sm font-label transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-outline peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-secondary peer-focus:text-sm" for="email">Email Address</label>
                    @error('email')
                    <p class="text-red-500 text-xs mt-2 font-body">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative">
                    <input class="block w-full px-0 py-3 bg-transparent border-0 border-b border-outline-variant text-on-surface font-body text-base focus:ring-0 focus:border-primary transition-colors peer placeholder-transparent" id="password" name="password" placeholder="Password" required type="password"/>
                    <label class="absolute left-0 -top-3.5 text-secondary text-sm font-label transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-outline peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-secondary peer-focus:text-sm" for="password">Password</label>
                    @error('password')
                    <p class="text-red-500 text-xs mt-2 font-body">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5">
                        <input class="w-4 h-4 rounded-none bg-surface-container border-outline-variant text-primary focus:ring-primary" id="newsletter" name="newsletter" type="checkbox"/>
                    </div>
                    <div class="ml-3 text-sm">
                        <label class="font-label text-secondary cursor-pointer hover:text-primary transition-colors" for="newsletter">Subscribe to the Journal for curated editorial content and early access.</label>
                    </div>
                </div>
                <div class="pt-4">
                    <button class="w-full flex justify-center py-4 px-4 text-sm font-label font-medium text-on-primary bg-primary hover:opacity-90 focus:outline-none transition-opacity tracking-widest uppercase" type="submit">Register</button>
                </div>
            </form>
            <div class="mt-8 text-center">
                <p class="font-body text-sm text-secondary">
                    Already have an account?
                    <a class="font-label font-medium text-primary hover:text-on-surface underline underline-offset-4 transition-colors" href="{{ route('login') }}">Sign in.</a>
                </p>
            </div>
        </div>
    </section>
</main>
</body>
</html>
