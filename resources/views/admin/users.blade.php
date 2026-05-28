@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    <!-- Title & Stats Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-[#1b2e21]/20 pb-6">
        <div>
            <h1 class="font-fredoka text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-gold-500 to-amber-500">
                👥 Users Management
            </h1>
            <p class="font-nunito text-zinc-400 text-sm mt-1">
                View, filter, and inspect registration details, favorites profiles, and activity logs of all explorers.
            </p>
        </div>
    </div>

    <!-- Filter & Search Panel -->
    <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl p-6 shadow-md">
        <form method="GET" action="{{ route('admin.users') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Search field -->
            <div class="md:col-span-6 flex flex-col gap-1.5">
                <label for="search" class="text-[9px] tracking-widest font-mono text-gold-400 uppercase font-bold">Search Name or Email</label>
                <div class="relative">
                    <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Search user..."
                           class="w-full bg-[#0c0f0d] border border-[#1b2e21]/30 rounded-xl px-4 py-2.5 text-xs text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-[#C9952A] transition-colors">
                </div>
            </div>

            <!-- Filter Status -->
            <div class="md:col-span-3 flex flex-col gap-1.5">
                <label for="status" class="text-[9px] tracking-widest font-mono text-gold-400 uppercase font-bold">Activity Status</label>
                <select id="status" name="status"
                        class="w-full bg-[#0c0f0d] border border-[#1b2e21]/30 rounded-xl px-4 py-2.5 text-xs text-zinc-300 focus:outline-none focus:border-[#C9952A] transition-colors">
                    <option value="" {{ $status === '' ? 'selected' : '' }}>All Users</option>
                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active (Has Logs)</option>
                    <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Inactive (No Logs)</option>
                </select>
            </div>

            <!-- Action buttons -->
            <div class="md:col-span-3 flex gap-2">
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-gold-500 text-forest-950 font-bold text-xs tracking-wider uppercase hover:bg-gold-400 transition-all cursor-pointer">
                    Apply Filters
                </button>
                <a href="{{ route('admin.users') }}" class="py-2.5 px-4 rounded-xl border border-white/10 text-zinc-400 hover:text-white hover:bg-white/5 transition-all text-xs text-center flex items-center justify-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-forest-950/10 border border-[#1b2e21]/20 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse font-sans text-xs">
                <thead>
                    <tr class="bg-[#090c0a] border-b border-[#1b2e21]/30 text-zinc-400 font-mono tracking-wider uppercase text-[9px]">
                        <th class="px-6 py-4">Explorer Profile</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Joined Date</th>
                        <th class="px-6 py-4 text-center">Favourites Count</th>
                        <th class="px-6 py-4">Last Activity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1b2e21]/20">
                    @forelse($users as $user)
                        <tr class="hover:bg-white/5 transition-colors">
                            <!-- Profile details -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-full bg-gold-500/10 text-[#C9952A] border border-[#C9952A]/20 flex items-center justify-center text-xs">
                                        👤
                                    </span>
                                    <div>
                                        <span class="block text-sm font-semibold text-zinc-200">
                                            {{ $user->name }}
                                            @if($user->is_admin)
                                                <span class="ml-1.5 px-2 py-0.5 rounded text-[8px] font-mono font-bold uppercase bg-[#C9952A]/20 text-[#C9952A] border border-[#C9952A]/30">
                                                    Admin
                                                </span>
                                            @endif
                                        </span>
                                        <span class="block text-xs text-zinc-500">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Live status indicator -->
                            <td class="px-6 py-4">
                                @if($user->activities->isNotEmpty())
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-zinc-500/10 text-zinc-400 border border-zinc-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-zinc-500"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- Joined Date -->
                            <td class="px-6 py-4 text-zinc-300 font-mono">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>

                            <!-- Favourites count -->
                            <td class="px-6 py-4 text-center font-bold text-[#C9952A]">
                                {{ $user->favourites_count }}
                            </td>

                            <!-- Last Activity Log info -->
                            <td class="px-6 py-4 text-zinc-400">
                                @if($user->activities->isNotEmpty())
                                    <div class="max-w-xs truncate" title="{{ $user->activities->first()->description }}">
                                        {{ $user->activities->first()->description }}
                                    </div>
                                    <span class="block text-[9px] text-zinc-500 font-mono mt-0.5">
                                        {{ $user->activities->first()->created_at->diffForHumans() }}
                                    </span>
                                @else
                                    <span class="text-zinc-600 italic">No activity recorded</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-500 text-sm">
                                No registered users matched your criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Custom styled dark Pagination -->
        @if($users->hasPages())
            <div class="bg-[#090c0a] border-t border-[#1b2e21]/30 px-6 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
