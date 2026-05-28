<section id="facts" class="relative py-24 bg-gradient-to-b from-[#0a120d] via-[#121c11] to-[#0a140f] border-t border-white/5 scroll-mt-16">
    <!-- Ambient lighting -->
    <div class="absolute right-0 top-1/3 w-80 h-80 bg-amber-500/5 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="absolute left-0 bottom-1/3 w-80 h-80 bg-emerald-500/5 rounded-full filter blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block text-xs font-mono tracking-[0.3em] text-gold-400 font-bold mb-3 uppercase">
            💡 AMAZING ANIMAL TRIVIA
        </span>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-bold leading-tight mb-4">
            Did You Know?
        </h2>
        <p class="text-zinc-300 text-sm md:text-base leading-relaxed font-light max-w-2xl mx-auto mb-16">
            Click any of the cards below to flip them and reveal a secret fun fact about the animal world!
        </p>

        <!-- Trivia Flip Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Flip Card 1 -->
            <div x-data="{ flipped: false }" 
                 @click="flipped = !flipped" 
                 class="perspective-1000 w-full h-64 cursor-pointer group">
                <div class="relative w-full h-full duration-500 transform-style-3d transition-transform" 
                     :class="flipped ? 'rotate-y-180' : ''">
                    
                    <!-- Front Side -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-8 flex flex-col justify-between backface-hidden shadow-lg border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                        <div class="text-left">
                            <span class="text-4xl block mb-4">🦦</span>
                            <h4 class="font-serif text-xl font-bold text-white leading-snug">
                                Which furry animal holds hands while sleeping?
                            </h4>
                        </div>
                        <div class="text-right text-xs font-mono text-gold-400 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                    <!-- Back Side (Flipped) -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-gold-500 to-amber-600 p-8 flex flex-col justify-between backface-hidden rotate-y-180 shadow-lg border border-gold-300/30">
                        <div class="text-left text-forest-950">
                            <span class="text-3xl block mb-2">Sea Otters! 🦦</span>
                            <p class="text-sm font-medium leading-relaxed">
                                Sea Otters hold hands with each other while taking naps in the water so they don't drift apart in the ocean currents!
                            </p>
                        </div>
                        <div class="text-right text-xs font-mono text-forest-950/80 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                </div>
            </div>

            <!-- Flip Card 2 -->
            <div x-data="{ flipped: false }" 
                 @click="flipped = !flipped" 
                 class="perspective-1000 w-full h-64 cursor-pointer group">
                <div class="relative w-full h-full duration-500 transform-style-3d transition-transform" 
                     :class="flipped ? 'rotate-y-180' : ''">
                    
                    <!-- Front Side -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-8 flex flex-col justify-between backface-hidden shadow-lg border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                        <div class="text-left">
                            <span class="text-4xl block mb-4">🦜</span>
                            <h4 class="font-serif text-xl font-bold text-white leading-snug">
                                Which amazing bird is able to fly backwards?
                            </h4>
                        </div>
                        <div class="text-right text-xs font-mono text-gold-400 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                    <!-- Back Side (Flipped) -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-gold-500 to-amber-600 p-8 flex flex-col justify-between backface-hidden rotate-y-180 shadow-lg border border-gold-300/30">
                        <div class="text-left text-forest-950">
                            <span class="text-3xl block mb-2">Hummingbirds! 🦜</span>
                            <p class="text-sm font-medium leading-relaxed">
                                Hummingbirds are the only birds in the world that can fly backwards, sideways, and even hang upside down in the air!
                            </p>
                        </div>
                        <div class="text-right text-xs font-mono text-forest-950/80 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                </div>
            </div>

            <!-- Flip Card 3 -->
            <div x-data="{ flipped: false }" 
                 @click="flipped = !flipped" 
                 class="perspective-1000 w-full h-64 cursor-pointer group">
                    <div class="relative w-full h-full duration-500 transform-style-3d transition-transform" 
                         :class="flipped ? 'rotate-y-180' : ''">
                        
                        <!-- Front Side -->
                        <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-8 flex flex-col justify-between backface-hidden shadow-lg border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                            <div class="text-left">
                                <span class="text-4xl block mb-4">🐘</span>
                                <h4 class="font-serif text-xl font-bold text-white leading-snug">
                                    How do elephant friends greet each other?
                                </h4>
                            </div>
                            <div class="text-right text-xs font-mono text-gold-400 font-bold uppercase tracking-wider">
                                Click to Flip ↻
                            </div>
                        </div>

                        <!-- Back Side (Flipped) -->
                        <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-gold-500 to-amber-600 p-8 flex flex-col justify-between backface-hidden rotate-y-180 shadow-lg border border-gold-300/30">
                            <div class="text-left text-forest-950">
                                <span class="text-3xl block mb-2">Trunk Hugs! 🐘</span>
                                <p class="text-sm font-medium leading-relaxed">
                                    Elephants greet each other by wrapping their trunks together! It is the elephant version of a warm handshake or hug.
                                </p>
                            </div>
                            <div class="text-right text-xs font-mono text-forest-950/80 font-bold uppercase tracking-wider">
                                Click to Flip ↻
                            </div>
                        </div>

                    </div>
                </div>

            <!-- Flip Card 4 -->
            <div x-data="{ flipped: false }" 
                 @click="flipped = !flipped" 
                 class="perspective-1000 w-full h-64 cursor-pointer group">
                <div class="relative w-full h-full duration-500 transform-style-3d transition-transform" 
                     :class="flipped ? 'rotate-y-180' : ''">
                    
                    <!-- Front Side -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-8 flex flex-col justify-between backface-hidden shadow-lg border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                        <div class="text-left">
                            <span class="text-4xl block mb-4">🐸</span>
                            <h4 class="font-serif text-xl font-bold text-white leading-snug">
                                Can frogs survive being frozen like ice cubes?
                            </h4>
                        </div>
                        <div class="text-right text-xs font-mono text-gold-400 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                    <!-- Back Side (Flipped) -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-gold-500 to-amber-600 p-8 flex flex-col justify-between backface-hidden rotate-y-180 shadow-lg border border-gold-300/30">
                        <div class="text-left text-forest-950">
                            <span class="text-3xl block mb-2">Yes! The Wood Frog 🐸</span>
                            <p class="text-sm font-medium leading-relaxed">
                                The Alaskan Wood Frog can freeze solid in winter (its heart even stops beating!) and then simply thaw out and hop away in spring!
                            </p>
                        </div>
                        <div class="text-right text-xs font-mono text-forest-950/80 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                </div>
            </div>

            <!-- Flip Card 5 -->
            <div x-data="{ flipped: false }" 
                 @click="flipped = !flipped" 
                 class="perspective-1000 w-full h-64 cursor-pointer group">
                <div class="relative w-full h-full duration-500 transform-style-3d transition-transform" 
                     :class="flipped ? 'rotate-y-180' : ''">
                    
                    <!-- Front Side -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-8 flex flex-col justify-between backface-hidden shadow-lg border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                        <div class="text-left">
                            <span class="text-4xl block mb-4">🐬</span>
                            <h4 class="font-serif text-xl font-bold text-white leading-snug">
                                Do dolphin friends call each other by names?
                            </h4>
                        </div>
                        <div class="text-right text-xs font-mono text-gold-400 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                    <!-- Back Side (Flipped) -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-gold-500 to-amber-600 p-8 flex flex-col justify-between backface-hidden rotate-y-180 shadow-lg border border-gold-300/30">
                        <div class="text-left text-forest-950">
                            <span class="text-3xl block mb-2">Whistle Names! 🐬</span>
                            <p class="text-sm font-medium leading-relaxed">
                                Dolphins invent their own unique whistle patterns that act as names. If they want to call a friend, they mimic their friend's whistle!
                            </p>
                        </div>
                        <div class="text-right text-xs font-mono text-forest-950/80 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                </div>
            </div>

            <!-- Flip Card 6 -->
            <div x-data="{ flipped: false }" 
                 @click="flipped = !flipped" 
                 class="perspective-1000 w-full h-64 cursor-pointer group">
                <div class="relative w-full h-full duration-500 transform-style-3d transition-transform" 
                     :class="flipped ? 'rotate-y-180' : ''">
                    
                    <!-- Front Side -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-8 flex flex-col justify-between backface-hidden shadow-lg border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                        <div class="text-left">
                            <span class="text-4xl block mb-4">🐯</span>
                            <h4 class="font-serif text-xl font-bold text-white leading-snug">
                                Are a tiger's stripes only on its soft fur?
                            </h4>
                        </div>
                        <div class="text-right text-xs font-mono text-gold-400 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                    <!-- Back Side (Flipped) -->
                    <div class="absolute inset-0 w-full h-full rounded-3xl bg-gradient-to-br from-gold-500 to-amber-600 p-8 flex flex-col justify-between backface-hidden rotate-y-180 shadow-lg border border-gold-300/30">
                        <div class="text-left text-forest-950">
                            <span class="text-3xl block mb-2">Skin Stripes! 🐯</span>
                            <p class="text-sm font-medium leading-relaxed">
                                No! A tiger's stripes are printed directly on its skin underneath! If you shaved a tiger, it would still have all its beautiful stripes.
                            </p>
                        </div>
                        <div class="text-right text-xs font-mono text-forest-950/80 font-bold uppercase tracking-wider">
                            Click to Flip ↻
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
