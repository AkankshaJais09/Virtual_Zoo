@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-[#121813] text-zinc-100 pt-28 pb-20 relative overflow-hidden" 
      x-data="{ 
          activeType: 'all', 
          activeDiet: 'all', 
          searchQuery: '' 
      }">
      
    <!-- Background glows -->
    <div class="absolute top-1/4 right-1/10 w-96 h-96 bg-gold-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-1/10 w-[500px] h-[500px] bg-forest-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <!-- Hero Section -->
        <div class="relative rounded-3xl overflow-hidden mb-16 border border-white/5 shadow-2xl">
            <!-- Hero Background with Dark Overlay -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/hero_bg.png') }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0e1610] via-[#0e1610]/80 to-transparent"></div>
            <div class="absolute inset-0 bg-black/50"></div>

            <div class="relative py-20 px-8 md:px-16 text-center max-w-3xl mx-auto z-10 flex flex-col items-center">
                <!-- Decorative Badge -->
                <span class="inline-block px-4 py-1 rounded-full border border-gold-500/30 bg-gold-500/10 text-gold-400 text-[10px] tracking-[0.3em] uppercase mb-4 animate-pulse">
                    WildVerse Directory
                </span>
                
                <h1 class="font-serif text-4xl md:text-6xl font-bold text-zinc-100 tracking-wider mb-6">
                    Meet The <span class="bg-clip-text text-transparent bg-gradient-to-r from-gold-300 via-gold-400 to-gold-500">Animals</span>
                </h1>
                
                <p class="text-zinc-400 text-sm md:text-base leading-relaxed font-sans tracking-wide">
                    Discover 500+ species from around the world. Search and filter by diet, class, or name to find your favorite wildlife companions.
                </p>
            </div>
        </div>

        <!-- Filter Controls Container -->
        <div class="bg-forest-950/40 backdrop-blur-md rounded-2xl p-6 border border-white/5 mb-12 flex flex-col gap-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-end">
                <!-- Live Search Box -->
                <div class="flex flex-col gap-2 col-span-1 lg:col-span-1">
                    <label class="text-[10px] tracking-[0.2em] font-medium text-gold-400 uppercase">Search Species</label>
                    <div class="relative">
                        <input type="text" 
                               x-model="searchQuery" 
                               placeholder="Search by name..." 
                               class="w-full bg-forest-950/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-[#C9952A] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-zinc-500 absolute right-4 top-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.637 10.637Z" />
                        </svg>
                    </div>
                </div>

                <!-- Class/Type Filters -->
                <div class="flex flex-col gap-2 col-span-1 lg:col-span-2">
                    <label class="text-[10px] tracking-[0.2em] font-medium text-gold-400 uppercase font-sans">Animal Class</label>
                    <div class="flex flex-wrap gap-2">
                        <button @click="activeType = 'all'" :class="activeType === 'all' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans">All</button>
                        <button @click="activeType = 'mammal'" :class="activeType === 'mammal' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold">Mammals</button>
                        <button @click="activeType = 'bird'" :class="activeType === 'bird' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold">Birds</button>
                        <button @click="activeType = 'reptile'" :class="activeType === 'reptile' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold">Reptiles</button>
                        <button @click="activeType = 'fish'" :class="activeType === 'fish' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold">Fish</button>
                        <button @click="activeType = 'amphibian'" :class="activeType === 'amphibian' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold">Amphibians</button>
                    </div>
                </div>
            </div>

            <!-- Diet Filters -->
            <div class="flex flex-col gap-2 border-t border-white/5 pt-4">
                <span class="text-[10px] tracking-[0.2em] font-medium text-gold-400 uppercase">Diet Preference</span>
                <div class="flex flex-wrap gap-2">
                    <button @click="activeDiet = 'all'" :class="activeDiet === 'all' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans">All</button>
                    <button @click="activeDiet = 'carnivore'" :class="activeDiet === 'carnivore' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold font-sans">Carnivore</button>
                    <button @click="activeDiet = 'herbivore'" :class="activeDiet === 'herbivore' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold font-sans">Herbivore</button>
                    <button @click="activeDiet = 'omnivore'" :class="activeDiet === 'omnivore' ? 'bg-[#C9952A] text-forest-950 border-[#C9952A]' : 'bg-forest-950/40 text-zinc-400 border-white/10 hover:text-gold-400'" class="px-4 py-1.5 rounded-lg border text-xs font-semibold tracking-wider transition-colors cursor-pointer font-sans font-semibold font-sans">Omnivore</button>
                </div>
            </div>

        </div>

        <!-- Animals Grid (3 cols desktop, 2 cols tablet, 1 col mobile) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($animals as $animal)
                <!-- Animal Card -->
                <div x-show="(activeType === 'all' || activeType === '{{ $animal->type }}') && (activeDiet === 'all' || activeDiet === '{{ $animal->diet }}') && (searchQuery === '' || {{ json_encode(strtolower($animal->name)) }}.includes(searchQuery.toLowerCase()) || {{ json_encode(strtolower($animal->scientific_name)) }}.includes(searchQuery.toLowerCase()))"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group bg-forest-950/40 backdrop-blur-md rounded-2xl overflow-hidden border border-white/5 hover:border-[#C9952A]/50 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_0_30px_rgba(201,149,42,0.15)] flex flex-col justify-between">
                    
                    <!-- Card Top Content -->
                    <div>
                        <!-- Image Container with Hover Scaling -->
                        <div class="relative overflow-hidden aspect-[4/3] w-full bg-zinc-900/50">
                            <img src="{{ $animal->image_path }}" 
                                 onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                 loading="lazy"
                                 alt="{{ $animal->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            
                            <!-- Dark Gradient overlay on image -->
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

                            <!-- Conservation Badge Overlay -->
                            <div class="absolute top-4 left-4">
                                @if($animal->conservation_status === 'Least Concern')
                                    <span class="px-3 py-1 rounded-full text-[9px] font-extrabold tracking-wider uppercase bg-emerald-500/25 text-emerald-300 border border-emerald-500/30 backdrop-blur-md">
                                        Least Concern
                                    </span>
                                @elseif($animal->conservation_status === 'Vulnerable')
                                    <span class="px-3 py-1 rounded-full text-[9px] font-extrabold tracking-wider uppercase bg-amber-500/25 text-amber-300 border border-amber-500/30 backdrop-blur-md">
                                        Vulnerable
                                    </span>
                                @elseif($animal->conservation_status === 'Endangered')
                                    <span class="px-3 py-1 rounded-full text-[9px] font-extrabold tracking-wider uppercase bg-orange-500/25 text-orange-300 border border-orange-500/30 backdrop-blur-md">
                                        Endangered
                                    </span>
                                @elseif($animal->conservation_status === 'Critically Endangered')
                                    <span class="px-3 py-1 rounded-full text-[9px] font-extrabold tracking-wider uppercase bg-red-500/25 text-red-300 border border-red-500/30 backdrop-blur-md animate-pulse">
                                        Critically Endangered
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[9px] font-extrabold tracking-wider uppercase bg-zinc-500/25 text-zinc-300 border border-zinc-500/30 backdrop-blur-md">
                                        {{ $animal->conservation_status }}
                                    </span>
                                @endif
                            </div>

                            <!-- Habitat Tag Overlay -->
                            @if($animal->habitat)
                                <div class="absolute bottom-4 left-4 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-gold-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l4.038 3.332a.75.75 0 0 1 .288.583v4.61a.75.75 0 0 1-.288.583l-4.038 3.331a1.125 1.125 0 0 0-.405.864v.568M11.25 3.03v.568c0 .334-.148.65-.405.864L6.807 7.794a.75.75 0 0 0-.288.583v4.61a.75.75 0 0 0 .288.583l4.038 3.331c.257.213.405.53.405.864v.568" />
                                    </svg>
                                    <span class="text-[9px] font-semibold tracking-widest text-gold-400 uppercase font-sans">{{ $animal->habitat->name }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-0.5 rounded text-[9px] font-semibold tracking-wider uppercase bg-forest-500/20 text-gold-300 border border-gold-500/20 font-sans font-semibold">
                                    {{ ucfirst($animal->type) }}
                                </span>
                                <span class="px-2 py-0.5 rounded text-[9px] font-semibold tracking-wider uppercase bg-white/5 text-zinc-300 border border-white/10 font-sans font-semibold">
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

                    <!-- Card Actions (Learn More button only) -->
                    <div class="px-6 pb-6 pt-2">
                        <a href="{{ route('animals.show', $animal->id) }}" 
                           class="w-full inline-flex justify-center items-center py-2.5 rounded-xl border border-gold-500/25 bg-gold-500/5 text-gold-400 group-hover:bg-[#C9952A] group-hover:text-forest-950 group-hover:border-[#C9952A] transition-all duration-300 text-xs tracking-widest font-semibold uppercase">
                            Learn More <span class="ml-1.5 transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                    
                </div>
            @endforeach
        </div>

    </div>
</main>
@endsection
