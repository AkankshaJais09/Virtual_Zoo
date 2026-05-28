@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-[#121813] text-zinc-100 pb-20 relative overflow-hidden">

    <!-- Background glows -->
    <div class="absolute top-1/3 left-1/10 w-96 h-96 bg-gold-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/10 w-[500px] h-[500px] bg-forest-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Hero Banner -->
    <div class="relative h-[55vh] md:h-[65vh] w-full flex items-center justify-center overflow-hidden border-b border-white/5">
        <!-- Hero Background Image -->
        <div class="absolute inset-0">
            <img src="{{ $habitat->image_path }}" 
                 onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                 loading="lazy"
                 alt="{{ $habitat->name }}" 
                 class="w-full h-full object-cover transition-transform duration-[10s] scale-105 pointer-events-none">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#121813] via-black/60 to-black/30"></div>
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Hero Content -->
        <div class="relative max-w-4xl mx-auto px-6 z-10 flex flex-col items-center text-center pt-16">
            <!-- Back navigation -->
            <a href="{{ url('/explore') }}" class="inline-flex items-center gap-2 text-[10px] font-semibold tracking-[0.30em] text-gold-400/80 hover:text-zinc-100 transition-colors uppercase mb-6 group animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 transform group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Habitats
            </a>

            <!-- Climate Badge -->
            <div class="mb-4">
                @if($habitat->climate === 'hot')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-amber-500/20 text-amber-300 border border-amber-500/30 backdrop-blur-md">
                        Hot Climate
                    </span>
                @elseif($habitat->climate === 'cold')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-blue-500/20 text-blue-300 border border-blue-500/30 backdrop-blur-md">
                        Cold Climate
                    </span>
                @elseif($habitat->climate === 'aquatic')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 backdrop-blur-md">
                        Aquatic
                    </span>
                @elseif($habitat->climate === 'forest')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 backdrop-blur-md">
                        Forest
                    </span>
                @else
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-gold-500/20 text-gold-400 border border-gold-500/30 backdrop-blur-md">
                        {{ ucfirst($habitat->climate) }}
                    </span>
                @endif
            </div>

            <!-- Title -->
            <h1 class="font-serif text-5xl md:text-7xl font-bold tracking-wider text-zinc-100 filter drop-shadow-md">
                {{ $habitat->name }}
            </h1>
            
            <p class="font-serif-display text-sm tracking-widest text-gold-400 uppercase mt-4">
                {{ $habitat->region }} Region
            </p>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="max-w-6xl mx-auto px-6 mt-12 relative z-20">
        
        <!-- Description -->
        <div class="bg-forest-950/40 backdrop-blur-md rounded-2xl p-6 md:p-8 border border-white/5 shadow-2xl mb-16">
            <h2 class="text-xs font-bold tracking-[0.2em] text-gold-400 uppercase mb-4">Biome Overview</h2>
            <p class="text-zinc-300 text-base leading-relaxed tracking-wide font-sans">
                {{ $habitat->description }}
            </p>
        </div>

        <!-- Resident Animals Section -->
        <div>
            <h2 class="font-serif text-3xl font-bold text-zinc-100 tracking-wide mb-8 border-b border-white/5 pb-3 font-sans">
                Resident Species
            </h2>

            @if($habitat->animals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($habitat->animals as $animal)
                        <!-- Animal Card -->
                        <div class="group bg-forest-950/40 backdrop-blur-md rounded-2xl overflow-hidden border border-white/5 hover:border-[#C9952A]/50 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_0_30px_rgba(201,149,42,0.15)] flex flex-col justify-between">
                            
                            <div>
                                <!-- Image Container -->
                                <div class="relative overflow-hidden aspect-[4/3] w-full bg-zinc-900/50">
                                    <img src="{{ $animal->image_path }}" 
                                         onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                         loading="lazy"
                                         alt="{{ $animal->name }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#121813]/90 to-transparent"></div>

                                    @auth
                                    <button
                                      class="fav-btn"
                                      data-animal-id="{{ $animal->id }}"
                                      data-favourited="{{ auth()->user()->hasFavourited($animal->id) ? 'true' : 'false' }}"
                                      title="Add to favourites">
                                      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                      </svg>
                                    </button>
                                    @else
                                    <a href="{{ route('login') }}" class="fav-btn fav-login-prompt" title="Login to favourite">
                                      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                      </svg>
                                    </a>
                                    @endauth
                                </div>

                                <!-- Card Content -->
                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-0.5 rounded text-[9px] font-semibold tracking-wider uppercase bg-forest-500/20 text-gold-300 border border-gold-500/20 font-sans">
                                            {{ ucfirst($animal->type) }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded text-[9px] font-semibold tracking-wider uppercase bg-white/5 text-zinc-300 border border-white/10 font-sans">
                                            {{ ucfirst($animal->diet) }}
                                        </span>
                                    </div>

                                    <h3 class="font-serif text-2xl font-bold text-zinc-100 mb-1 group-hover:text-gold-400 transition-colors duration-300">
                                        {{ $animal->name }}
                                    </h3>
                                    
                                    <p class="font-serif-display text-xs italic text-[#e2b978] tracking-wide mb-4">
                                        {{ $animal->scientific_name }}
                                    </p>
                                    
                                    <p class="text-zinc-400 text-sm leading-relaxed line-clamp-2">
                                        {{ $animal->fun_fact }}
                                    </p>
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="px-6 pb-6 pt-2">
                                <a href="{{ route('animals.show', $animal->id) }}" 
                                   class="w-full inline-flex justify-center items-center py-2.5 rounded-xl border border-gold-500/25 bg-gold-500/5 text-gold-400 group-hover:bg-[#C9952A] group-hover:text-forest-950 group-hover:border-[#C9952A] transition-all duration-300 text-xs tracking-widest font-semibold uppercase">
                                    View Profile <span class="ml-1.5 transform group-hover:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-forest-950/20 rounded-2xl p-12 text-center border border-white/5">
                    <span class="text-3xl block mb-4">🌿</span>
                    <p class="text-zinc-400 text-sm">No species recorded in this habitat yet. Check back soon as our expedition team maps more wildlife!</p>
                </div>
            @endif
        </div>

    </div>
</main>
@endsection
