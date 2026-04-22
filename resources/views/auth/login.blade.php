<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Atelier — Login</title>
    <meta name="description" content="Sign in to your ATELIER account."/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body antialiased min-h-screen flex flex-col md:flex-row">

{{-- Left: Editorial Image --}}
<div class="relative w-full h-[400px] md:h-screen md:w-1/2 lg:w-[55%] flex-shrink-0 bg-surface-variant overflow-hidden">
    <img alt="Editorial fashion" class="absolute inset-0 w-full h-full object-cover object-center grayscale-[20%]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzkAYioQa_XVxm7D3OV5Pi39FVPZ9jLOLFMJTs3gXQ6SwsUmVZyXnvuTkfAVu1fOwvZuJ_Q1ae70pW7mJmsQ9bjJJtGreYPXP8VUj31GSY6wlYjnS1NlzuO-PRsiPuNzyb0OaoG959CJkayCjeDoJZhUPevJULGSvwXMhv2tIVCBT12hoes5iWLLgZVuNhbIr0Ktb5d8o3AmfASjPRjjw7Z69KLdfS08zZ5Pbalw1lN_VQTyHikAjjsNliOtMzGz0ZtpwriB5dVtrN"/>
    <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-surface/20 to-transparent mix-blend-multiply"></div>
    <div class="absolute top-8 left-8 md:top-12 md:left-12">
        <a href="{{ route('home') }}" class="font-headline italic text-2xl tracking-[0.2em] font-light text-surface-container-lowest drop-shadow-md">ATELIER</a>
    </div>
</div>

{{-- Right: Form --}}
<div class="w-full md:w-1/2 lg:w-[45%] flex flex-col justify-center px-8 py-16 md:px-16 lg:px-24 bg-surface z-10">
    <div class="w-full max-w-md mx-auto flex flex-col gap-16">
        <div class="flex flex-col gap-4">
            <h1 class="font-headline text-4xl md:text-5xl text-primary tracking-tight">Access</h1>
            <p class="font-body text-secondary text-sm md:text-base leading-relaxed max-w-sm">Enter your credentials to continue your journey through the digital atelier.</p>
        </div>
        <form class="flex flex-col gap-10" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="relative">
                <label class="block font-label text-xs tracking-widest uppercase text-secondary mb-2" for="email">Email Address</label>
                <input class="w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 text-on-surface font-body focus:ring-0 focus:border-primary transition-colors placeholder:text-outline-variant/50" id="email" name="email" placeholder="client@domain.com" required type="email" value="{{ old('email') }}"/>
                @error('email')
                <p class="text-red-500 text-xs mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative flex flex-col gap-2">
                <label class="block font-label text-xs tracking-widest uppercase text-secondary" for="password">Password</label>
                <input class="w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 text-on-surface font-body focus:ring-0 focus:border-primary transition-colors" id="password" name="password" required type="password"/>
                <div class="flex justify-end mt-1">
                    <a class="font-label text-[11px] tracking-wider uppercase text-secondary hover:text-primary transition-colors duration-300" href="#">Forgot Password?</a>
                </div>
            </div>
            <div class="pt-4">
                <button class="w-full bg-primary text-on-primary py-4 px-8 font-label text-xs tracking-[0.2em] uppercase hover:bg-primary-dim transition-colors duration-300 shadow-[0_20px_40px_-15px_rgba(47,52,48,0.1)] flex justify-center items-center gap-4" type="submit">
                    <span>Sign In</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
        </form>
        <div class="pt-8 border-t border-outline-variant/20 flex flex-col items-center gap-4">
            <span class="font-body text-sm text-secondary">Not a member of the Atelier?</span>
            <a class="font-label text-xs tracking-widest uppercase text-primary underline underline-offset-8 hover:text-secondary transition-colors duration-300" href="{{ route('register') }}">Create an Account</a>
        </div>
    </div>
</div>
</body>
</html>
