@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-[#121813] flex items-center justify-center pt-28 pb-12 px-6">
    <!-- Centered Card -->
    <div class="w-full max-w-md bg-[#fffde7] rounded-3xl shadow-2xl p-8 md:p-10 border border-[#ffd54f]/30">
        
        <!-- Header: Logo & Site Name -->
        <div class="text-center mb-8">
            <svg class="w-14 h-14 mx-auto text-[#1b4332] mb-3 filter drop-shadow" viewBox="0 0 24 24" fill="currentColor">
                <!-- Paw pad -->
                <path d="M12 14c-2.2 0-4 1.8-4 4 0 1.5 1 2 2 2h4c1 0 2-.5 2-2 0-2.2-1.8-4-4-4z" />
                <!-- 4 toes -->
                <circle cx="6" cy="10" r="2" />
                <circle cx="10" cy="7" r="2" />
                <circle cx="14" cy="7" r="2" />
                <circle cx="18" cy="10" r="2" />
            </svg>
            <h2 class="font-fredoka text-3xl font-bold text-[#1b4332] tracking-wide">
                WildVerse
            </h2>
            <p class="font-nunito text-zinc-600 text-xs font-semibold mt-1 tracking-wider uppercase">
                Sanctuary Login
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-nunito font-semibold text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="flex flex-col">
                <label for="email" class="font-fredoka text-sm text-[#1b4332] mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full px-4 py-3 rounded-xl border border-zinc-300 bg-white/80 font-nunito text-zinc-800 text-sm focus:outline-none focus:border-[#1b4332] focus:ring-1 focus:ring-[#1b4332]/20 transition-colors">
                @error('email')
                    <span class="text-red-600 text-xs mt-1 block font-sans font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="flex flex-col">
                <label for="password" class="font-fredoka text-sm text-[#1b4332] mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full px-4 py-3 rounded-xl border border-zinc-300 bg-white/80 font-nunito text-zinc-800 text-sm focus:outline-none focus:border-[#1b4332] focus:ring-1 focus:ring-[#1b4332]/20 transition-colors">
                @error('password')
                    <span class="text-red-600 text-xs mt-1 block font-sans font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between font-nunito text-xs text-zinc-600 font-semibold">
                <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-zinc-300 text-[#1b4332] focus:ring-[#1b4332]/40 w-4 h-4 mr-2">
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[#1b4332] hover:underline hover:text-[#ffd54f] transition-colors">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-[#1b4332] text-[#ffd54f] font-fredoka text-sm tracking-wider hover:brightness-110 hover:shadow-lg transition-all duration-300 uppercase cursor-pointer">
                    Log In
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="mt-8 pt-6 border-t border-zinc-200 text-center font-nunito text-xs text-zinc-500 font-semibold">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-[#1b4332] hover:underline font-bold ml-1">
                Register here
            </a>
        </div>

    </div>
</main>
@endsection
