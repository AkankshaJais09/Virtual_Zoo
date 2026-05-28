<!-- Minimal Clean Navbar -->
<header class="fixed top-0 left-0 w-full z-50 transition-all duration-500" 
        x-data="{ isOpen: false, isScrolled: false }" 
        x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 50 })"
        :class="isScrolled ? 'bg-moss-950/70 border-b border-white/5 backdrop-blur-md py-4' : 'bg-transparent py-6'">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        
        <!-- Branding -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <span class="p-2 rounded-full bg-gold-500/10 border border-gold-500/20 text-gold-500 group-hover:border-gold-500/40 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l4.038 3.332a.75.75 0 0 1 .288.583v4.61a.75.75 0 0 1-.288.583l-4.038 3.331a1.125 1.125 0 0 0-.405.864v.568M11.25 3.03v.568c0 .334-.148.65-.405.864L6.807 7.794a.75.75 0 0 0-.288.583v4.61a.75.75 0 0 0 .288.583l4.038 3.331c.257.213.405.53.405.864v.568m-1.5 12h3m-3-18h3m-9 6h15" />
                </svg>
            </span>
            <div class="flex flex-col">
                <span class="font-serif tracking-widest text-lg md:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zinc-100 to-gold-400">
                    WILDVERSE
                </span>
                <span class="text-[8px] tracking-[0.3em] text-gold-500 font-mono -mt-1 uppercase">VIRTUAL ZOO</span>
            </div>
        </a>

        <!-- Menu Links -->
        <nav class="hidden md:flex items-center gap-10">
            <a href="/#hero" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                HOME
                <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ route('explore') }}" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                EXPLORE
                <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ route('animals.index') }}" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                ANIMALS
                <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ route('facts') }}" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                FACTS
                <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ route('visit') }}" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                VISIT
                <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="/#footer" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                ABOUT
                <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
            </a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-4">
            <a href="{{ route('explore') }}" class="hidden sm:inline-flex px-6 py-2.5 rounded-full border border-gold-500/30 text-gold-400 hover:text-forest-950 hover:bg-gold-500 hover:border-gold-500 transition-all duration-500 text-xs tracking-[0.25em] font-semibold">
                START EXPLORING
            </a>
            
            <!-- Mobile Toggle -->
            <button @click="isOpen = !isOpen" class="md:hidden p-2 text-zinc-400 hover:text-zinc-100 focus:outline-none">
                <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden absolute top-20 left-0 w-full glass-panel border-b border-gold-500/10 z-40 py-8 px-8 flex flex-col gap-6"
         style="display: none;">
        <a @click="isOpen = false" href="/#hero" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">HOME</a>
        <a @click="isOpen = false" href="{{ route('explore') }}" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">EXPLORE</a>
        <a @click="isOpen = false" href="{{ route('animals.index') }}" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">ANIMALS</a>
        <a @click="isOpen = false" href="{{ route('facts') }}" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">FACTS</a>
        <a @click="isOpen = false" href="{{ route('visit') }}" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">VISIT</a>
        <a @click="isOpen = false" href="/#footer" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">ABOUT</a>
        <a @click="isOpen = false" href="{{ route('explore') }}" class="inline-flex justify-center items-center py-3 rounded-full border border-gold-500/30 text-gold-400 hover:bg-gold-500 hover:text-forest-950 transition-all duration-300 text-xs tracking-widest font-medium">
            START EXPLORING
        </a>
    </div>
</header>
