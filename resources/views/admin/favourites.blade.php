@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-[#1b2e21]/20 pb-6">
        <div>
            <h1 class="font-fredoka text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-gold-500 to-amber-500">
                ❤️ Favourites Analytics
            </h1>
            <p class="font-nunito text-zinc-400 text-sm mt-1">
                Explore wildlife analytics: find which biomes and resident species are receiving the most user likes and bookmarks.
            </p>
        </div>
    </div>

    <!-- Top Row: Habitat popularity & Trending species -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Popularity by Habitat Biomes -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-2 border-b border-[#1b2e21]/20">
                    <h3 class="font-fredoka text-lg font-bold text-white">Habitat Popularity</h3>
                    <span class="text-[9px] font-mono tracking-widest text-[#C9952A] uppercase">Likes Count</span>
                </div>
                
                <div class="space-y-5 font-sans">
                    @php
                        $maxHabitatLikes = $habitatAnalytics->max('favourites_count') ?: 1;
                    @endphp
                    @forelse($habitatAnalytics as $habitat)
                        @php
                            $percentage = ($habitat->favourites_count / $maxHabitatLikes) * 100;
                        @endphp
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-semibold text-zinc-200">{{ $habitat->name }}</span>
                                <span class="text-gold-400 font-bold font-mono">{{ $habitat->favourites_count }} likes</span>
                            </div>
                            <div class="w-full bg-[#121813] h-2.5 rounded-full overflow-hidden border border-[#1b2e21]/20 relative">
                                <div class="bg-gradient-to-r from-emerald-600 to-gold-500 h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-zinc-500 text-sm">
                            No habitat analytical data available.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Trending Wildlife Section -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-2 border-b border-[#1b2e21]/20">
                    <h3 class="font-fredoka text-lg font-bold text-white">Trending Species</h3>
                    <span class="text-[9px] font-mono tracking-widest text-[#C9952A] uppercase">Recent activity</span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @forelse($trendingAnimals as $animal)
                        <div class="group bg-white/5 border border-white/5 hover:border-gold-500/30 rounded-xl overflow-hidden shadow transition-all duration-300">
                            <div class="aspect-video relative overflow-hidden bg-zinc-950">
                                <img src="{{ $animal->image_path }}" 
                                     onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                     class="w-full h-full object-cover transition-transform group-hover:scale-105" 
                                     alt="{{ $animal->name }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent"></div>
                                <span class="absolute top-2 left-2 px-2 py-0.5 rounded text-[8px] font-mono font-bold uppercase bg-gold-500/20 text-[#C9952A] border border-[#C9952A]/30">
                                    ❤️ {{ $animal->favourited_by_count }}
                                </span>
                            </div>
                            <div class="p-3">
                                <h4 class="font-fredoka text-sm font-bold text-zinc-200 group-hover:text-gold-400 transition-colors truncate">
                                    {{ $animal->name }}
                                </h4>
                                <span class="text-[9px] font-sans text-zinc-500 truncate block mt-0.5">{{ $animal->scientific_name }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-10 text-zinc-500 text-sm">
                            No trending animals logged.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- Leaderboard Listing: Favourite Count Per Animal -->
    <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl overflow-hidden shadow-xl">
        <div class="px-6 py-5 border-b border-[#1b2e21]/30 bg-[#090c0a] flex items-center justify-between">
            <div>
                <h3 class="font-fredoka text-lg font-bold text-white">Wildlife Leaderboard</h3>
                <p class="font-nunito text-xs text-zinc-400">Total favorites count for every animal registered in our database</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse font-sans text-xs">
                <thead>
                    <tr class="bg-[#090c0a] border-b border-[#1b2e21]/30 text-zinc-400 font-mono tracking-wider uppercase text-[9px]">
                        <th class="px-6 py-4">Rank / Animal</th>
                        <th class="px-6 py-4">Habitat</th>
                        <th class="px-6 py-4">Diet</th>
                        <th class="px-6 py-4">Conservation Status</th>
                        <th class="px-6 py-4 text-center">Likes Collected</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1b2e21]/20">
                    @forelse($animalLeaderboard as $index => $animal)
                        <tr class="hover:bg-white/5 transition-colors">
                            <!-- Name & Rank -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <!-- Rank badge -->
                                    <span class="font-mono text-xs w-6 text-zinc-500 font-bold flex justify-center items-center">
                                        @if($index === 0)
                                            🥇
                                        @elseif($index === 1)
                                            🥈
                                        @elseif($index === 2)
                                            🥉
                                        @else
                                            #{{ $index + 1 }}
                                        @endif
                                    </span>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden border border-white/5 bg-zinc-950">
                                            <img src="{{ $animal->image_path }}" 
                                                 onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                                 class="w-full h-full object-cover" 
                                                 alt="{{ $animal->name }}">
                                        </div>
                                        <div>
                                            <span class="block text-sm font-semibold text-zinc-200">{{ $animal->name }}</span>
                                            <span class="block text-[10px] text-zinc-500 italic">{{ $animal->scientific_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Habitat -->
                            <td class="px-6 py-4 text-zinc-300">
                                {{ $animal->habitat->name ?? 'None' }}
                            </td>

                            <!-- Diet -->
                            <td class="px-6 py-4 text-zinc-300 capitalize font-mono text-[10px]">
                                {{ $animal->diet }}
                            </td>

                            <!-- Conservation Status -->
                            <td class="px-6 py-4">
                                @if($animal->conservation_status === 'Least Concern')
                                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        Least Concern
                                    </span>
                                @elseif($animal->conservation_status === 'Vulnerable')
                                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        Vulnerable
                                    </span>
                                @elseif($animal->conservation_status === 'Endangered')
                                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-orange-500/10 text-orange-400 border border-orange-500/20">
                                        Endangered
                                    </span>
                                @elseif($animal->conservation_status === 'Critically Endangered')
                                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-red-500/10 text-red-400 border border-red-500/20 animate-pulse">
                                        Critically Endangered
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-zinc-500/10 text-zinc-400 border border-zinc-500/20">
                                        {{ $animal->conservation_status }}
                                    </span>
                                @endif
                            </td>

                            <!-- Likes count -->
                            <td class="px-6 py-4 text-center font-bold text-[#C9952A] font-mono text-sm">
                                {{ $animal->favourited_by_count }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-500 text-sm">
                                No species recorded.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
