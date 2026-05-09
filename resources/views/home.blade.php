@extends('layouts.app')

@section('title', 'ATELIER | The Digital Atelier')
@section('description', 'A curated dialogue between structure and fluidity. Exploring the boundaries of contemporary tailoring.')

@section('content')
{{-- Hero Section --}}
<section id="hero-section" class="relative min-h-screen flex items-center overflow-hidden bg-surface-container-low -mt-24">
    {{-- Slideshow: multiple fashion model images --}}
    <div class="hero-slideshow absolute inset-0 z-0" id="hero-slideshow">
        <img alt="Fashion model 1" class="hero-slide active"
             src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=2500&auto=format&fit=crop"/>
        <img alt="Fashion model 2" class="hero-slide"
             src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?q=80&w=2500&auto=format&fit=crop"/>
        <img alt="Fashion model 3" class="hero-slide"
             src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=2500&auto=format&fit=crop"/>
        <img alt="Fashion model 4" class="hero-slide"
             src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?q=80&w=2500&auto=format&fit=crop"/>
        <img alt="Fashion model 5" class="hero-slide"
             src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?q=80&w=2500&auto=format&fit=crop"/>
    </div>

    {{-- Gradient overlay --}}
    <div class="hero-gradient-overlay"></div>

    {{-- Slide progress bar --}}
    <div class="hero-progress" id="hero-progress">
        <div class="hero-progress-bar" id="hero-progress-bar"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-[1920px] mx-auto px-8 md:px-16 lg:px-24">
        <div class="max-w-4xl">
            <h1 class="font-headline text-6xl md:text-8xl lg:text-9xl text-on-primary leading-tight tracking-tight mb-8">
                <span class="hero-reveal hero-reveal-d1 block">The New</span>
                <span class="hero-reveal hero-reveal-d2 block italic font-light"><span class="hero-ethereal">Ethereal</span></span>
            </h1>
            <div class="flex flex-col md:flex-row md:items-end gap-8 md:gap-16">
                <p class="font-body text-lg md:text-xl text-on-primary/80 max-w-sm leading-relaxed hero-reveal hero-reveal-d3">
                    A curated dialogue between structure and fluidity. Exploring the boundaries of contemporary tailoring for the modern soul.
                </p>
                <a class="inline-flex items-center group hero-reveal hero-reveal-d4" href="{{ route('products.catalog') }}">
                    <div class="h-16 w-16 md:h-20 md:w-20 rounded-full border border-on-primary/30 flex items-center justify-center group-hover:bg-on-primary group-hover:border-on-primary transition-all duration-500 hero-cta-glow">
                        <span class="material-symbols-outlined text-on-primary group-hover:text-primary transition-colors duration-500">arrow_downward</span>
                    </div>
                    <span class="ml-6 font-label text-sm uppercase tracking-[0.3em] font-medium text-on-primary/90">Explore Series 04</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Slide counter --}}
    <div class="absolute bottom-8 right-8 md:right-16 lg:right-24 z-10 hero-reveal hero-reveal-d4">
        <div class="flex items-center gap-3">
            <span class="font-label text-2xl text-on-primary/90 font-light" id="hero-slide-current">01</span>
            <span class="w-8 h-[1px] bg-on-primary/40"></span>
            <span class="font-label text-sm text-on-primary/50" id="hero-slide-total">05</span>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 hero-reveal hero-reveal-d4">
        <div class="hero-scroll-indicator flex flex-col items-center gap-2 opacity-60">
            <span class="font-label text-[10px] uppercase tracking-[0.3em] text-on-primary/70">Scroll</span>
            <span class="material-symbols-outlined text-on-primary/70 text-lg">expand_more</span>
        </div>
    </div>
</section>

{{-- Featured Collections --}}
<section class="py-24 md:py-32 bg-surface" id="collections">
    <div class="max-w-[1920px] mx-auto px-8 md:px-16 lg:px-24">
        <div class="flex flex-col md:flex-row justify-between items-baseline mb-20 gap-8" data-animate>
            <h2 class="font-headline text-4xl md:text-6xl text-on-background">Featured Collections</h2>
            <p class="font-body text-secondary max-w-xs text-sm uppercase tracking-widest">Selected pieces from the AW24 Archive, reflecting timeless craftsmanship.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8">
            <a href="{{ route('products.catalog') }}" class="md:col-span-7 lg:col-span-8 group cursor-pointer" data-animate>
                <div class="relative aspect-[4/5] md:aspect-[16/9] overflow-hidden bg-surface-variant">
                    <img alt="Minimalist dress" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105" src="https://kenh14cdn.com/203336854389633024/2024/9/3/photo-4-1693026324700850122353-16521086-1725327370241-17253273705101390869764.jpg"/>
                    <div class="absolute bottom-8 left-8 md:bottom-12 md:left-12">
                        <span class="block font-label text-xs uppercase tracking-widest text-on-primary mb-2 opacity-80">Collection 01</span>
                        <h3 class="font-headline text-3xl md:text-4xl text-on-primary">Monochrome Essence</h3>
                    </div>
                </div>
            </a>
            <a href="{{ route('products.catalog') }}" class="md:col-span-5 lg:col-span-4 group cursor-pointer mt-12 md:mt-24" data-animate>
                <div class="relative aspect-[3/4] overflow-hidden bg-surface-variant">
                    <img alt="Fashion accessories" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://studiochupanhdep.com/Upload/Images/Album/anh-nu-mac-vest-02.jpg"/>
                </div>
                <div class="mt-6">
                    <h3 class="font-headline text-2xl text-on-background">The Accessory Edit</h3>
                    <p class="font-body text-secondary text-sm mt-2">Sculptural objects of desire.</p>
                </div>
            </a>
            <a href="{{ route('products.catalog') }}" class="md:col-span-6 lg:col-span-4 group cursor-pointer" data-animate>
                <div class="relative aspect-square overflow-hidden bg-surface-variant">
                    <img alt="Textured fabrics" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://icdn.24h.com.vn/upload/2-2023/images/2023-04-03/Khao-gia-cat-xe-cua-nhung-linh-truong-davika-viet-nam-va-nhung-phat-hien-moi-1680514037-203-width900height1125.jpg"/>
                </div>
                <div class="mt-6">
                    <h3 class="font-headline text-2xl text-on-background">Tactile Materials</h3>
                    <p class="font-body text-secondary text-sm mt-2">Sourced from historic Italian mills.</p>
                </div>
            </a>
            <a href="{{ route('products.catalog') }}" class="md:col-span-6 lg:col-span-8 group cursor-pointer md:-mt-24 lg:-mt-32" data-animate>
                <div class="relative aspect-[3/2] overflow-hidden bg-surface-variant">
                    <img alt="Modern atelier" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://cdn-media.sforum.vn/storage/app/media/anh-nguoi-mau-thumb.jpg"/>
                </div>
                <div class="mt-6 md:text-right">
                    <h3 class="font-headline text-2xl text-on-background">Runway Archive</h3>
                    <p class="font-body text-secondary text-sm mt-2">Relive the 2024 Paris Debut.</p>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- Brand Story --}}
<section class="py-24 md:py-48 bg-surface-container overflow-hidden">
    <div class="max-w-[1920px] mx-auto px-8 md:px-16 lg:px-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 md:gap-32 items-center">
            <div class="relative" data-animate>
                <div class="aspect-[4/5] bg-surface-variant overflow-hidden w-4/5 ml-auto">
                    <img alt="Artisan at work" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmSlC87AVV-WeoRlOQgxIvt6BLi37CEL63-cDxx1UOF6_1IMaE8SYUB-1VI_a_efyIkAgwQNM3AoBGwsHQ0bIvIOBBGLJRQlIjiyVqXFBk2z3GC9G5QSxkbTv37W6vLjjj_CKXFjzIL_Ytct3-a7BRkKt56oK0GhBZwR0r7mAKr32lS6FMH7QHQXn221KC-kW5ycXTcyMirmLvdzyntHxW_j1QYtupkYLZbtZ52-YHyTzQkRtEk1Qzuu3cqzxiHf7LNnJBSrsx8pQB"/>
                </div>
                <div class="absolute -bottom-12 -left-4 md:-left-12 w-2/3 aspect-square bg-surface overflow-hidden editorial-shadow">
                    <img alt="Fashion detail" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCWGrENQR15E7u9DO5Xjr6GyAVP7QAHZ0mM-VZEHYYC4QJ-GmhEd0HFLOa-8KCS52CWL9O2eUAfuy1NXirjp02YNL6jYNoD96HXGW76E1qO5hiEEgjBvzOGudNYhkMR9LQDzNebFrycdy9O4cjP3arj5aeYDLVDlCA1EV-yUABp3I0X51wKMXQcsFmv_r2KZoBzt1WTdPQr1DoWQBG5ffF2gsPmXtgj4X96-nMRN0FuKMsb7-1RRboNnKPYo8VJ2QoQvTwmozrgHUUv"/>
                </div>
            </div>
            <div data-animate>
                <span class="font-label text-xs uppercase tracking-[0.4em] text-secondary mb-6 block">Our Heritage</span>
                <h2 class="font-headline text-4xl md:text-6xl text-on-background mb-10 leading-tight">Crafting the <br/><span class="italic">Future of Luxury</span></h2>
                <div class="space-y-6 font-body text-lg text-primary max-w-md leading-relaxed">
                    <p>Founded in the heart of the digital age, ATELIER merges traditional savoir-faire with avant-garde aesthetics.</p>
                    <p>We believe that luxury is not defined by excess, but by the intentionality of every seam, the origin of every fiber, and the resonance of every silhouette.</p>
                </div>
                <div class="mt-12">
                    <a class="inline-block border-b border-primary pb-2 font-label text-sm uppercase tracking-widest text-primary hover:text-on-background hover:border-on-background transition-colors duration-300" href="#">Read the Full Journal</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Final CTA --}}
<section class="py-24 md:py-48 text-center bg-surface">
    <div class="max-w-4xl mx-auto px-8" data-animate>
        <h2 class="font-headline text-5xl md:text-7xl text-on-background mb-12">Witness the Unfolding</h2>
        <p class="font-body text-xl text-secondary mb-16 max-w-xl mx-auto">Join our inner circle to receive exclusive access to pre-orders, private runway viewings, and seasonal editorial content.</p>
        <div class="flex flex-col md:flex-row justify-center items-center gap-6">
            <a href="{{ route('products.catalog') }}" class="bg-primary text-on-primary px-12 py-5 font-label text-sm uppercase tracking-[0.2em] hover:bg-on-background transition-colors duration-500 w-full md:w-auto text-center">Shop New Arrivals</a>
            <a href="{{ route('products.catalog') }}" class="bg-surface-container-lowest text-primary border border-outline-variant px-12 py-5 font-label text-sm uppercase tracking-[0.2em] hover:bg-surface-container transition-colors duration-500 w-full md:w-auto text-center">Explore Archive</a>
        </div>
    </div>
</section>
@endsection
