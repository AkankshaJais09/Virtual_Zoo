<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Expedition Control Panel – WildVerse Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <style>
        .font-fredoka {
            font-family: 'Fredoka One', cursive;
        }
        .font-nunito {
            font-family: 'Nunito', sans-serif;
        }
        /* Custom dark theme scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0c0f0d;
        }
        ::-webkit-scrollbar-thumb {
            background: #1b2e21;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #C9952A;
        }
    </style>
</head>
<body class="bg-[#0c0f0d] text-zinc-100 font-sans antialiased overflow-x-hidden">

    <div class="flex min-h-screen">
        
        <!-- Sticky Sidebar -->
        <aside class="w-64 bg-[#090c0a] border-r border-[#1b2e21]/40 shrink-0 hidden md:flex flex-col justify-between p-6">
            <div>
                <!-- Brand / Logo -->
                <div class="mb-10">
                    <a href="/" class="flex items-center gap-3 group">
                        <span class="p-2 rounded-lg bg-gold-500/10 border border-gold-500/20 text-[#C9952A]">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 14c-2.2 0-4 1.8-4 4 0 1.5 1 2 2 2h4c1 0 2-.5 2-2 0-2.2-1.8-4-4-4z" />
                                <circle cx="6" cy="10" r="1.5" />
                                <circle cx="10" cy="7" r="1.5" />
                                <circle cx="14" cy="7" r="1.5" />
                                <circle cx="18" cy="10" r="1.5" />
                            </svg>
                        </span>
                        <div class="flex flex-col">
                            <span class="font-fredoka tracking-widest text-base font-bold bg-clip-text text-transparent bg-gradient-to-r from-zinc-100 to-gold-400">
                                WILDVERSE
                            </span>
                            <span class="text-[8px] tracking-[0.3em] text-[#C9952A] font-mono -mt-1 uppercase">ADMIN PORTAL</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation menu -->
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 font-fredoka text-xs tracking-wider uppercase border {{ request()->routeIs('admin.dashboard') ? 'bg-[#C9952A]/10 text-[#C9952A] border-[#C9952A]/20' : 'text-zinc-400 border-transparent hover:text-zinc-100 hover:bg-white/5' }}">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('admin.users') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 font-fredoka text-xs tracking-wider uppercase border {{ request()->routeIs('admin.users') ? 'bg-[#C9952A]/10 text-[#C9952A] border-[#C9952A]/20' : 'text-zinc-400 border-transparent hover:text-zinc-100 hover:bg-white/5' }}">
                        👥 Users Management
                    </a>
                    <a href="{{ route('admin.favourites') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 font-fredoka text-xs tracking-wider uppercase border {{ request()->routeIs('admin.favourites') ? 'bg-[#C9952A]/10 text-[#C9952A] border-[#C9952A]/20' : 'text-zinc-400 border-transparent hover:text-zinc-100 hover:bg-white/5' }}">
                        ❤️ Favourites Analytics
                    </a>
                    <a href="{{ route('admin.activity') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 font-fredoka text-xs tracking-wider uppercase border {{ request()->routeIs('admin.activity') ? 'bg-[#C9952A]/10 text-[#C9952A] border-[#C9952A]/20' : 'text-zinc-400 border-transparent hover:text-zinc-100 hover:bg-white/5' }}">
                        📜 Activity Logs
                    </a>
                </nav>
            </div>

            <!-- Footer: User status -->
            <div class="pt-6 border-t border-[#1b2e21]/40">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 rounded-full bg-gold-500/10 border border-[#C9952A]/30 flex items-center justify-center text-sm">
                        👤
                    </span>
                    <div class="overflow-hidden">
                        <span class="block text-xs font-bold text-zinc-300 truncate">{{ auth()->user()->name }}</span>
                        <span class="block text-[9px] font-mono tracking-wider text-[#C9952A] uppercase">System Admin</span>
                    </div>
                </div>
                
                <a href="/" class="w-full inline-flex justify-center items-center py-2.5 rounded-xl border border-white/10 hover:bg-white/5 text-[10px] tracking-wider uppercase font-semibold text-zinc-400 hover:text-white transition-all">
                    Return to Site
                </a>
            </div>
        </aside>

        <!-- Main Workspace Area -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- Top Navbar -->
            <header class="h-16 border-b border-[#1b2e21]/40 bg-[#090c0a]/80 backdrop-blur-md px-6 flex items-center justify-between">
                
                <!-- System status stats -->
                <div class="flex items-center gap-4 text-xs font-mono">
                    <span class="px-2 py-1 rounded bg-[#C9952A]/10 text-[#C9952A] border border-[#C9952A]/20 uppercase text-[9px] tracking-wider">
                        SYS: ONLINE
                    </span>
                    <span class="text-zinc-500 hidden sm:inline">CONTROL PANEL</span>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-xs text-zinc-400 font-mono hidden md:inline">20.0123° N, 155.6721° W</span>
                    
                    <!-- Logout form -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-1.5 rounded-lg border border-red-500/20 bg-red-500/5 text-red-400 hover:bg-red-500 hover:text-white transition-all text-[10px] tracking-wider uppercase font-semibold">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main view layout slot -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>
