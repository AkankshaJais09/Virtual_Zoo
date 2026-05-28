@extends('layouts.app')

@section('content')
<!-- IMMERSIVE ANIMAL DETAIL VIEW -->
<main class="min-h-screen bg-[#121813] text-zinc-100 pb-20 relative overflow-hidden">

    <!-- Background glows -->
    <div class="absolute top-1/3 left-1/10 w-96 h-96 bg-gold-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/10 w-[500px] h-[500px] bg-forest-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <!-- SECTION 1 — Immersive Hero Banner -->
    <div class="relative h-[65vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden border-b border-white/5">
        <!-- Hero Background Image with Blur/Dark overlay -->
        <div class="absolute inset-0">
            <img src="{{ $animal->image_path }}" 
                 onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                 loading="lazy"
                 alt="{{ $animal->name }}" 
                 class="w-full h-full object-cover transition-transform duration-[10s] scale-105 pointer-events-none">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#121813] via-black/60 to-black/30"></div>
        <div class="absolute inset-0 bg-black/40"></div>

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

        <!-- Hero Content -->
        <div class="relative max-w-4xl mx-auto px-6 z-10 flex flex-col items-center text-center pt-16">
            <!-- Back navigation in hero -->
            <a href="{{ route('animals.index') }}" class="inline-flex items-center gap-2 text-[10px] font-semibold tracking-[0.30em] text-gold-400/80 hover:text-zinc-100 transition-colors uppercase mb-6 group animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 transform group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Animals
            </a>

            <!-- Conservation Status Pill -->
            <div class="mb-4">
                @if($animal->conservation_status === 'Least Concern')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 backdrop-blur-md">
                        Least Concern
                    </span>
                @elseif($animal->conservation_status === 'Vulnerable')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-amber-500/20 text-amber-300 border border-amber-500/30 backdrop-blur-md">
                        Vulnerable
                    </span>
                @elseif($animal->conservation_status === 'Endangered')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-orange-500/20 text-orange-300 border border-orange-500/30 backdrop-blur-md">
                        Endangered
                    </span>
                @elseif($animal->conservation_status === 'Critically Endangered')
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-red-500/20 text-red-300 border border-red-500/30 backdrop-blur-md animate-pulse">
                        Critically Endangered
                    </span>
                @else
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-zinc-500/20 text-zinc-300 border border-zinc-500/30 backdrop-blur-md">
                        {{ $animal->conservation_status }}
                    </span>
                @endif
            </div>

            <!-- Titles -->
            <h1 class="font-serif text-5xl md:text-7xl font-bold tracking-wider text-zinc-100 mb-2 filter drop-shadow-md">
                {{ $animal->name }}
            </h1>
            
            <p class="font-serif-display text-xl md:text-2xl text-gold-400 italic tracking-wide mb-8 font-semibold">
                {{ $animal->scientific_name }}
            </p>

            <!-- Category Pills -->
            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-white/5 border border-white/10 text-zinc-300 font-sans">
                    🐾 {{ ucfirst($animal->type) }}
                </span>
                @if($animal->habitat)
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-[#C9952A]/10 border border-[#C9952A]/20 text-gold-400 font-sans">
                        🌿 {{ $animal->habitat->name }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-20">

        <!-- SECTION 2 — Quick Stats Bar -->
        <div class="bg-[#0b0e0c]/85 backdrop-blur-xl rounded-2xl p-6 md:p-8 -mt-12 border border-white/5 shadow-2xl grid grid-cols-2 md:grid-cols-5 gap-6 md:gap-4 justify-items-center">
            
            <!-- Stat 1: Weight -->
            <div class="text-center w-full">
                <span class="text-2xl mb-1.5 block">⚖️</span>
                <span class="text-xl md:text-2xl font-serif font-bold text-[#C9952A] block tracking-wide">
                    @if($animal->weight_kg >= 1000)
                        {{ number_format($animal->weight_kg / 1000, 1) }} <span class="text-xs uppercase">t</span>
                    @else
                        {{ number_format($animal->weight_kg) }} <span class="text-xs">kg</span>
                    @endif
                </span>
                <span class="text-[9px] tracking-[0.25em] text-zinc-500 uppercase font-medium mt-1 block font-sans">Weight</span>
            </div>

            <!-- Stat 2: Lifespan -->
            <div class="text-center w-full border-l border-white/5 md:border-l md:border-white/5">
                <span class="text-2xl mb-1.5 block">⏳</span>
                <span class="text-xl md:text-2xl font-serif font-bold text-[#C9952A] block tracking-wide font-sans">
                    {{ $animal->lifespan_years }} <span class="text-xs">yrs</span>
                </span>
                <span class="text-[9px] tracking-[0.25em] text-zinc-500 uppercase font-medium mt-1 block font-sans">Lifespan</span>
            </div>

            <!-- Stat 3: Speed -->
            <div class="text-center w-full border-l border-white/5 md:border-l md:border-white/5">
                <span class="text-2xl mb-1.5 block">⚡</span>
                <span class="text-xl md:text-2xl font-serif font-bold text-[#C9952A] block tracking-wide font-sans">
                    {{ number_format($animal->speed_kmh) }} <span class="text-xs">km/h</span>
                </span>
                <span class="text-[9px] tracking-[0.25em] text-zinc-500 uppercase font-medium mt-1 block font-sans">Top Speed</span>
            </div>

            <!-- Stat 4: Diet -->
            <div class="text-center w-full border-l border-white/5 md:border-l md:border-white/5 col-span-1">
                <span class="text-2xl mb-1.5 block">🥩</span>
                <span class="text-xl md:text-2xl font-serif font-bold text-[#C9952A] block tracking-wide capitalize font-sans">
                    {{ $animal->diet }}
                </span>
                <span class="text-[9px] tracking-[0.25em] text-zinc-500 uppercase font-medium mt-1 block font-sans">Diet</span>
            </div>

            <!-- Stat 5: Conservation -->
            <div class="text-center w-full border-l border-white/5 md:border-l md:border-white/5 col-span-1">
                <span class="text-2xl mb-1.5 block">🛡️</span>
                <span class="text-xl md:text-2xl font-serif font-bold text-[#C9952A] block tracking-wide font-sans">
                    @if($animal->conservation_status === 'Least Concern')
                        LC
                    @elseif($animal->conservation_status === 'Vulnerable')
                        VU
                    @elseif($animal->conservation_status === 'Endangered')
                        EN
                    @elseif($animal->conservation_status === 'Critically Endangered')
                        CR
                    @else
                        {{ substr($animal->conservation_status, 0, 2) }}
                    @endif
                </span>
                <span class="text-[9px] tracking-[0.25em] text-zinc-500 uppercase font-medium mt-1 block font-sans">Status</span>
            </div>
            
        </div>

        <!-- SECTION 3 — About + Fun Facts (two column layout) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mt-16">
            
            <!-- LEFT COLUMN: About description & stats details -->
            <div class="lg:col-span-7 flex flex-col gap-8">
                
                <div>
                    <h2 class="font-serif text-3xl font-bold tracking-wide text-zinc-100 mb-6 border-b border-white/5 pb-3">
                        About the {{ $animal->name }}
                    </h2>
                    
                    <p class="text-zinc-300 text-base leading-relaxed tracking-wide mb-8 font-sans">
                        {{ $animal->description }}
                    </p>
                </div>

                <!-- Immersive Geographical & Dietary Details -->
                <div class="bg-forest-950/40 backdrop-blur-md rounded-2xl p-6 border border-white/5 space-y-4">
                    <h3 class="text-xs font-bold tracking-[0.2em] text-gold-400 uppercase">Natural Profile</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Habitat detail -->
                        @if($animal->habitat)
                            <div class="flex flex-col gap-1 font-sans">
                                <span class="text-[10px] tracking-widest text-zinc-500 uppercase">Habitat Biome</span>
                                <a href="{{ url('/explore/' . $animal->habitat_id) }}" class="text-sm font-semibold text-zinc-200 hover:text-gold-400 transition-colors inline-flex items-center gap-1.5">
                                    {{ $animal->habitat->name }} 
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </div>

                            <div class="flex flex-col gap-1 font-sans">
                                <span class="text-[10px] tracking-widest text-zinc-500 uppercase">Region</span>
                                <span class="text-sm font-semibold text-zinc-200">{{ $animal->habitat->region }}</span>
                            </div>
                        @endif

                        <!-- Food details -->
                        <div class="flex flex-col gap-1 col-span-1 sm:col-span-2 border-t border-white/5 pt-4 font-sans">
                            <span class="text-[10px] tracking-widest text-zinc-500 uppercase">What it eats</span>
                            <span class="text-sm font-semibold text-zinc-200">
                                @if($animal->diet === 'carnivore')
                                    Meat and other animals. As a carnivore, it hunts or scavenges to obtain nutrients.
                                @elseif($animal->diet === 'herbivore')
                                    Plants, foliage, roots, and fruits. As a herbivore, it relies strictly on vegetation.
                                @else
                                    A combination of both plants and meats. As an omnivore, it feeds on varied food sources.
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Did You Know? facts panel -->
            <div class="lg:col-span-5 flex flex-col gap-8">
                
                <div class="bg-[#171f19]/40 backdrop-blur-md rounded-2xl p-6 border border-[#C9952A]/15 shadow-xl relative overflow-hidden">
                    <h3 class="font-serif text-2xl font-bold text-zinc-100 mb-6 tracking-wide flex items-center gap-2">
                        <span>💡</span> Did You Know?
                    </h3>

                    @php
                    $facts = match(strtolower($animal->name)) {
                        'lion' => [
                            "Lions are the only social cat species, living in family groups called prides.",
                            "A lion's roar can be heard from up to 8 kilometers (5 miles) away.",
                            "Lions hunt mostly at night because their eyes are adapted to the dark.",
                            "Lions spend about 16 to 20 hours a day sleeping or resting."
                        ],
                        'african elephant' => [
                            "An elephant's trunk has over 40,000 muscles and can sense size, shape, and temperature.",
                            "African Elephants are the largest land animals on Earth.",
                            "They use their large ears to radiate heat and keep cool in the hot savanna.",
                            "Elephants can communicate over long distances using low-frequency infrasound."
                        ],
                        'giraffe' => [
                            "Giraffes only need 5 to 30 minutes of sleep per day!",
                            "They have a blue-black prehensile tongue that can grow up to 45 cm long.",
                            "A giraffe's neck contains only 7 vertebrae, the same number as a human's.",
                            "Their spots are unique, like human fingerprints, and help with temperature regulation."
                        ],
                        'cheetah' => [
                            "Cheetahs can accelerate from 0 to 95 km/h in just 3 seconds.",
                            "They are the only big cats that cannot roar; they purr instead.",
                            "Their claws do not retract fully, acting like spikes for traction during runs.",
                            "Cheetahs have excellent eyesight during the day, spotting prey from 5 km away."
                        ],
                        'amazon river dolphin' => [
                            "They can turn their necks 180 degrees, allowing them to navigate through flooded tree trunks.",
                            "Amazon river dolphins are pink, a color caused by blood capillaries near the skin surface.",
                            "They are solitary hunters but sometimes band together in small family groups.",
                            "Unlike ocean dolphins, they have hairs on their snouts to help find food in muddy riverbeds."
                        ],
                        'macaw' => [
                            "Macaws use their strong beaks to crack open hard nutshells and lick clay deposits.",
                            "Some macaw species can live up to 50 or 80 years in captivity.",
                            "Macaws are monogamous, mating for life and flying close together in pairs.",
                            "They can mimic human speech and use vocalizations to identify one another."
                        ],
                        'king cobra' => [
                            "The king cobra is the only snake in the world that builds nests for its eggs.",
                            "They are not actually 'true' cobras; they belong to a separate genus called Ophiophagus.",
                            "A single bite can deliver enough venom to kill a full-grown Asian elephant.",
                            "King cobras can grow up to 5.5 meters (18 feet) in length."
                        ],
                        'polar bear' => [
                            "Polar bear skin is actually black, and their hollow fur reflects light to appear white.",
                            "They are classified as marine mammals because they spend most of their lives on sea ice.",
                            "A polar bear's sense of smell is so sharp it can locate a seal under 1 meter of snow.",
                            "Their paws are wide and act like snowshoes, with small bumps that provide traction."
                        ],
                        'great white shark' => [
                            "Great whites have a highly developed sense of smell, sensing blood in 100 liters of water.",
                            "They have up to 300 serrated teeth arranged in several rows.",
                            "Great white sharks can detect electromagnetic fields generated by living animals.",
                            "They must keep swimming constantly to force water over their gills to breathe."
                        ],
                        'bengal tiger' => [
                            "No two tigers have the exact same pattern of stripes, much like human fingerprints.",
                            "Bengal tigers are excellent swimmers and frequently cool off in rivers and lakes.",
                            "A tiger's roar can paralyze prey due to its deep low-frequency vibration.",
                            "They are solitary animals, marking large territories to keep other tigers away."
                        ],
                        'gorilla' => [
                            "Gorillas share about 98.3% of their DNA with humans, making them close relatives.",
                            "Gorillas use knuckle-walking to move around on all fours.",
                            "They build nests out of leaves and branches on the ground or in trees each night to sleep.",
                            "A group of gorillas is called a band or a troop, led by an dominant older silverback."
                        ],
                        'arctic fox' => [
                            "Their fur changes color with the seasons: pure white in winter, and brown-gray in summer.",
                            "Arctic foxes have furry soles on their paws, which prevent them from getting frostbite.",
                            "They have a compact body structure with short legs and ears to minimize heat loss.",
                            "They can survive temperatures as low as -50°C before their metabolism starts to shift."
                        ],
                        default => [
                            $animal->fun_fact,
                            "This animal plays a vital role in balancing its ecosystem.",
                            "Nature conservation groups actively protect its habitats.",
                            "It uses unique behavioral techniques to adapt to environmental changes."
                        ]
                    };
                    @endphp

                    <!-- Facts List -->
                    <div class="space-y-4 font-sans">
                        @foreach($facts as $index => $fact)
                            <div class="pl-4 border-l-2 border-[#C9952A] flex items-start gap-2.5">
                                <span class="text-xs text-gold-400 mt-1 font-bold">#{{ $index + 1 }}</span>
                                <p class="text-sm text-zinc-300 leading-relaxed font-sans">{{ $fact }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Conservation Info Box -->
                <div class="bg-forest-950/30 rounded-2xl p-6 border border-white/5 space-y-3 font-sans">
                    <span class="text-xs font-semibold tracking-wider uppercase text-zinc-400 block">🛡️ Parent & Child Guide</span>
                    <h4 class="text-sm font-bold text-zinc-200 font-serif">What does the Conservation Status mean?</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed font-sans">
                        @if($animal->conservation_status === 'Least Concern')
                            <strong>Least Concern</strong>: This animal is doing great! Its population is stable, and it faces no immediate threat of extinction.
                        @elseif($animal->conservation_status === 'Vulnerable')
                            <strong>Vulnerable</strong>: This animal is facing some challenges in the wild. Its numbers are declining due to habitat loss or poaching, and it needs our help to stay safe.
                        @elseif($animal->conservation_status === 'Endangered')
                            <strong>Endangered</strong>: This animal is in danger of extinction. There are very few of them left in the wild, and conservation teams are working hard to protect them.
                        @elseif($animal->conservation_status === 'Critically Endangered')
                            <strong>Critically Endangered</strong>: This animal is in extreme danger! It is on the brink of extinction in the wild, and urgent action is needed to save it.
                        @else
                            {{ $animal->conservation_status }}: Conservationists are actively monitoring this animal to ensure its long-term survival in its natural biome.
                        @endif
                    </p>
                </div>

            </div>

        </div>

        <!-- SECTION 4 — Similar Animals (bottom strip) -->
        @if($similarAnimals->count() > 0)
            <div class="mt-20 pt-10 border-t border-white/5">
                @if($animal->habitat)
                    <h3 class="font-serif text-2xl md:text-3xl font-bold text-zinc-100 tracking-wide mb-8 font-sans">
                        More Animals From The {{ $animal->habitat->name }}
                    </h3>
                @else
                    <h3 class="font-serif text-2xl md:text-3xl font-bold text-zinc-100 tracking-wide mb-8 font-sans">
                        More Similar Animals
                    </h3>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($similarAnimals as $similar)
                        <!-- Horizontal styled card -->
                        <div class="group bg-forest-950/30 border border-white/5 hover:border-[#C9952A]/40 rounded-xl overflow-hidden flex items-center p-3 transition-all duration-300 hover:shadow-[0_0_20px_rgba(201,149,42,0.08)]">
                            <!-- Left aspect: thumbnail -->
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-zinc-900">
                                <img src="{{ $similar->image_path }}" 
                                     onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                     loading="lazy"
                                     alt="{{ $similar->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            
                            <!-- Right aspect: details and action -->
                            <div class="pl-4 flex-grow flex flex-col justify-between h-20">
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-200 group-hover:text-gold-400 transition-colors line-clamp-1 mb-0.5 font-sans">{{ $similar->name }}</h4>
                                    <span class="px-1.5 py-0.5 rounded text-[8px] font-bold tracking-wider uppercase bg-forest-500/20 text-gold-300 border border-gold-500/20 inline-block font-sans">{{ $similar->type }}</span>
                                </div>
                                
                                <div class="flex justify-end">
                                    <a href="{{ route('animals.show', $similar->id) }}" class="text-[10px] tracking-wider font-semibold text-gold-400 hover:text-zinc-100 uppercase transition-colors inline-flex items-center gap-1 font-sans">
                                        View
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</main>
@endsection
