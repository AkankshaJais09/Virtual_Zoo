@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    
    <!-- Top Greeting Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="font-fredoka text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-gold-500 to-amber-500">
                📊 Expedition Control
            </h1>
            <p class="font-nunito text-zinc-400 text-sm mt-1">
                Real-time dashboard for WildVerse user interactions, favorites, and telemetry parameters.
            </p>
        </div>
        <div class="flex items-center gap-2 font-mono text-[10px] bg-forest-950/20 border border-[#1b2e21]/40 rounded-xl px-4 py-2 text-zinc-400">
            <span>Server Refresh:</span>
            <span class="text-emerald-400 font-bold">100% OK</span>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        <!-- Card 1: Total Users -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 text-left shadow-lg backdrop-blur-md relative overflow-hidden group">
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-gold-500/5 rounded-full filter blur-xl group-hover:bg-gold-500/10 transition-all duration-500"></div>
            <span class="text-3xl block mb-3">👥</span>
            <div class="font-fredoka text-4xl text-[#C9952A] mb-1">{{ $stats['total_users'] }}</div>
            <div class="font-nunito text-[10px] text-zinc-400 uppercase tracking-wider font-bold">Registered Explorers</div>
        </div>

        <!-- Card 2: Saved Favourites -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 text-left shadow-lg backdrop-blur-md relative overflow-hidden group">
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-red-500/5 rounded-full filter blur-xl group-hover:bg-red-500/10 transition-all duration-500"></div>
            <span class="text-3xl block mb-3">❤️</span>
            <div class="font-fredoka text-4xl text-[#C9952A] mb-1">{{ $stats['total_favourites'] }}</div>
            <div class="font-nunito text-[10px] text-zinc-400 uppercase tracking-wider font-bold">Favourites Saved</div>
        </div>

        <!-- Card 3: Total Species -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 text-left shadow-lg backdrop-blur-md relative overflow-hidden group">
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-emerald-500/5 rounded-full filter blur-xl group-hover:bg-emerald-500/10 transition-all duration-500"></div>
            <span class="text-3xl block mb-3">🐾</span>
            <div class="font-fredoka text-4xl text-[#C9952A] mb-1">{{ $stats['total_animals'] }}</div>
            <div class="font-nunito text-[10px] text-zinc-400 uppercase tracking-wider font-bold">Wildlife Species</div>
        </div>

        <!-- Card 4: Total Habitats -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 text-left shadow-lg backdrop-blur-md relative overflow-hidden group">
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-blue-500/5 rounded-full filter blur-xl group-hover:bg-blue-500/10 transition-all duration-500"></div>
            <span class="text-3xl block mb-3">🌿</span>
            <div class="font-fredoka text-4xl text-[#C9952A] mb-1">{{ $stats['total_habitats'] }}</div>
            <div class="font-nunito text-[10px] text-zinc-400 uppercase tracking-wider font-bold">Unique Habitats</div>
        </div>
    </div>

    <!-- Charts & Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
        
        <!-- Chart 1: Favourites Count per Popular Species (8 cols) -->
        <div class="lg:col-span-8 bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 shadow-xl relative overflow-hidden flex flex-col justify-between">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h3 class="font-fredoka text-lg font-bold text-white">Popularity Leaderboard</h3>
                    <p class="font-nunito text-xs text-zinc-400">Total likes collected per species from all active users</p>
                </div>
                <span class="px-2.5 py-1 rounded bg-[#C9952A]/10 text-[#C9952A] text-[9px] font-mono border border-[#C9952A]/20">TOP LIKED</span>
            </div>

            <!-- Custom Bar Chart (SVG-based) -->
            <div class="h-60 flex items-end gap-6 md:gap-10 px-4 pt-4 border-b border-[#1b2e21]/30">
                @php
                    $maxLikes = $popularAnimals->max('favourited_by_count') ?: 1;
                @endphp
                @forelse($popularAnimals as $animal)
                    @php
                        $percentage = ($animal->favourited_by_count / $maxLikes) * 100;
                    @endphp
                    <div class="flex-1 flex flex-col items-center group h-full justify-end">
                        <div class="text-[10px] font-mono text-gold-400 font-bold mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            {{ $animal->favourited_by_count }}
                        </div>
                        <div class="w-full bg-[#1b2e21]/30 rounded-t-lg relative group-hover:bg-[#C9952A]/20 transition-all duration-300" style="height: {{ max(10, $percentage) }}%;">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-gold-500 to-yellow-300 rounded-t-lg transition-all duration-500 w-full h-full shadow-[0_0_15px_rgba(201,149,42,0.2)]"></div>
                        </div>
                        <span class="text-[9px] md:text-[10px] font-fredoka text-zinc-300 tracking-wider mt-3 truncate max-w-[60px] md:max-w-none text-center">
                            {{ $animal->name }}
                        </span>
                    </div>
                @empty
                    <div class="flex-1 h-full flex items-center justify-center text-zinc-500 font-nunito text-sm">
                        No likes logged yet.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- System Stats / Breakdown Card (4 cols) -->
        <div class="lg:col-span-4 bg-[#090c0a] border border-[#1b2e21]/20 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <div>
                <h3 class="font-fredoka text-lg font-bold text-white mb-4">Interactions Ratio</h3>
                <div class="space-y-4 font-nunito">
                    <!-- Ratio 1 -->
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-zinc-300">Likes Ratio</span>
                            <span class="text-gold-400 font-bold">
                                @if($stats['total_users'] > 0)
                                    {{ number_format($stats['total_favourites'] / $stats['total_users'], 1) }} likes/user
                                @else
                                    0
                                @endif
                            </span>
                        </div>
                        <div class="w-full bg-[#121813] h-1.5 rounded-full overflow-hidden">
                            <div class="bg-[#C9952A] h-full" style="width: {{ min(100, ($stats['total_favourites'] * 15)) }}%;"></div>
                        </div>
                    </div>
                    <!-- Ratio 2 -->
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-zinc-300">Biodiversity Coverage</span>
                            <span class="text-gold-400 font-bold">
                                @if($stats['total_habitats'] > 0)
                                    {{ number_format($stats['total_animals'] / $stats['total_habitats'], 1) }} species/biome
                                @else
                                    0
                                @endif
                            </span>
                        </div>
                        <div class="w-full bg-[#121813] h-1.5 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full" style="width: {{ min(100, ($stats['total_animals'] * 5)) }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-[#1b2e21]/30">
                <a href="{{ route('admin.favourites') }}" class="w-full inline-flex justify-center items-center py-2.5 rounded-xl bg-gold-500 text-forest-950 text-xs tracking-wider uppercase font-bold hover:bg-gold-400 transition-all shadow-md">
                    View Favourites Analytics
                </a>
            </div>
        </div>
    </div>

    <!-- Active Users & Stream Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Left Pane: Recently Active Users -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-2 border-b border-[#1b2e21]/20">
                    <h3 class="font-fredoka text-lg font-bold text-white">Recent Registrations</h3>
                    <span class="text-[9px] font-mono tracking-widest text-[#C9952A] uppercase">Active Accounts</span>
                </div>
                
                <div class="space-y-4 font-sans">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-gold-500/15 text-[#C9952A] border border-[#C9952A]/25 flex items-center justify-center text-xs">
                                    👤
                                </span>
                                <div>
                                    <span class="block text-sm font-semibold text-zinc-200">{{ $user->name }}</span>
                                    <span class="block text-[10px] text-zinc-500">{{ $user->email }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="block text-[10px] text-zinc-400 font-mono">Saved Favourites: <span class="text-gold-400 font-bold">{{ $user->favourites_count }}</span></span>
                                <span class="block text-[9px] text-zinc-500 mt-0.5">Joined: {{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-zinc-500 text-sm">
                            No registered users.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 pt-4">
                <a href="{{ route('admin.users') }}" class="w-full inline-flex justify-center items-center py-2.5 rounded-xl border border-white/10 hover:bg-white/5 text-[11px] tracking-wider uppercase font-semibold text-zinc-300 hover:text-white transition-all">
                    Manage All Users →
                </a>
            </div>
        </div>

        <!-- Right Pane: Live Activity Interaction Stream -->
        <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-2 border-b border-[#1b2e21]/20">
                    <h3 class="font-fredoka text-lg font-bold text-white">Live System Events</h3>
                    <span class="text-[9px] font-mono tracking-widest text-[#C9952A] uppercase">Interaction Log</span>
                </div>

                <div class="space-y-3 font-mono text-[11px]">
                    @forelse($activities as $activity)
                        <div class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-white/5 transition-all">
                            <span class="mt-0.5 text-xs">
                                @if($activity->type === 'login')
                                    🔑
                                @elseif($activity->type === 'favourite_add')
                                    💚
                                @elseif($activity->type === 'favourite_remove')
                                    💔
                                @elseif($activity->type === 'view_animal')
                                    👁️
                                @else
                                    🐾
                                @endif
                            </span>
                            <div class="flex-1">
                                <p class="text-zinc-200 leading-relaxed">{{ $activity->description }}</p>
                                <span class="text-[9px] text-zinc-500 mt-1 block">
                                    {{ $activity->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-zinc-500 text-sm">
                            No system interactions recorded. Start browsing animals to see live logging in action!
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 pt-4">
                <a href="{{ route('admin.activity') }}" class="w-full inline-flex justify-center items-center py-2.5 rounded-xl border border-white/10 hover:bg-white/5 text-[11px] tracking-wider uppercase font-semibold text-zinc-300 hover:text-white transition-all">
                    Inspect Full Activity Logs →
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
