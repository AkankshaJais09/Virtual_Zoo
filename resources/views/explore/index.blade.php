@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-[#121813] text-zinc-100 pt-28 pb-20 relative overflow-hidden" 
      x-data="{ activeFilter: 'all' }">
      
    <!-- Background glows -->
    <div class="absolute top-1/4 left-1/10 w-96 h-96 bg-gold-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/10 w-[500px] h-[500px] bg-forest-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <!-- Hero Section -->
        <div class="relative rounded-3xl overflow-hidden mb-16 border border-white/5 shadow-2xl">
            <!-- Hero Background with Dark Overlay -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/hero_bg.png') }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0e1610] via-[#0e1610]/80 to-transparent"></div>
            <div class="absolute inset-0 bg-black/45"></div>

            <div class="relative py-20 px-8 md:px-16 text-center max-w-3xl mx-auto z-10 flex flex-col items-center">
                <!-- Decorative Badge -->
                <span class="inline-block px-4 py-1 rounded-full border border-gold-500/30 bg-gold-500/10 text-gold-400 text-[10px] tracking-[0.3em] uppercase mb-4 animate-pulse">
                    WildVerse Biomes
                </span>
                
                <h1 class="font-serif text-4xl md:text-6xl font-bold text-zinc-100 tracking-wider mb-6">
                    Explore <span class="bg-clip-text text-transparent bg-gradient-to-r from-gold-300 via-gold-400 to-gold-500">Habitats</span>
                </h1>
                
                <p class="text-zinc-400 text-sm md:text-base leading-relaxed font-sans tracking-wide">
                    Embark on an immersive journey across the Earth's most diverse biomes and meet the magnificent species that call them home. Filter by climate to begin your expedition.
                </p>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="flex flex-wrap justify-center items-center gap-3 md:gap-4 mb-12">
            <button @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A] shadow-[0_0_15px_rgba(201,149,42,0.4)]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:border-gold-500/40 hover:text-gold-400'"
                    class="px-5 py-2.5 rounded-full border text-xs font-semibold tracking-widest uppercase transition-all duration-300 focus:outline-none cursor-pointer">
                All
            </button>
            <button @click="activeFilter = 'hot'" 
                    :class="activeFilter === 'hot' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A] shadow-[0_0_15px_rgba(201,149,42,0.4)]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:border-gold-500/40 hover:text-gold-400'"
                    class="px-5 py-2.5 rounded-full border text-xs font-semibold tracking-widest uppercase transition-all duration-300 focus:outline-none cursor-pointer">
                Hot Climate
            </button>
            <button @click="activeFilter = 'cold'" 
                    :class="activeFilter === 'cold' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A] shadow-[0_0_15px_rgba(201,149,42,0.4)]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:border-gold-500/40 hover:text-gold-400'"
                    class="px-5 py-2.5 rounded-full border text-xs font-semibold tracking-widest uppercase transition-all duration-300 focus:outline-none cursor-pointer">
                Cold Climate
            </button>
            <button @click="activeFilter = 'aquatic'" 
                    :class="activeFilter === 'aquatic' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A] shadow-[0_0_15px_rgba(201,149,42,0.4)]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:border-gold-500/40 hover:text-gold-400'"
                    class="px-5 py-2.5 rounded-full border text-xs font-semibold tracking-widest uppercase transition-all duration-300 focus:outline-none cursor-pointer">
                Aquatic
            </button>
            <button @click="activeFilter = 'forest'" 
                    :class="activeFilter === 'forest' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A] shadow-[0_0_15px_rgba(201,149,42,0.4)]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:border-gold-500/40 hover:text-gold-400'"
                    class="px-5 py-2.5 rounded-full border text-xs font-semibold tracking-widest uppercase transition-all duration-300 focus:outline-none cursor-pointer">
                Forest
            </button>
        </div>

        <!-- Habitats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($habitats as $habitat)
                <!-- Card Container -->
                <div x-show="activeFilter === 'all' || activeFilter === '{{ $habitat->climate }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group bg-forest-950/40 backdrop-blur-md rounded-2xl overflow-hidden border border-white/5 hover:border-[#C9952A]/50 transition-all duration-500 hover:shadow-[0_0_30px_rgba(201,149,42,0.15)] flex flex-col justify-between">
                    
                    <!-- Card Top Area -->
                    <div>
                        <!-- Image Container with Hover Scaling -->
                        <div class="relative overflow-hidden aspect-[4/3] w-full bg-zinc-900/50">
                            <img src="{{ $habitat->image_path }}" 
                                 onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                 loading="lazy"
                                 alt="{{ $habitat->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            
                            <!-- Dark Gradient overlay on image -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#121813]/90 to-transparent"></div>

                            <!-- Climate Badge & Region Tag Overlay -->
                            <div class="absolute top-4 left-4 flex gap-2">
                                @if($habitat->climate === 'hot')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase bg-amber-500/20 text-amber-300 border border-amber-500/30 backdrop-blur-md">
                                        Hot Climate
                                    </span>
                                @elseif($habitat->climate === 'cold')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase bg-blue-500/20 text-blue-300 border border-blue-500/30 backdrop-blur-md">
                                        Cold Climate
                                    </span>
                                @elseif($habitat->climate === 'aquatic')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 backdrop-blur-md">
                                        Aquatic
                                    </span>
                                @elseif($habitat->climate === 'forest')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 backdrop-blur-md">
                                        Forest
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase bg-gold-500/20 text-gold-400 border border-gold-500/30 backdrop-blur-md">
                                        {{ ucfirst($habitat->climate) }}
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-4 left-4 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-gold-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <span class="text-[10px] font-medium tracking-widest text-gold-400 uppercase">{{ $habitat->region }}</span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <h3 class="font-serif text-xl font-semibold text-zinc-100 mb-3 group-hover:text-gold-400 transition-colors duration-300">
                                {{ $habitat->name }}
                            </h3>
                            <p class="text-zinc-400 text-sm leading-relaxed line-clamp-2">
                                {{ $habitat->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Footer/Action -->
                    <div class="px-6 pb-6 pt-2">
                        <a href="{{ url('/explore/' . $habitat->id) }}" 
                           class="w-full inline-flex justify-center items-center py-3 rounded-xl border border-gold-500/25 bg-gold-500/5 text-gold-400 group-hover:bg-[#C9952A] group-hover:text-forest-950 group-hover:border-[#C9952A] transition-all duration-300 text-xs tracking-widest font-semibold uppercase">
                            Enter Habitat <span class="ml-1.5 transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                    
                </div>
            @endforeach
        </div>

    </div>
</main>
@endsection
