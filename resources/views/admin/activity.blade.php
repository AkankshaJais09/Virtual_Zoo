@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-[#1b2e21]/20 pb-6">
        <div>
            <h1 class="font-fredoka text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-gold-500 to-amber-500">
                📜 Activity Logs
            </h1>
            <p class="font-nunito text-zinc-400 text-sm mt-1">
                Deep audit trail of all registered user actions: logins, details views, and favorites modifications.
            </p>
        </div>
    </div>

    <!-- Filter Panel -->
    <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 shadow-md">
        <form method="GET" action="{{ route('admin.activity') }}" class="flex flex-wrap items-end gap-4">
            <!-- Event Type -->
            <div class="flex-1 min-w-[200px] flex flex-col gap-1.5">
                <label for="type" class="text-[9px] tracking-widest font-mono text-gold-400 uppercase font-bold">Event Type</label>
                <select id="type" name="type"
                        class="w-full bg-[#0c0f0d] border border-[#1b2e21]/30 rounded-xl px-4 py-2.5 text-xs text-zinc-300 focus:outline-none focus:border-[#C9952A] transition-colors">
                    <option value="" {{ $type === '' ? 'selected' : '' }}>All Event Types</option>
                    <option value="login" {{ $type === 'login' ? 'selected' : '' }}>🔑 Logins</option>
                    <option value="favourite_add" {{ $type === 'favourite_add' ? 'selected' : '' }}>💚 Added Favourite</option>
                    <option value="favourite_remove" {{ $type === 'favourite_remove' ? 'selected' : '' }}>💔 Removed Favourite</option>
                    <option value="view_animal" {{ $type === 'view_animal' ? 'selected' : '' }}>👁️ Viewed Animal Profile</option>
                </select>
            </div>

            <!-- Action buttons -->
            <div class="flex gap-2">
                <button type="submit" class="px-8 py-2.5 rounded-xl bg-gold-500 text-forest-950 font-bold text-xs tracking-wider uppercase hover:bg-gold-400 transition-all cursor-pointer">
                    Apply Filter
                </button>
                <a href="{{ route('admin.activity') }}" class="py-2.5 px-4 rounded-xl border border-white/10 text-zinc-400 hover:text-white hover:bg-white/5 transition-all text-xs text-center flex items-center justify-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Event List Log -->
    <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl overflow-hidden shadow-xl">
        <div class="p-6 border-b border-[#1b2e21]/30 bg-[#090c0a]">
            <h3 class="font-fredoka text-lg font-bold text-white">Event Audit Trail</h3>
        </div>

        <div class="p-6 space-y-4">
            @forelse($activities as $activity)
                <div class="flex items-start gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:border-gold-500/10 transition-all font-mono text-xs">
                    <!-- Icon -->
                    <span class="text-xl mt-0.5 p-2 bg-[#0c0f0d] rounded-lg border border-[#1b2e21]/20">
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

                    <!-- Details -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-1.5">
                            <span class="text-gold-400 font-bold text-xs">
                                @if($activity->type === 'login')
                                    LOGIN_EVENT
                                @elseif($activity->type === 'favourite_add')
                                    FAVOURITE_ADD
                                @elseif($activity->type === 'favourite_remove')
                                    FAVOURITE_REMOVE
                                @elseif($activity->type === 'view_animal')
                                    ANIMAL_VIEW
                                @else
                                    SYSTEM_EVENT
                                @endif
                            </span>
                            <span class="text-[10px] text-zinc-500">
                                {{ $activity->created_at->format('Y-m-d H:i:s') }} ({{ $activity->created_at->diffForHumans() }})
                            </span>
                        </div>
                        <p class="text-zinc-200 leading-relaxed">{{ $activity->description }}</p>
                        
                        @if($activity->user)
                            <div class="mt-2 flex items-center gap-4 text-[10px] text-zinc-400">
                                <span>User: <strong class="text-zinc-300">{{ $activity->user->name }}</strong> (ID: {{ $activity->user->id }})</span>
                                @if($activity->animal)
                                    <span>Animal: <strong class="text-zinc-300">{{ $activity->animal->name }}</strong> (ID: {{ $activity->animal->id }})</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-zinc-500 text-sm">
                    No activity logs found for your selection.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($activities->hasPages())
            <div class="bg-[#090c0a] border-t border-[#1b2e21]/30 px-6 py-4">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
