<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WildVerse') }} – Interactive Virtual Zoo</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <style>
        /* Global Brand Fonts */
        .font-fredoka {
            font-family: 'Fredoka One', cursive;
        }
        .font-nunito {
            font-family: 'Nunito', sans-serif;
        }

        /* Heart button styles */
        .fav-btn {
            position: absolute;
            top: 12px; right: 12px;
            background: rgba(255,255,255,0.92);
            border: none;
            border-radius: 50%;
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: transform 0.2s, background 0.2s;
            color: #ccc;
            z-index: 10;
        }
        .fav-btn:hover { transform: scale(1.15); }
        .fav-btn.is-favourited { color: #e53935; }
        .fav-btn.is-favourited svg { fill: #e53935; stroke: #e53935; }

        /* Navbar links styles */
        .nav-link {
            font-family: 'Fredoka One', cursive;
            font-size: 10.5px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #d1d5db; /* zinc-300 */
            transition: color 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }
        .nav-link:hover {
            color: #C9952A; /* gold */
        }
        .nav-btn {
            font-family: 'Fredoka One', cursive;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 600;
            color: #C9952A;
            border: 1px solid rgba(201,149,42,0.4);
            padding: 6px 14px;
            border-radius: 9999px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .nav-btn:hover {
            background-color: #C9952A;
            color: #121813;
            border-color: #C9952A;
        }
        .fav-count-badge {
            background-color: #e53935;
            color: #ffffff;
            font-size: 9px;
            padding: 1px 4px;
            border-radius: 9999px;
            margin-left: 2px;
            font-family: sans-serif;
            font-weight: bold;
        }
        .nav-user {
            font-family: 'Fredoka One', cursive;
            font-size: 10.5px;
            letter-spacing: 0.05em;
            color: #C9952A;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }
        .nav-link-btn {
            background: none;
            border: none;
            font-family: 'Fredoka One', cursive;
            font-size: 10.5px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #d1d5db;
            transition: color 0.3s;
            cursor: pointer;
            padding: 0;
        }
        .nav-link-btn:hover {
            color: #e53935;
        }

        /* Toast animations */
        @keyframes slideUp {
            from { transform: translateY(100%) scale(0.9); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .coords-tag {
            font-family: monospace;
            font-size: 9px;
            letter-spacing: 0.2em;
            color: #C9952A;
            background-color: rgba(201,149,42,0.1);
            border: 1px solid rgba(201,149,42,0.2);
            padding: 4px 10px;
            border-radius: 9999px;
        }
    </style>
</head>
<body class="bg-[#121813] text-zinc-100 font-sans antialiased overflow-x-hidden">

    <!-- Expedition Navbar -->
    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-500 bg-[#0e1610]/95 shadow-2xl border-b border-gold-500/10 backdrop-blur-xl py-4" 
            x-data="{ isOpen: false }">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            
            <!-- Branding -->
            <a href="/" class="flex items-center gap-3 group">
                <span class="p-2 rounded-lg bg-gold-500/10 border border-gold-500/20 text-gold-500 group-hover:border-gold-500/40 transition-colors duration-300">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 14c-2.2 0-4 1.8-4 4 0 1.5 1 2 2 2h4c1 0 2-.5 2-2 0-2.2-1.8-4-4-4z" />
                        <circle cx="6" cy="10" r="2" />
                        <circle cx="10" cy="7" r="2" />
                        <circle cx="14" cy="7" r="2" />
                        <circle cx="18" cy="10" r="2" />
                    </svg>
                </span>
                <div class="flex flex-col">
                    <span class="font-fredoka tracking-widest text-lg md:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zinc-100 to-gold-400">
                        WILDVERSE
                    </span>
                    <span class="text-[8px] tracking-[0.3em] text-[#C9952A] font-mono -mt-1 uppercase">EXPEDITION HUB</span>
                </div>
            </a>

            <!-- Menu Links -->
            <nav class="hidden md:flex items-center gap-5">
                <a href="/" class="nav-link">HOME</a>
                <a href="/explore" class="nav-link">EXPLORE</a>
                <a href="/visit" class="nav-link">SAFARI</a>
                <a href="/facts" class="nav-link">FACTS</a>
                <a href="/about" class="nav-link">ABOUT</a>
            </nav>

            <!-- Actions / Auth Section -->
            <div class="hidden md:flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-btn">Sign Up</a>
                @endguest

                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">⚙️ Admin</a>
                    @endif
                    <a href="{{ route('favourites.index') }}" class="nav-link">
                        ❤️ Favourites
                        @php $count = auth()->user()->favourites()->count(); @endphp
                        @if($count > 0)
                            <span class="fav-count-badge">{{ $count }}</span>
                        @endif
                    </a>
                    <span class="nav-user">👤 {{ explode(' ', auth()->user()->name)[0] }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="nav-link-btn">Logout</button>
                    </form>
                @endauth
            </div>
            
            <!-- Mobile Toggle -->
            <button @click="isOpen = !isOpen" class="md:hidden p-2 text-zinc-400 hover:text-zinc-100 focus:outline-none">
                <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden absolute top-20 left-0 w-full bg-[#0e1610]/95 border-b border-gold-500/10 backdrop-blur-xl z-40 py-8 px-8 flex flex-col gap-6"
             style="display: none;">
            <a @click="isOpen = false" href="/" class="nav-link">HOME</a>
            <a @click="isOpen = false" href="/explore" class="nav-link">EXPLORE ZONES</a>
            <a @click="isOpen = false" href="/visit" class="nav-link">VIRTUAL SAFARI</a>
            <a @click="isOpen = false" href="/facts" class="nav-link">WILDLIFE FACTS</a>
            <a @click="isOpen = false" href="/about" class="nav-link">ABOUT</a>
            
            <div class="h-[1px] bg-white/5 my-2"></div>
            
            <div class="flex flex-col gap-4">
                @guest
                    <a @click="isOpen = false" href="{{ route('login') }}" class="nav-link">Login</a>
                    <a @click="isOpen = false" href="{{ route('register') }}" class="nav-btn text-center">Sign Up</a>
                @endguest

                @auth
                    @if(auth()->user()->is_admin)
                        <a @click="isOpen = false" href="{{ route('admin.dashboard') }}" class="nav-link">⚙️ Admin Dashboard</a>
                    @endif
                    <a @click="isOpen = false" href="{{ route('favourites.index') }}" class="nav-link">
                        ❤️ Favourites
                        @php $count = auth()->user()->favourites()->count(); @endphp
                        @if($count > 0)
                            <span class="fav-count-badge">{{ $count }}</span>
                        @endif
                    </a>
                    <span class="nav-user">👤 {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:block;">
                        @csrf
                        <button type="submit" class="nav-link-btn w-full text-left">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <div class="min-h-screen">
        @yield('content')
        {{ $slot ?? '' }}
    </div>

    <!-- Heart button Toggle JS & Toast logic -->
    <script>
        // Toast notification logic
        function showToast(msg, isAdd) {
            const t = document.createElement('div');
            t.textContent = (isAdd ? '❤️ ' : '💔 ') + msg;
            t.style.cssText = `position:fixed;bottom:24px;right:24px;background:${isAdd?'#2e7d32':'#c62828'};
                color:#fff;padding:10px 20px;border-radius:30px;font-family:'Fredoka One',cursive;
                font-size:15px;z-index:9999;box-shadow:0 4px 16px rgba(0,0,0,0.25);
                animation:slideUp 0.3s ease;`;
            document.body.appendChild(t);
            setTimeout(() => {
                t.style.transition = 'opacity 0.5s ease';
                t.style.opacity = '0';
                setTimeout(() => t.remove(), 500);
            }, 2500);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Setup listener for heart buttons
            document.querySelectorAll('.fav-btn[data-animal-id]').forEach(btn => {
                if (btn.dataset.favourited === 'true') {
                    btn.classList.add('is-favourited');
                }

                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    const animalId = btn.dataset.animalId;
                    try {
                        const res = await fetch('/favourites/toggle', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ animal_id: animalId })
                        });
                        const data = await res.json();
                        
                        // Show toast
                        showToast(data.message, data.favourited);

                        // If on favourites page and item is unfavourited, remove the card from DOM
                        if (!data.favourited && window.location.pathname.includes('/favourites')) {
                            const card = btn.closest('.animal-card');
                            if (card) {
                                card.remove();
                                
                                // Update count badge next to page title
                                const grid = document.querySelector('.favourites-grid');
                                if (grid) {
                                    const cardsLeft = grid.querySelectorAll('.animal-card').length;
                                    const countPill = document.querySelector('.fav-count-pill');
                                    if (countPill) {
                                        countPill.textContent = `${cardsLeft} ${cardsLeft === 1 ? 'animal' : 'animals'} saved`;
                                    }
                                    if (cardsLeft === 0) {
                                        grid.style.display = 'none';
                                        const emptyState = document.querySelector('.favourites-empty-state');
                                        if (emptyState) {
                                            emptyState.style.display = 'flex';
                                        }
                                    }
                                }
                            }
                        } else {
                            // Just toggle class
                            btn.classList.toggle('is-favourited', data.favourited);
                            btn.dataset.favourited = data.favourited;
                        }

                        // Pulse animation
                        btn.style.transform = 'scale(1.35)';
                        setTimeout(() => btn.style.transform = '', 200);

                        // Dynamically update the count badge in the navbar header
                        const navBadge = document.querySelector('.fav-count-badge');
                        const navLink = document.querySelector('a[href*="/favourites"]');
                        
                        // Fetch the current count or calculate it
                        let currentCount = 0;
                        if (navBadge) {
                            currentCount = parseInt(navBadge.textContent) || 0;
                        }
                        
                        if (data.favourited) {
                            currentCount++;
                        } else {
                            currentCount = Math.max(0, currentCount - 1);
                        }
                        
                        if (currentCount > 0) {
                            if (navBadge) {
                                navBadge.textContent = currentCount;
                            } else if (navLink) {
                                const newBadge = document.createElement('span');
                                newBadge.className = 'fav-count-badge';
                                newBadge.textContent = currentCount;
                                navLink.appendChild(newBadge);
                            }
                        } else {
                            if (navBadge) {
                                navBadge.remove();
                            }
                        }
                    } catch(err) {
                        console.error('Favourite error:', err);
                    }
                });
            });
        });
    </script>
</body>
</html>
