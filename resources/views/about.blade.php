@extends('layouts.app')

@section('content')
    <!-- Premium Page Header -->
    <div class="relative pt-36 pb-16 overflow-hidden z-20">
        <!-- Subtle glow effects -->
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gold-500/5 rounded-full filter blur-[100px] pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-xs font-mono tracking-[0.3em] text-gold-500 uppercase">PROJECT OBJECTIVE</span>
            <h1 class="font-serif text-4xl md:text-6xl font-bold text-white mt-4 mb-6">About WildVerse</h1>
            <div class="w-16 h-[2px] bg-gold-500/40 mx-auto mb-6"></div>
            <p class="text-zinc-400 text-sm md:text-base font-light leading-relaxed max-w-2xl mx-auto">
                WildVerse is an interactive virtual zoo experience built to foster emotional connections with our planet's most vulnerable species and habitats through digital preservation.
            </p>
        </div>
    </div>

    <!-- Narrative Storytelling Section -->
    <section class="relative py-16 bg-gradient-to-b from-moss-950 via-forest-950 to-forest-900 z-20 overflow-hidden border-t border-white/5">
        
        <!-- Subtle warm ambient lighting shaft -->
        <div class="absolute right-0 top-0 w-96 h-96 bg-gold-500/5 rounded-full filter blur-[120px] pointer-events-none"></div>
        <div class="absolute left-0 bottom-0 w-96 h-96 bg-forest-500/10 rounded-full filter blur-[150px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                
                <!-- Left overlapping panel containing narrative details -->
                <div class="lg:col-span-6 relative z-10 text-left">
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
                        <div class="absolute inset-0 bg-gradient-to-t from-moss-950 via-moss-950/20 to-transparent z-10"></div>
                        
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

    <!-- Additional Conservation Goals & Platform Objectives Section -->
    <section class="relative py-20 bg-forest-950 border-t border-white/5 z-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-left">
                <!-- Objective 1 -->
                <div class="p-8 rounded-2xl glass-panel border border-white/5">
                    <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-4">01 / EDUCATING GEN-Z</span>
                    <h3 class="font-serif text-xl font-bold text-white mb-4">Educational Access</h3>
                    <p class="text-zinc-400 text-xs font-light leading-relaxed">
                        Offering school groups, researchers, and nature enthusiasts around the globe remote telemetry profiles of species and real-time environment metrics to power the next generation of biologists.
                    </p>
                </div>
                <!-- Objective 2 -->
                <div class="p-8 rounded-2xl glass-panel border border-white/5">
                    <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-4">02 / DECARBONIZED OBSERVATION</span>
                    <h3 class="font-serif text-xl font-bold text-white mb-4">Sustainable Tourism</h3>
                    <p class="text-zinc-400 text-xs font-light leading-relaxed">
                        Reduce carbon footprints and local ecosystem wear by augmenting physical tourism with non-invasive digital exploration, protecting vulnerable biomes from traffic damage.
                    </p>
                </div>
                <!-- Objective 3 -->
                <div class="p-8 rounded-2xl glass-panel border border-white/5">
                    <span class="text-xs font-mono text-gold-400 uppercase tracking-widest block mb-4">03 / CONSERVATION PARTNERSHIPS</span>
                    <h3 class="font-serif text-xl font-bold text-white mb-4">Global Philanthropy</h3>
                    <p class="text-zinc-400 text-xs font-light leading-relaxed">
                        Direct support links route donations directly to wildlife organizations managing camera traps, anti-poaching units, and habitat restoration efforts in the field.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
