@extends('layouts.app')

@section('content')
    <!-- Premium Page Header -->
    <div class="relative pt-36 pb-16 overflow-hidden z-20">
        <!-- Subtle glow effects -->
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gold-500/5 rounded-full filter blur-[100px] pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-xs font-mono tracking-[0.3em] text-gold-500 uppercase">TELEMETRY DATA</span>
            <h1 class="font-serif text-4xl md:text-6xl font-bold text-white mt-4 mb-6">Wildlife Facts</h1>
            <div class="w-16 h-[2px] bg-gold-500/40 mx-auto mb-6"></div>
            <p class="text-zinc-400 text-sm md:text-base font-light leading-relaxed max-w-2xl mx-auto">
                Dive deep into the educational and scientific findings recorded by our field telemetry units. Explore high-interest facts regarding anatomy, behaviors, and adaptations.
            </p>
        </div>
    </div>

    <!-- Did You Know? - Expedition Field Log Tabs -->
    <section class="relative py-16 bg-gradient-to-b from-forest-900 to-moss-950 border-t border-white/5 z-20" x-data="{ currentLog: 0 }">
        <div class="max-w-7xl mx-auto px-6">
            
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
                            <h4 class="font-serif text-lg text-white mt-1">High Speed Stoop</h4>
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

                <!-- Right Detailed Journal Page -->
                <div class="lg:col-span-8 glass-panel rounded-2xl border border-white/10 p-8 md:p-12 relative overflow-hidden flex flex-col justify-between shadow-2xl">
                    
                    <!-- Background faint topographic lines overlay or sunshaft -->
                    <div class="absolute right-0 top-0 w-80 h-80 bg-gold-500/5 rounded-full filter blur-[80px]"></div>

                    <!-- Slide 1 details -->
                    <div x-show="currentLog === 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-6">
                            <span class="coords-tag">SANCTUARY COORDS: 20.0123° N, 155.6721° W</span>
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
                            <span class="coords-tag">CANOPY COORDS: 0.7892° S, 77.8921° W</span>
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
                            <span class="coords-tag">WETLAND COORDS: 3.0674° S, 37.3556° E</span>
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
                        <a href="{{ route('animals') }}" class="text-gold-500 hover:text-gold-400 transition-colors flex items-center gap-2">
                            <span>ACCESS COMPLETE SPECIES REGISTRY</span>
                            <span>➔</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
