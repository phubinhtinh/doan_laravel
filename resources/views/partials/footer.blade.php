<footer class="w-full mt-24 bg-stone-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full px-12 py-16 border-t border-stone-200/50">
        <div class="mb-12 md:mb-0">
            <a href="{{ route('home') }}" class="font-headline text-lg tracking-widest text-neutral-800">ATELIER</a>
            <p class="font-body text-[11px] uppercase tracking-[0.15em] text-neutral-600 mt-4">© {{ date('Y') }} THE DIGITAL ATELIER. ALL RIGHTS RESERVED.</p>
        </div>
        <div class="flex flex-wrap gap-8 md:gap-12">
            <a class="font-body text-[11px] uppercase tracking-[0.15em] text-neutral-500 hover:text-neutral-900 transition-colors duration-300 cursor-pointer">Privacy Policy</a>
            <a class="font-body text-[11px] uppercase tracking-[0.15em] text-neutral-500 hover:text-neutral-900 transition-colors duration-300 cursor-pointer">Terms of Service</a>
            <a class="font-body text-[11px] uppercase tracking-[0.15em] text-neutral-900 font-bold cursor-pointer">Sustainability</a>
            <a class="font-body text-[11px] uppercase tracking-[0.15em] text-neutral-500 hover:text-neutral-900 transition-colors duration-300 cursor-pointer">Contact</a>
        </div>
        <div class="mt-12 md:mt-0 flex space-x-6">
            <a class="text-neutral-500 hover:text-neutral-900 transition-colors cursor-pointer"><span class="material-symbols-outlined">public</span></a>
            <a class="text-neutral-500 hover:text-neutral-900 transition-colors cursor-pointer"><span class="material-symbols-outlined">alternate_email</span></a>
        </div>
    </div>
</footer>
