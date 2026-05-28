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
                Sanctuary Registration
            </p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div class="flex flex-col">
                <label for="name" class="font-fredoka text-sm text-[#1b4332] mb-1">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 bg-white/80 font-nunito text-zinc-800 text-sm focus:outline-none focus:border-[#1b4332] focus:ring-1 focus:ring-[#1b4332]/20 transition-colors">
                @error('name')
                    <span class="text-red-600 text-xs mt-1 block font-sans font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="flex flex-col">
                <label for="email" class="font-fredoka text-sm text-[#1b4332] mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 bg-white/80 font-nunito text-zinc-800 text-sm focus:outline-none focus:border-[#1b4332] focus:ring-1 focus:ring-[#1b4332]/20 transition-colors">
                @error('email')
                    <span class="text-red-600 text-xs mt-1 block font-sans font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="flex flex-col">
                <label for="password" class="font-fredoka text-sm text-[#1b4332] mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 bg-white/80 font-nunito text-zinc-800 text-sm focus:outline-none focus:border-[#1b4332] focus:ring-1 focus:ring-[#1b4332]/20 transition-colors">
                @error('password')
                    <span class="text-red-600 text-xs mt-1 block font-sans font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="flex flex-col">
                <label for="password_confirmation" class="font-fredoka text-sm text-[#1b4332] mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-zinc-300 bg-white/80 font-nunito text-zinc-800 text-sm focus:outline-none focus:border-[#1b4332] focus:ring-1 focus:ring-[#1b4332]/20 transition-colors">
                @error('password_confirmation')
                    <span class="text-red-600 text-xs mt-1 block font-sans font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-[#1b4332] text-[#ffd54f] font-fredoka text-sm tracking-wider hover:brightness-110 hover:shadow-lg transition-all duration-300 uppercase cursor-pointer">
                    Register
                </button>
            </div>
        </form>

        <!-- Login Link -->
        <div class="mt-6 pt-5 border-t border-zinc-200 text-center font-nunito text-xs text-zinc-500 font-semibold">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-[#1b4332] hover:underline font-bold ml-1">
                Log in here
            </a>
        </div>

    </div>
</main>
@endsection
