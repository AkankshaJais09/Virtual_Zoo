<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>WildVerse – Interactive Virtual Zoo Experience</title>
    <meta name="description" content="Embark on an immersive, cinematic journey through the world's most breathtaking habitats and observe rare wildlife in high-fidelity digital sanctuaries.">
    
    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS for interactive elements -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-moss-950 text-zinc-100 font-sans antialiased selection:bg-gold-500 selection:text-forest-950 overflow-x-hidden">

    <!-- Warm Nature Sunray & Mist Overlays (Global background depth) -->
    <div class="fixed inset-0 z-0 pointer-events-none opacity-40 mix-blend-screen sunray-overlay"></div>
    <div class="fixed inset-0 z-0 pointer-events-none opacity-30 mist-overlay animate-mist-scroll"></div>

    <!-- Transparent Expedition Navbar -->
    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-500" 
            x-data="{ isOpen: false, isScrolled: false }" 
            x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 50 })"
            :class="isScrolled ? 'bg-moss-900/90 shadow-2xl border-b border-gold-500/10 backdrop-blur-xl py-4' : 'bg-transparent py-6'">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            
            <!-- Branding -->
            <a href="#" class="flex items-center gap-3 group">
                <span class="p-2 rounded-lg bg-gold-500/10 border border-gold-500/20 text-gold-500 group-hover:border-gold-500/40 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l4.038 3.332a.75.75 0 0 1 .288.583v4.61a.75.75 0 0 1-.288.583l-4.038 3.331a1.125 1.125 0 0 0-.405.864v.568M11.25 3.03v.568c0 .334-.148.65-.405.864L6.807 7.794a.75.75 0 0 0-.288.583v4.61a.75.75 0 0 0 .288.583l4.038 3.331c.257.213.405.53.405.864v.568m-1.5 12h3m-3-18h3m-9 6h15" />
                    </svg>
                </span>
                <div class="flex flex-col">
                    <span class="font-serif tracking-widest text-lg md:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zinc-100 to-gold-400">
                        WILDVERSE
                    </span>
                    <span class="text-[8px] tracking-[0.3em] text-gold-500 font-mono -mt-1 uppercase">EXPEDITION HUB</span>
                </div>
            </a>

            <!-- Menu Links with coordinates styling on active hover -->
            <nav class="hidden md:flex items-center gap-10">
                <a href="#" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                    HOME
                    <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#explore" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                    EXPLORE ZONES
                    <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#logs" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                    WILDLIFE FACTS
                    <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#featured" class="relative text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-xs tracking-[0.2em] font-medium py-1 group">
                    SPECIES LOG
                    <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold-400 group-hover:w-full transition-all duration-300"></span>
                </a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <span class="hidden lg:inline-block coords-tag">SYS.SYS // ACTIVE</span>
                <a href="#" class="hidden sm:inline-flex px-6 py-2.5 rounded-full border border-gold-500/30 text-gold-400 hover:text-forest-950 hover:bg-gold-500 hover:border-gold-500 transition-all duration-500 text-xs tracking-[0.25em] font-semibold">
                    ENTER SANCTUARY
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
            <a @click="isOpen = false" href="#" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">HOME</a>
            <a @click="isOpen = false" href="#explore" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">EXPLORE ZONES</a>
            <a @click="isOpen = false" href="#logs" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">FIELD LOGS</a>
            <a @click="isOpen = false" href="#featured" class="text-zinc-300 hover:text-gold-400 transition-colors duration-300 text-sm tracking-widest font-medium">SPECIES LOG</a>
            <a @click="isOpen = false" href="#" class="inline-flex justify-center items-center py-3 rounded-full border border-gold-500/30 text-gold-400 hover:bg-gold-500 hover:text-forest-950 transition-all duration-300 text-xs tracking-widest font-medium">
                ENTER SANCTUARY
            </a>
        </div>
    </header>

    <!-- Layered Fullscreen Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-32 pb-24">
        
        <!-- Large Background Image with warm overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero_bg.png') }}" alt="WildVerse Majestic Jungle" class="w-full h-full object-cover scale-105 filter brightness-[0.70] contrast-[1.05] saturate-[0.95]">
            <!-- Complex atmospheric layering (removes raw black space) -->
            <div class="absolute inset-0 bg-gradient-to-b from-moss-950/20 via-forest-900/60 to-forest-900/90 mix-blend-multiply z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-moss-950 via-transparent to-transparent z-15"></div>
            
            <!-- Floating dust/mist particle layer -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(212,163,89,0.1),transparent_40%)] z-10"></div>
        </div>

        <!-- Expedition HUD details (Layered side elements) -->
        <div class="absolute left-8 bottom-24 hidden xl:flex flex-col gap-6 z-25 text-left text-zinc-500 font-mono text-[10px] border-l border-gold-500/20 pl-4">
            <div>
                <span class="text-gold-400 block font-bold">LATITUDE</span>
                <span>0.5193° S / KILIMANJARO</span>
            </div>
            <div>
                <span class="text-gold-400 block font-bold">WEATHER TEMP</span>
                <span>27°C / CLOUDY MIST</span>
            </div>
            <div>
                <span class="text-gold-400 block font-bold">SIGNAL STRENGTH</span>
                <span>LIVE FEED STABLE // 98%</span>
            </div>
        </div>

        <div class="absolute right-8 bottom-24 hidden xl:flex flex-col gap-3 z-25 text-right font-mono text-[9px] text-zinc-500">
            <span>EXPEDITION ID: W-2026</span>
            <span>HARDWARE STATUS: ONLINE</span>
            <span>STREAM: 4K HIGH FIDELITY</span>
        </div>

        <!-- Central Interactive Hero Panel -->
        <div class="relative z-20 max-w-4xl mx-auto px-6 text-center animate-fade-in-up">
            
            <!-- Coordinates stamp badge -->
            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full glass-panel border border-gold-500/20 text-gold-400 text-xs font-mono tracking-widest mb-8 animate-float">
                <span class="w-2 h-2 rounded-full bg-gold-400 animate-ping"></span>
                <span>COORDS: 1.2921° S, 36.8219° E</span>
            </div>
            
            <h1 class="font-serif-display text-4xl sm:text-6xl md:text-8xl font-bold tracking-tight text-white mb-6 leading-[1.05]">
                Explore Wildlife<br>
                <span class="italic text-gold-400 font-normal">Like Never Before</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-zinc-300 md:text-lg tracking-wide leading-relaxed font-light mb-12">
                Step beyond the boundaries of standard documentary. Access real-time habitat streams, track species parameters, and explore high-fidelity natural sanctuaries in a cinematic virtual tour.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="#explore" class="group relative w-full sm:w-auto px-10 py-5 rounded-full overflow-hidden bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 font-bold text-xs tracking-[0.2em] shadow-[0_15px_30px_rgba(212,163,89,0.25)] hover:shadow-[0_20px_40px_rgba(212,163,89,0.4)] transition-all duration-300 hover:-translate-y-0.5">
                    <span class="relative z-10">START EXPLORATION</span>
                </a>
                <a href="#logs" class="w-full sm:w-auto px-10 py-5 rounded-full border border-white/20 hover:border-gold-500/40 text-zinc-200 hover:text-white font-semibold text-xs tracking-[0.2em] bg-white/5 hover:bg-gold-500/5 backdrop-blur-md transition-all duration-300">
                    READ DISPATCHES
                </a>
            </div>
        </div>

        <!-- Floating Chevron indicator -->
        <a href="#story" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-2 group cursor-pointer">
            <span class="text-[9px] tracking-[0.3em] text-zinc-500 font-mono group-hover:text-gold-400 transition-colors">DESCEND INTO THE WILD</span>
            <div class="w-6 h-6 text-zinc-500 group-hover:text-gold-400 transition-colors animate-bounce flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </a>
    </section>

    <!-- Narrative Storytelling Flow Section (Connecting hero to zones) -->
    <section id="story" class="relative py-28 bg-gradient-to-b from-moss-950 via-forest-950 to-forest-900 z-20 overflow-hidden border-t border-white/5">
        
        <!-- Subtle warm ambient lighting shaft -->
        <div class="absolute right-0 top-0 w-96 h-96 bg-gold-500/5 rounded-full filter blur-[120px] pointer-events-none"></div>
        <div class="absolute left-0 bottom-0 w-96 h-96 bg-forest-500/10 rounded-full filter blur-[150px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                
                <!-- Left overlapping panel containing narrative details -->
                <div class="lg:col-span-6 relative z-10">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-6 h-[1px] bg-gold-500/50"></span>
                        <span class="text-xs font-mono tracking-[0.3em] text-gold-500 uppercase">EXPEDITION PHILOSOPHY</span>
                    </div>
                    <h2 class="font-serif text-3xl md:text-5xl text-white font-bold leading-tight mb-6">
                        Bridging The Gap Between <span class="italic text-gold-400 font-normal">Humanity & Wilderness</span>
                    </h2>
                    
                    <div class="space-y-6 text-zinc-300 text-sm leading-relaxed font-light">
                        <p>
                            True conservation is not merely observation—it is an emotional connection. WildVerse utilizes remote telemetry, cinematic photography, and live data interfaces to capture the organic pulse of earth's remote habitats.
                        </p>
                        <p>
                            Through these digital sanctuaries, you step directly into local biomes, exploring landscapes exactly as researchers do. Understand species migration, analyze environmental parameters, and connect deeply to the fragile beauty of our biosphere.
                        </p>
                    </div>

                    <!-- Interactive checklist feature -->
                    <div class="grid grid-cols-2 gap-6 mt-10 border-t border-white/10 pt-8 font-mono text-xs">
                        <div class="flex items-start gap-3">
                            <span class="p-1 rounded bg-gold-500/10 text-gold-400">✓</span>
                            <div>
                                <h4 class="text-white font-bold">LIVE TELEMETRY</h4>
                                <p class="text-zinc-500 text-[10px] mt-1">Real-time parameters from remote wildlife cameras.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="p-1 rounded bg-gold-500/10 text-gold-400">✓</span>
                            <div>
                                <h4 class="text-white font-bold">HABITAT SOUNDS</h4>
                                <p class="text-zinc-500 text-[10px] mt-1">Spatial soundscapes recorded in the wild.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right large overlapping photo panel with warm sunlight outline -->
                <div class="lg:col-span-6 relative flex items-center justify-center">
                    <div class="absolute -inset-4 rounded-3xl bg-gradient-to-tr from-gold-500/10 via-transparent to-forest-500/20 filter blur-xl opacity-80 pointer-events-none"></div>
                    
                    <!-- Main Image container -->
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/10 group aspect-[4/3] w-full">
                        <img src="{{ asset('images/category_jungle.png') }}" alt="Jaguar in mist" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-moss-950/80 via-transparent to-transparent z-10"></div>
                        
                        <!-- Overlay Details -->
                        <div class="absolute bottom-6 left-6 z-20 font-mono text-left">
                            <span class="text-gold-400 text-xs uppercase block font-bold">RECORDING ZONE A</span>
                            <span class="text-white text-lg font-serif italic">Bengal Delta Sanctuary</span>
                        </div>
                    </div>

                    <!-- Overlapping small HUD Card -->
                    <div class="absolute -bottom-6 -left-6 hidden md:flex items-center gap-4 glass-panel p-5 rounded-xl border border-gold-500/20 shadow-2xl z-25 max-w-[240px]">
                        <span class="p-3 rounded-full bg-forest-800/80 text-gold-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-.778.099-1.533.284-2.253" />
                            </svg>
                        </span>
                        <div class="text-left font-mono">
                            <span class="text-[9px] text-zinc-400 block font-bold">GEOGRAPHIC ZONE</span>
                            <span class="text-white text-xs block">Pantanal Wetlands</span>
                            <span class="text-gold-400 text-[8px] block">LIVE FEED 4K</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Redesigned World-Entering Category Panels (Expanding Rows) -->
    <section id="explore" class="relative py-28 bg-forest-900 border-t border-white/5 z-20" x-data="{ activeZone: 'jungle' }">
        
        <!-- Large backdrop glow that dynamically shifts depending on the hovered category -->
        <div class="absolute inset-0 pointer-events-none opacity-20 filter blur-[150px] transition-all duration-1000 z-0"
             :class="{
                'bg-emerald-800': activeZone === 'jungle',
                'bg-blue-800': activeZone === 'ocean',
                'bg-amber-800': activeZone === 'birds',
                'bg-slate-700': activeZone === 'arctic',
             }">
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            
            <!-- Section Header -->
            <div class="text-left mb-16 flex flex-col md:flex-row md:items-end justify-between">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-[1px] bg-gold-500/50"></span>
                        <span class="text-xs font-mono tracking-[0.3em] text-gold-500 uppercase">EXPEDITION MAPS</span>
                    </div>
                    <h2 class="font-serif text-3xl md:text-5xl font-bold mt-2 text-white">Enter Different Worlds</h2>
                    <div class="w-16 h-[2px] bg-gold-500/40 mt-4"></div>
                </div>
                <p class="max-w-md text-zinc-400 text-sm mt-4 md:mt-0 font-light leading-relaxed">
                    Hover over each territory to initiate connection. Step into the specific coordinate parameters to view the unique wildlife in high fidelity.
                </p>
            </div>

            <!-- Large Immersive Horizontal Category Selector -->
            <div class="flex flex-col lg:flex-row gap-6 h-[600px] w-full items-stretch">
                
                <!-- Jungle Zone Panel -->
                <div class="relative overflow-hidden rounded-2xl border transition-all duration-700 ease-out cursor-pointer flex-1 flex flex-col justify-end p-8"
                     :class="activeZone === 'jungle' ? 'lg:grow-[2.5] border-gold-500/40 shadow-2xl bg-forest-950/40' : 'lg:grow-[0.8] border-white/5 bg-forest-950/20'"
                     @mouseover="activeZone = 'jungle'">
                    
                    <!-- Background image with scale and dark overlay -->
                    <img src="{{ asset('images/category_jungle.png') }}" alt="Jungle Zone" class="absolute inset-0 w-full h-full object-cover transition-all duration-1000"
                         :class="activeZone === 'jungle' ? 'scale-105 brightness-[0.70] contrast-[1.05]' : 'brightness-[0.40] scale-100'">
                    <div class="absolute inset-0 bg-gradient-to-t from-moss-950 via-moss-950/20 to-transparent z-10"></div>
                    
                    <!-- Floating Coordinates tag (only visible when expanded) -->
                    <div class="absolute top-6 left-6 z-20 font-mono transition-all duration-500"
                         :class="activeZone === 'jungle' ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">
                        <span class="coords-tag">COORD: 3.0674° S, 37.3556° E</span>
                    </div>

                    <!-- Panel Info -->
                    <div class="relative z-20">
                        <span class="text-[9px] tracking-[0.3em] font-mono text-gold-400 uppercase">ZONE 01 / EAST AFRICA</span>
                        <h3 class="font-serif text-2xl md:text-3xl font-bold text-white mt-1">Jungle Zone</h3>
                        
                        <!-- Collapsible details -->
                        <div class="transition-all duration-700 overflow-hidden text-left"
                             :class="activeZone === 'jungle' ? 'max-h-40 opacity-100 mt-4' : 'max-h-0 opacity-0'">
                            <p class="text-zinc-300 text-xs font-light leading-relaxed mb-4 max-w-md">
                                Enter the dense vegetation of Mount Kilimanjaro's foothills. Wet, misty, and bustling with apex predators hiding within the shadow play of old tree lines.
                            </p>
                            <div class="flex gap-3 text-[10px] font-mono text-gold-300">
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">TEMP: 26°C</span>
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">SPECIES: 1,420 SECURED</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ocean World Panel -->
                <div class="relative overflow-hidden rounded-2xl border transition-all duration-700 ease-out cursor-pointer flex-1 flex flex-col justify-end p-8"
                     :class="activeZone === 'ocean' ? 'lg:grow-[2.5] border-gold-500/40 shadow-2xl bg-forest-950/40' : 'lg:grow-[0.8] border-white/5 bg-forest-950/20'"
                     @mouseover="activeZone = 'ocean'">
                    
                    <!-- Background image -->
                    <img src="{{ asset('images/category_ocean.png') }}" alt="Ocean World" class="absolute inset-0 w-full h-full object-cover transition-all duration-1000"
                         :class="activeZone === 'ocean' ? 'scale-105 brightness-[0.70] contrast-[1.05]' : 'brightness-[0.40] scale-100'">
                    <div class="absolute inset-0 bg-gradient-to-t from-moss-950 via-moss-950/20 to-transparent z-10"></div>
                    
                    <!-- Coordinates tag -->
                    <div class="absolute top-6 left-6 z-20 font-mono transition-all duration-500"
                         :class="activeZone === 'ocean' ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">
                        <span class="coords-tag">COORD: 20.0123° N, 155.6721° W</span>
                    </div>

                    <!-- Panel Info -->
                    <div class="relative z-20">
                        <span class="text-[9px] tracking-[0.3em] font-mono text-gold-400 uppercase">ZONE 02 / PACIFIC TRENCH</span>
                        <h3 class="font-serif text-2xl md:text-3xl font-bold text-white mt-1">Ocean World</h3>
                        
                        <!-- Collapsible details -->
                        <div class="transition-all duration-700 overflow-hidden text-left"
                             :class="activeZone === 'ocean' ? 'max-h-40 opacity-100 mt-4' : 'max-h-0 opacity-0'">
                            <p class="text-zinc-300 text-xs font-light leading-relaxed mb-4 max-w-md">
                                Descend into the bioluminescent twilight layers off Hawaii. Explore the silent dark abyss, observing translucent marine entities and whales.
                            </p>
                            <div class="flex gap-3 text-[10px] font-mono text-gold-300">
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">TEMP: 4°C</span>
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">DEPTH: 3,200M</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bird Paradise Panel -->
                <div class="relative overflow-hidden rounded-2xl border transition-all duration-700 ease-out cursor-pointer flex-1 flex flex-col justify-end p-8"
                     :class="activeZone === 'birds' ? 'lg:grow-[2.5] border-gold-500/40 shadow-2xl bg-forest-950/40' : 'lg:grow-[0.8] border-white/5 bg-forest-950/20'"
                     @mouseover="activeZone = 'birds'">
                    
                    <!-- Background image -->
                    <img src="{{ asset('images/category_birds.png') }}" alt="Bird Paradise" class="absolute inset-0 w-full h-full object-cover transition-all duration-1000"
                         :class="activeZone === 'birds' ? 'scale-105 brightness-[0.70] contrast-[1.05]' : 'brightness-[0.40] scale-100'">
                    <div class="absolute inset-0 bg-gradient-to-t from-moss-950 via-moss-950/20 to-transparent z-10"></div>
                    
                    <!-- Coordinates tag -->
                    <div class="absolute top-6 left-6 z-20 font-mono transition-all duration-500"
                         :class="activeZone === 'birds' ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">
                        <span class="coords-tag">COORD: 0.7892° S, 77.8921° W</span>
                    </div>

                    <!-- Panel Info -->
                    <div class="relative z-20">
                        <span class="text-[9px] tracking-[0.3em] font-mono text-gold-400 uppercase">ZONE 03 / ANDEAN CLOUD</span>
                        <h3 class="font-serif text-2xl md:text-3xl font-bold text-white mt-1">Bird Paradise</h3>
                        
                        <!-- Collapsible details -->
                        <div class="transition-all duration-700 overflow-hidden text-left"
                             :class="activeZone === 'birds' ? 'max-h-40 opacity-100 mt-4' : 'max-h-0 opacity-0'">
                            <p class="text-zinc-300 text-xs font-light leading-relaxed mb-4 max-w-md">
                                Climb to the misty forest canopies in Ecuador. Listen to intricate vocalizations and witness the neon plumage of exotic species.
                            </p>
                            <div class="flex gap-3 text-[10px] font-mono text-gold-300">
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">TEMP: 19°C</span>
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">ELEVATION: 2,100M</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Arctic Life Panel -->
                <div class="relative overflow-hidden rounded-2xl border transition-all duration-700 ease-out cursor-pointer flex-1 flex flex-col justify-end p-8"
                     :class="activeZone === 'arctic' ? 'lg:grow-[2.5] border-gold-500/40 shadow-2xl bg-forest-950/40' : 'lg:grow-[0.8] border-white/5 bg-forest-950/20'"
                     @mouseover="activeZone = 'arctic'">
                    
                    <!-- Background image -->
                    <img src="{{ asset('images/category_arctic.png') }}" alt="Arctic Life" class="absolute inset-0 w-full h-full object-cover transition-all duration-1000"
                         :class="activeZone === 'arctic' ? 'scale-105 brightness-[0.70] contrast-[1.05]' : 'brightness-[0.40] scale-100'">
                    <div class="absolute inset-0 bg-gradient-to-t from-moss-950 via-moss-950/20 to-transparent z-10"></div>
                    
                    <!-- Coordinates tag -->
                    <div class="absolute top-6 left-6 z-20 font-mono transition-all duration-500"
                         :class="activeZone === 'arctic' ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">
                        <span class="coords-tag">COORD: 68.3289° N, 18.8312° E</span>
                    </div>

                    <!-- Panel Info -->
                    <div class="relative z-20">
                        <span class="text-[9px] tracking-[0.3em] font-mono text-gold-400 uppercase">ZONE 04 / SWEDISH LAPLAND</span>
                        <h3 class="font-serif text-2xl md:text-3xl font-bold text-white mt-1">Arctic Life</h3>
                        
                        <!-- Collapsible details -->
                        <div class="transition-all duration-700 overflow-hidden text-left"
                             :class="activeZone === 'arctic' ? 'max-h-40 opacity-100 mt-4' : 'max-h-0 opacity-0'">
                            <p class="text-zinc-300 text-xs font-light leading-relaxed mb-4 max-w-md">
                                Enter the sub-zero taiga under the aurora borealis. Observe wolves and bears navigating fields of powder snow and frozen waterways.
                            </p>
                            <div class="flex gap-3 text-[10px] font-mono text-gold-300">
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">TEMP: -14°C</span>
                                <span class="px-2 py-1 rounded bg-forest-800/80 border border-white/5">WIND: 22 KM/H</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Did You Know? - Redesigned as Expedition Field Log Tabs -->
    <section id="logs" class="relative py-28 bg-gradient-to-b from-forest-900 to-moss-950 border-t border-white/5 z-20" x-data="{ currentLog: 0 }">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="text-xs font-mono tracking-[0.3em] text-gold-500 uppercase">TELEMETRY DATA</span>
                <h2 class="font-serif text-3xl md:text-5xl font-bold mt-2 text-white">Expedition Logs</h2>
                <div class="w-16 h-[2px] bg-gold-500/40 mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                
                <!-- Left Tab Selector: field logs -->
                <div class="lg:col-span-4 flex flex-col gap-4">
                    <button @click="currentLog = 0" 
                            class="text-left p-6 rounded-xl border transition-all duration-500 flex items-center justify-between"
                            :class="currentLog === 0 ? 'bg-forest-800/80 border-gold-500/40 shadow-xl' : 'bg-forest-900/20 border-white/5 hover:border-white/10'">
                        <div class="font-mono">
                            <span class="text-[9px]" :class="currentLog === 0 ? 'text-gold-400 font-bold' : 'text-zinc-500'">LOG #022 // OCEAN</span>
                            <h4 class="font-serif text-lg text-white mt-1">Heart of a Giant</h4>
                        </div>
                        <span class="text-xl" :class="currentLog === 0 ? 'text-gold-400' : 'text-zinc-600'">➔</span>
                    </button>

                    <button @click="currentLog = 1" 
                            class="text-left p-6 rounded-xl border transition-all duration-500 flex items-center justify-between"
                            :class="currentLog === 1 ? 'bg-forest-800/80 border-gold-500/40 shadow-xl' : 'bg-forest-900/20 border-white/5 hover:border-white/10'">
                        <div class="font-mono">
                            <span class="text-[9px]" :class="currentLog === 1 ? 'text-gold-400 font-bold' : 'text-zinc-500'">LOG #084 // AVIAN</span>
                            <h4 class="font-serif text-lg text-white mt-1">High Speed stoop</h4>
                        </div>
                        <span class="text-xl" :class="currentLog === 1 ? 'text-gold-400' : 'text-zinc-600'">➔</span>
                    </button>

                    <button @click="currentLog = 2" 
                            class="text-left p-6 rounded-xl border transition-all duration-500 flex items-center justify-between"
                            :class="currentLog === 2 ? 'bg-forest-800/80 border-gold-500/40 shadow-xl' : 'bg-forest-900/20 border-white/5 hover:border-white/10'">
                        <div class="font-mono">
                            <span class="text-[9px]" :class="currentLog === 2 ? 'text-gold-400 font-bold' : 'text-zinc-500'">LOG #109 // PREDATOR</span>
                            <h4 class="font-serif text-lg text-white mt-1">Silent Conversations</h4>
                        </div>
                        <span class="text-xl" :class="currentLog === 2 ? 'text-gold-400' : 'text-zinc-600'">➔</span>
                    </button>
                </div>

                <!-- Right Detailed Journal Page (Removing solid black spaces with grid & borders) -->
                <div class="lg:col-span-8 glass-panel rounded-2xl border border-white/10 p-8 md:p-12 relative overflow-hidden flex flex-col justify-between shadow-2xl">
                    
                    <!-- Background faint topographic lines overlay or sunshaft -->
                    <div class="absolute right-0 top-0 w-80 h-80 bg-gold-500/5 rounded-full filter blur-[80px]"></div>

                    <!-- Slide 1 details -->
                    <div x-show="currentLog === 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-6">
                            <span class="coords-tag">SANCTUARY COORDS: 40.7128° N, 74.0060° W</span>
                            <span class="text-zinc-500 font-mono text-xs">RECORDED BY: FIELD-UNIT D</span>
                        </div>
                        <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-2">PACIFIC OCEAN BLUE WHALE REPORT</span>
                        <h3 class="font-serif text-3xl font-bold text-white mb-6">Heart of a Giant</h3>
                        <p class="text-zinc-300 text-sm leading-relaxed font-light mb-6">
                            A blue whale's heart is massive—weighing roughly 400 pounds. It is comparable in size to a small automobile. Its primary aorta alone is wide enough for a human child to crawl through. 
                        </p>
                        <p class="text-zinc-300 text-sm leading-relaxed font-light">
                            To pump blood throughout its 100-foot body, the heart only beats 8 to 10 times per minute when the whale is at the ocean surface, but its pulse can be detected from over two miles away by specialized acoustic hydrophones.
                        </p>
                    </div>

                    <!-- Slide 2 details -->
                    <div x-show="currentLog === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-6">
                            <span class="coords-tag">CANOPY COORDS: 1.2091° S, 78.3289° W</span>
                            <span class="text-zinc-500 font-mono text-xs">RECORDED BY: AVIAN-NET B</span>
                        </div>
                        <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-2">PEREGRINE FALCON FLIGHT PARAMETERS</span>
                        <h3 class="font-serif text-3xl font-bold text-white mb-6">High Speed Hunter</h3>
                        <p class="text-zinc-300 text-sm leading-relaxed font-light mb-6">
                            The Peregrine Falcon is the fastest member of the animal kingdom. During its characteristic hunting dive, known as the stoop, it drops through the air at speeds exceeding 240 miles per hour (386 km/h).
                        </p>
                        <p class="text-zinc-300 text-sm leading-relaxed font-light">
                            To survive the extreme air pressure at this velocity, the falcon's nostrils are equipped with baffle-like cartilage cones that slow down the airflow, allowing the bird to breathe comfortably without damaging its lungs.
                        </p>
                    </div>

                    <!-- Slide 3 details -->
                    <div x-show="currentLog === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-6">
                            <span class="coords-tag">WETLAND COORDS: 15.3892° S, 56.4712° W</span>
                            <span class="text-zinc-500 font-mono text-xs">RECORDED BY: FIELD-CAM 08</span>
                        </div>
                        <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-2">FELID ACOUSTIC PARAMETER STUDY</span>
                        <h3 class="font-serif text-3xl font-bold text-white mb-6">Silent Conversations</h3>
                        <p class="text-zinc-300 text-sm leading-relaxed font-light mb-6">
                            Cheetahs are unique among large felines as they cannot roar. The hyoid bone in their throat is rigid, which permits intense, continuous purring (both during inhalation and exhalation) but prevents the vibrating roar of lions.
                        </p>
                        <p class="text-zinc-300 text-sm leading-relaxed font-light">
                            To communicate across distances, they instead utilize high-pitched bird-like chirps, yelps, and soft purrs when interacting with cubs, keeping them hidden from larger predators in the savannah.
                        </p>
                    </div>

                    <div class="mt-8 border-t border-white/10 pt-6 flex justify-between items-center text-xs font-mono">
                        <span class="text-zinc-500">EXPEDITION ARCHIVES // DECLASSIFIED</span>
                        <a href="#" class="text-gold-500 hover:text-gold-400 transition-colors flex items-center gap-2">
                            <span>ACCESS COMPLETE DATABASE</span>
                            <span>➔</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Overhauled Featured Species Showcase (Visual Layering & Details) -->
    <section id="featured" class="relative py-28 bg-moss-950 z-20 border-t border-white/5" x-data="{ currentShow: 'leopard' }">
        
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-[1px] bg-gold-500/50"></span>
                        <span class="text-xs font-mono tracking-[0.3em] text-gold-500 uppercase">CONSERVATION REGISTRY</span>
                    </div>
                    <h2 class="font-serif text-3xl md:text-5xl font-bold mt-2 text-white">Expedition Showcase</h2>
                    <div class="w-16 h-[2px] bg-gold-500/40 mt-4"></div>
                </div>
                <p class="max-w-md text-zinc-400 text-sm mt-4 md:mt-0 font-light leading-relaxed">
                    Examine rare species in detail. Our platform connects you with active telemetry projects to monitor animal movements and vital statistics.
                </p>
            </div>

            <!-- Intersecting Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                <!-- Left Tab Selectors -->
                <div class="lg:col-span-4 flex flex-col gap-4">
                    
                    <!-- Leopard button -->
                    <div @click="currentShow = 'leopard'" 
                         class="p-6 rounded-xl border cursor-pointer transition-all duration-500 text-left"
                         :class="currentShow === 'leopard' ? 'bg-forest-900 border-gold-500/30' : 'bg-forest-950/20 border-white/5 hover:border-white/10'">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-mono text-zinc-500">01 / CENTRAL ASIA</span>
                            <span class="px-2 py-0.5 rounded bg-red-950/80 text-red-300 font-mono text-[8px] border border-red-500/20">VULNERABLE</span>
                        </div>
                        <h4 class="font-serif text-lg font-bold mt-2" :class="currentShow === 'leopard' ? 'text-white' : 'text-zinc-400 hover:text-zinc-200'">Snow Leopard</h4>
                        <p class="text-xs text-zinc-500 mt-2 font-light line-clamp-2">Solitary predator of steep high-altitude rocky peaks.</p>
                    </div>

                    <!-- Tiger button -->
                    <div @click="currentShow = 'tiger'" 
                         class="p-6 rounded-xl border cursor-pointer transition-all duration-500 text-left"
                         :class="currentShow === 'tiger' ? 'bg-forest-900 border-gold-500/30' : 'bg-forest-950/20 border-white/5 hover:border-white/10'">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-mono text-zinc-500">02 / SOUTHEAST ASIA</span>
                            <span class="px-2 py-0.5 rounded bg-red-950/80 text-red-300 font-mono text-[8px] border border-red-500/20">ENDANGERED</span>
                        </div>
                        <h4 class="font-serif text-lg font-bold mt-2" :class="currentShow === 'tiger' ? 'text-white' : 'text-zinc-400 hover:text-zinc-200'">Bengal Tiger</h4>
                        <p class="text-xs text-zinc-500 mt-2 font-light line-clamp-2">The majestic striped hunter of sundarban swamps.</p>
                    </div>

                    <!-- Penguin button -->
                    <div @click="currentShow = 'penguin'" 
                         class="p-6 rounded-xl border cursor-pointer transition-all duration-500 text-left"
                         :class="currentShow === 'penguin' ? 'bg-forest-900 border-gold-500/30' : 'bg-forest-950/20 border-white/5 hover:border-white/10'">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-mono text-zinc-500">03 / ANTARCTIC TUNDRA</span>
                            <span class="px-2 py-0.5 rounded bg-yellow-950/80 text-yellow-300 font-mono text-[8px] border border-yellow-500/20">NEAR THREATENED</span>
                        </div>
                        <h4 class="font-serif text-lg font-bold mt-2" :class="currentShow === 'penguin' ? 'text-white' : 'text-zinc-400 hover:text-zinc-200'">Emperor Penguin</h4>
                        <p class="text-xs text-zinc-500 mt-2 font-light line-clamp-2">Resilient navigators of the southern polar pack ice.</p>
                    </div>

                </div>

                <!-- Right Big Featured Details Layout -->
                <div class="lg:col-span-8 relative rounded-2xl overflow-hidden border border-white/10 shadow-2xl min-h-[500px] flex flex-col justify-end">
                    
                    <!-- Leopard details -->
                    <div x-show="currentShow === 'leopard'" class="absolute inset-0 z-0">
                        <img src="{{ asset('images/featured_snow_leopard.png') }}" alt="Snow Leopard" class="w-full h-full object-cover">
                    </div>

                    <!-- Tiger details (fallback image) -->
                    <div x-show="currentShow === 'tiger'" class="absolute inset-0 z-0" style="display: none;">
                        <img src="{{ asset('images/category_jungle.png') }}" alt="Bengal Tiger" class="w-full h-full object-cover">
                    </div>

                    <!-- Penguin details (fallback image) -->
                    <div x-show="currentShow === 'penguin'" class="absolute inset-0 z-0" style="display: none;">
                        <img src="{{ asset('images/category_arctic.png') }}" alt="Emperor Penguin" class="w-full h-full object-cover">
                    </div>

                    <!-- Linear vignette to make details legible -->
                    <div class="absolute inset-0 bg-gradient-to-t from-moss-950 via-moss-950/65 to-transparent z-10"></div>
                    <div class="absolute top-6 right-6 z-20 font-mono">
                        <span class="coords-tag">ACTIVE SANCTUARY FEED</span>
                    </div>

                    <!-- Details Card (Overlaid at bottom of panel) -->
                    <div class="relative z-20 p-8 md:p-12 text-left">
                        
                        <!-- Details Leopard -->
                        <div x-show="currentShow === 'leopard'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-2">SPECIES REGISTRY</span>
                            <h3 class="font-serif text-3xl md:text-4xl font-bold text-white mb-2">Snow Leopard</h3>
                            <p class="text-xs italic text-zinc-400 font-serif mb-6">Panthera uncia</p>
                            <p class="text-zinc-300 text-sm font-light leading-relaxed max-w-xl mb-8">
                                Navigating high alpine peaks in central Asia. Their thick rosette-spotted fur acts as thermal armor, and their elongated heavy tail provides essential balance across steep icy slopes.
                            </p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 border-t border-white/10 pt-6 font-mono text-xs">
                                <div>
                                    <span class="text-zinc-500 block">EST. WORLDWIDE</span>
                                    <span class="text-white text-base font-serif font-bold mt-1">4,000 - 6,500</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">ALTITUDE RANGE</span>
                                    <span class="text-white text-base font-serif font-bold mt-1">3,000m - 5,400m</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">PRIMARY THREAT</span>
                                    <span class="text-red-400 text-base font-serif font-bold mt-1">Habitat Loss</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">CONSERVATION LINK</span>
                                    <a href="#" class="text-gold-400 hover:text-gold-300 block font-bold mt-1">SUPPORT FEED ➔</a>
                                </div>
                            </div>
                        </div>

                        <!-- Details Tiger -->
                        <div x-show="currentShow === 'tiger'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-2">SPECIES REGISTRY</span>
                            <h3 class="font-serif text-3xl md:text-4xl font-bold text-white mb-2">Bengal Tiger</h3>
                            <p class="text-xs italic text-zinc-400 font-serif mb-6">Panthera tigris tigris</p>
                            <p class="text-zinc-300 text-sm font-light leading-relaxed max-w-xl mb-8">
                                Stalking prey through the mangrove swamps of the Sundarbans. Excellent swimmers, these tigers are apex predators of the riverine channels, relying on stealth and incredible muscle power.
                            </p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 border-t border-white/10 pt-6 font-mono text-xs">
                                <div>
                                    <span class="text-zinc-500 block">EST. WORLDWIDE</span>
                                    <span class="text-white text-base font-serif font-bold mt-1">3,500 - 4,000</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">ALTITUDE RANGE</span>
                                    <span class="text-white text-base font-serif font-bold mt-1">Sea Level - 100m</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">PRIMARY THREAT</span>
                                    <span class="text-red-400 text-base font-serif font-bold mt-1">Poaching / Sea Rise</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">CONSERVATION LINK</span>
                                    <a href="#" class="text-gold-400 hover:text-gold-300 block font-bold mt-1">SUPPORT FEED ➔</a>
                                </div>
                            </div>
                        </div>

                        <!-- Details Penguin -->
                        <div x-show="currentShow === 'penguin'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-2">SPECIES REGISTRY</span>
                            <h3 class="font-serif text-3xl md:text-4xl font-bold text-white mb-2">Emperor Penguin</h3>
                            <p class="text-xs italic text-zinc-400 font-serif mb-6">Aptenodytes forsteri</p>
                            <p class="text-zinc-300 text-sm font-light leading-relaxed max-w-xl mb-8">
                                Breeding in the coldest marine biomes on earth. They survive temperatures as low as -60°C by huddling in compact communal groups, and can dive to depths of 500 meters to hunt fish.
                            </p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 border-t border-white/10 pt-6 font-mono text-xs">
                                <div>
                                    <span class="text-zinc-500 block">EST. WORLDWIDE</span>
                                    <span class="text-white text-base font-serif font-bold mt-1">280,000 - 320,000</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">ALTITUDE RANGE</span>
                                    <span class="text-white text-base font-serif font-bold mt-1">Sea Level / Ice Pack</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">PRIMARY THREAT</span>
                                    <span class="text-red-400 text-base font-serif font-bold mt-1">Ice Melting</span>
                                </div>
                                <div>
                                    <span class="text-zinc-500 block">CONSERVATION LINK</span>
                                    <a href="#" class="text-gold-400 hover:text-gold-300 block font-bold mt-1">SUPPORT FEED ➔</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Immersive Deep Forest Footer (Removes blank borders) -->
    <footer class="relative bg-moss-950 text-zinc-400 border-t border-gold-500/10 py-20 z-20">
        
        <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-forest-950/10 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                
                <!-- Column 1: Brand & Coordinates -->
                <div class="md:col-span-5">
                    <a href="#" class="flex items-center gap-3 mb-6">
                        <span class="p-2 rounded-lg bg-gold-500/10 border border-gold-500/20 text-gold-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l4.038 3.332a.75.75 0 0 1 .288.583v4.61a.75.75 0 0 1-.288.583l-4.038 3.331a1.125 1.125 0 0 0-.405.864v.568M11.25 3.03v.568c0 .334-.148.65-.405.864L6.807 7.794a.75.75 0 0 0-.288.583v4.61a.75.75 0 0 0 .288.583l4.038 3.331c.257.213.405.53.405.864v.568m-1.5 12h3m-3-18h3m-9 6h15" />
                            </svg>
                        </span>
                        <div class="flex flex-col text-left">
                            <span class="font-serif tracking-widest text-lg font-bold text-white">WILDVERSE</span>
                            <span class="text-[8px] tracking-[0.3em] text-gold-500 font-mono -mt-1">SYS.LOC: ONLINE</span>
                        </div>
                    </a>
                    <p class="text-sm text-zinc-400 font-light leading-relaxed max-w-sm mb-8">
                        A digital sanctuary dedicated to virtual wildlife exploration. We combine field cameras, geographical coordinates, and premium telemetry to connect people emotionally with nature.
                    </p>
                    
                    <!-- Social icons -->
                    <div class="flex gap-4">
                        <a href="#" class="p-3 rounded-full bg-white/5 hover:bg-gold-500/10 hover:text-gold-400 border border-white/5 hover:border-gold-500/30 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="p-3 rounded-full bg-white/5 hover:bg-gold-500/10 hover:text-gold-400 border border-white/5 hover:border-gold-500/30 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.518 3.545 12 3.545 12 3.545s-7.518 0-9.388.507a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.87.507 9.388.507 9.388.507s7.518 0 9.388-.507a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="p-3 rounded-full bg-white/5 hover:bg-gold-500/10 hover:text-gold-400 border border-white/5 hover:border-gold-500/30 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div class="md:col-span-3">
                    <h5 class="text-white text-xs font-mono tracking-[0.25em] uppercase mb-6">SANCTUARIES</h5>
                    <ul class="flex flex-col gap-4 text-sm font-light">
                        <li><a href="#explore" class="hover:text-gold-400 transition-colors">Kilimanjaro Jungle Zone</a></li>
                        <li><a href="#explore" class="hover:text-gold-400 transition-colors">Pacific Abyssal Deep</a></li>
                        <li><a href="#explore" class="hover:text-gold-400 transition-colors">Lapland Polar Tundra</a></li>
                        <li><a href="#explore" class="hover:text-gold-400 transition-colors">Andean Canopy Zone</a></li>
                    </ul>
                </div>

                <!-- Column 3: Newsletter Sign-up -->
                <div class="md:col-span-4">
                    <h5 class="text-white text-xs font-mono tracking-[0.25em] uppercase mb-6">NEWSLETTER</h5>
                    <p class="text-xs text-zinc-500 mb-6 font-light leading-relaxed">
                        Join the expedition newsletter to receive coordinates, monthly migration logs, and rare animal parameters.
                    </p>
                    <form class="flex flex-col gap-3">
                        <input type="email" placeholder="EXPEDITION-MEMBER@EMAIL.COM" class="px-5 py-3 rounded-full bg-white/5 border border-white/10 text-xs font-mono text-white placeholder-zinc-600 focus:outline-none focus:border-gold-500/40 focus:ring-1 focus:ring-gold-500/20">
                        <button type="submit" class="py-3 px-6 rounded-full bg-gold-500 text-forest-950 text-xs font-bold tracking-[0.2em] hover:brightness-110 transition-all duration-300">
                            SIGN UP
                        </button>
                    </form>
                </div>
                
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-white/5 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-zinc-600">
                <p>&copy; 2026 WildVerse Expedition. All rights reserved.</p>
                <div class="flex gap-6 mt-4 sm:mt-0 font-mono">
                    <a href="#" class="hover:text-zinc-400 transition-colors">PRIVACY POLICY</a>
                    <a href="#" class="hover:text-zinc-400 transition-colors">TERMS OF USE</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
