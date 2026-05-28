@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-[#121813] text-zinc-100 pt-28 pb-20 relative overflow-hidden">
    
    <!-- Background glows -->
    <div class="absolute top-1/4 right-1/10 w-96 h-96 bg-gold-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-1/10 w-[500px] h-[500px] bg-forest-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12 pb-6 border-b border-white/5">
            <div>
                <h1 class="font-fredoka text-4xl md:text-5xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-gold-500 to-amber-500 flex items-center gap-3">
                    ❤️ My Favourites
                    <span class="fav-count-pill text-xs font-semibold px-3 py-1 rounded-full bg-gold-500/10 text-gold-400 border border-gold-500/20 font-sans tracking-normal">
                        {{ $favourites->count() }} {{ $favourites->count() === 1 ? 'animal' : 'animals' }} saved
                    </span>
                </h1>
                <p class="font-sans text-zinc-400 text-sm md:text-base mt-2">
                    Your personal collection of wild friends
                </p>
            </div>
            
            @if($favourites->isNotEmpty())
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('animals.index') }}" class="inline-flex items-center gap-2 text-xs tracking-wider uppercase font-semibold text-gold-400 hover:text-gold-300 transition-colors">
                        Explore More Animals →
                    </a>
                </div>
            @endif
        </div>

        <!-- Empty State Container -->
        <div class="favourites-empty-state flex flex-col items-center justify-center text-center py-20 bg-forest-950/20 backdrop-blur-md rounded-3xl border border-white/5" style="display: {{ $favourites->isEmpty() ? 'flex' : 'none' }};">
            <svg class="mx-auto h-24 w-24 text-zinc-600 mb-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <!-- Big pad -->
                <path d="M12 14c-2.2 0-4 1.8-4 4 0 1.5 1 2 2 2h4c1 0 2-.5 2-2 0-2.2-1.8-4-4-4z" />
                <!-- 4 toes -->
                <circle cx="6" cy="10" r="2" />
                <circle cx="10" cy="7" r="2" />
                <circle cx="14" cy="7" r="2" />
                <circle cx="18" cy="10" r="2" />
                <!-- Sad mouth/eyes inside pad -->
                <path d="M10 17.5c.3.5.7.8 1.2.8s.9-.3 1.2-.8" stroke-linecap="round" />
                <path d="M9.5 16h.01M13.5 16h.01" stroke-linecap="round" />
            </svg>
            <h3 class="font-fredoka text-2xl font-bold text-white mb-2">No favourites yet!</h3>
            <p class="text-zinc-400 text-sm max-w-sm mb-8 font-sans leading-relaxed">
                Start exploring the biomes and save your favourite wild friends here!
            </p>
            <a href="{{ route('animals.index') }}" class="px-8 py-3.5 rounded-full bg-gold-500 text-forest-950 font-bold text-xs tracking-widest hover:bg-gold-400 hover:scale-105 transition-all duration-300 uppercase shadow-lg">
                Explore Animals →
            </a>
        </div>

        <!-- Favourites Grid (4 columns desktop, 2 columns tablet, 1 column mobile) -->
        @if($favourites->isNotEmpty())
            <div class="favourites-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($favourites as $animal)
                    <div class="animal-card group bg-forest-950/40 backdrop-blur-md rounded-2xl overflow-hidden border border-white/5 hover:border-[#C9952A]/50 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_0_30px_rgba(201,149,42,0.15)] flex flex-col justify-between">
                        <div>
                            <!-- Image Container -->
                            <div class="relative overflow-hidden aspect-[4/3] w-full bg-zinc-900/50">
                                <img src="{{ $animal->image_path }}" 
                                     onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                     loading="lazy"
                                     alt="{{ $animal->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-[#121813]/90 to-transparent"></div>

                                <!-- Heart toggle button -->
                                <button
                                  class="fav-btn is-favourited"
                                  data-animal-id="{{ $animal->id }}"
                                  data-favourited="true"
                                  title="Remove from favourites">
                                  <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                  </svg>
                                </button>

                                <!-- Habitat Tag Overlay -->
                                @if($animal->habitat)
                                    <div class="absolute bottom-4 left-4 flex items-center gap-1">
                                        <span class="text-[9px] font-semibold tracking-widest text-gold-400 uppercase font-sans">{{ $animal->habitat->name }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-0.5 rounded text-[9px] font-semibold tracking-wider uppercase bg-forest-500/20 text-gold-300 border border-gold-500/20 font-sans">
                                        {{ ucfirst($animal->type) }}
                                    </span>
                                </div>

                                <h3 class="font-fredoka text-xl font-bold text-zinc-100 mb-1 group-hover:text-gold-400 transition-colors duration-300">
                                    {{ $animal->name }}
                                </h3>
                                
                                <p class="font-sans text-xs italic text-[#e2b978] tracking-wide mb-3">
                                    {{ $animal->scientific_name }}
                                </p>
                                
                                <p class="text-zinc-400 text-xs leading-relaxed line-clamp-2">
                                    {{ $animal->fun_fact }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Actions -->
                        <div class="px-5 pb-5 pt-2">
                            <a href="{{ route('animals.show', $animal->id) }}" 
                               class="w-full inline-flex justify-center items-center py-2.5 rounded-xl border border-gold-500/25 bg-gold-500/5 text-gold-400 group-hover:bg-[#C9952A] group-hover:text-forest-950 group-hover:border-[#C9952A] transition-all duration-300 text-xs tracking-widest font-semibold uppercase">
                                Profile <span class="ml-1.5 transform group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</main>
@endsection
