@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;700&display=swap');

    .font-fredoka {
        font-family: 'Fredoka One', cursive;
    }
    
    .font-nunito {
        font-family: 'Nunito', sans-serif;
    }
</style>

<div class="pt-24 pb-16 min-h-screen bg-[#1a1a1a] text-zinc-100 flex flex-col items-center">
    
    {{-- PART 1: HERO --}}
    <section class="w-full text-center py-12 px-6">
        <span class="inline-block text-xs font-mono tracking-[0.4em] text-gold-500 font-bold mb-4 uppercase">
            🧠 TEST YOUR KNOWLEDGE
        </span>
        <h1 class="font-fredoka text-4xl md:text-6xl font-bold tracking-wide mb-4 text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-gold-500 to-amber-500">
            Wildlife Facts & Quiz
        </h1>
        <p class="font-nunito text-zinc-400 text-base md:text-lg max-w-lg mx-auto">
            Learn amazing things about the animal kingdom and test your inner explorer!
        </p>
    </section>

    {{-- PART 2: STATS STRIP --}}
    <section class="w-full max-w-6xl px-6 mb-16">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <!-- Box 1: Total Animals -->
            <div 
                x-data="{ current: 0, target: {{ $stats['total_animals'] }} }" 
                x-init="setTimeout(() => {
                    let interval = setInterval(() => {
                        if (current < target) {
                            current += Math.ceil((target - current) / 10) || 1;
                            if (current > target) current = target;
                        } else {
                            clearInterval(interval);
                        }
                    }, 40);
                }, 300)"
                class="bg-zinc-800/40 border border-zinc-700/20 rounded-2xl p-6 text-center shadow-md flex flex-col justify-center"
            >
                <div class="font-fredoka text-4xl md:text-5xl text-[#C9952A] mb-2" x-text="current">0</div>
                <div class="font-nunito text-xs text-zinc-300 uppercase tracking-widest font-bold">Total Species</div>
            </div>

            <!-- Box 2: Endangered Species -->
            <div 
                x-data="{ current: 0, target: {{ $stats['endangered'] }} }" 
                x-init="setTimeout(() => {
                    let interval = setInterval(() => {
                        if (current < target) {
                            current += Math.ceil((target - current) / 10) || 1;
                            if (current > target) current = target;
                        } else {
                            clearInterval(interval);
                        }
                    }, 40);
                }, 400)"
                class="bg-zinc-800/40 border border-zinc-700/20 rounded-2xl p-6 text-center shadow-md flex flex-col justify-center"
            >
                <div class="font-fredoka text-4xl md:text-5xl text-[#C9952A] mb-2" x-text="current">0</div>
                <div class="font-nunito text-xs text-zinc-300 uppercase tracking-widest font-bold">Endangered Status</div>
            </div>

            <!-- Box 3: Habitats -->
            <div 
                x-data="{ current: 0, target: {{ $stats['habitats'] }} }" 
                x-init="setTimeout(() => {
                    let interval = setInterval(() => {
                        if (current < target) {
                            current += Math.ceil((target - current) / 10) || 1;
                            if (current > target) current = target;
                        } else {
                            clearInterval(interval);
                        }
                    }, 40);
                }, 500)"
                class="bg-zinc-800/40 border border-zinc-700/20 rounded-2xl p-6 text-center shadow-md flex flex-col justify-center"
            >
                <div class="font-fredoka text-4xl md:text-5xl text-[#C9952A] mb-2" x-text="current">0</div>
                <div class="font-nunito text-xs text-zinc-300 uppercase tracking-widest font-bold">Unique Habitats</div>
            </div>

            <!-- Box 4: Countries -->
            <div 
                x-data="{ current: 0, target: {{ $stats['countries'] }} }" 
                x-init="setTimeout(() => {
                    let interval = setInterval(() => {
                        if (current < target) {
                            current += Math.ceil((target - current) / 10) || 1;
                            if (current > target) current = target;
                        } else {
                            clearInterval(interval);
                        }
                    }, 40);
                }, 600)"
                class="bg-zinc-800/40 border border-zinc-700/20 rounded-2xl p-6 text-center shadow-md flex flex-col justify-center"
            >
                <div class="font-fredoka text-4xl md:text-5xl text-[#C9952A] mb-2" x-text="current">0</div>
                <div class="font-nunito text-xs text-zinc-300 uppercase tracking-widest font-bold">Countries Covered</div>
            </div>
        </div>
    </section>

    {{-- PART 3: DID YOU KNOW? FACTS WALL --}}
    <section class="w-full max-w-6xl px-6 mb-16">
        <div class="text-center mb-10">
            <span class="inline-block text-xs font-mono tracking-[0.3em] text-gold-400 font-bold mb-3 uppercase">
                💡 AMAZING TRIVIA
            </span>
            <h2 class="font-fredoka text-3xl md:text-4xl font-bold text-white">
                Did You Know?
            </h2>
        </div>

        @php
            $facts = [
                ['text' => "A lion's roar can be heard from 8 km away.", 'animal' => 'Lion'],
                ['text' => "Elephants are the only animals that cannot jump.", 'animal' => 'Elephant'],
                ['text' => "A group of flamingos is called a flamboyance.", 'animal' => 'Flamingo'],
                ['text' => "Octopuses have three hearts and blue blood.", 'animal' => 'Octopus'],
                ['text' => "Cheetahs can go from 0 to 100 km/h in just 3 seconds.", 'animal' => 'Cheetah'],
                ['text' => "A snail can sleep for 3 years straight.", 'animal' => 'Snail'],
                ['text' => "Polar bears have black skin under their white fur.", 'animal' => 'Polar Bear'],
                ['text' => "Dolphins sleep with one eye open.", 'animal' => 'Dolphin'],
                ['text' => "A shark is the only fish that can blink with both eyes.", 'animal' => 'Shark'],
                ['text' => "Gorillas share 98.3% DNA with humans.", 'animal' => 'Gorilla'],
                ['text' => "Arctic foxes can survive in -70°C temperatures.", 'animal' => 'Arctic Fox'],
                ['text' => "Giraffes have the same number of neck bones as humans (7).", 'animal' => 'Giraffe'],
            ];
            $borders = ['border-[#C9952A]', 'border-amber-500', 'border-teal-500'];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($facts as $index => $fact)
                @php $border = $borders[$index % 3]; @endphp
                <div class="bg-zinc-800/30 border-l-4 {{ $border }} rounded-r-2xl p-6 shadow-md hover:scale-[1.03] transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="text-2xl mb-3 filter drop-shadow">💡</div>
                        <p class="font-nunito text-zinc-100 text-sm md:text-base leading-relaxed font-semibold">
                            {{ $fact['text'] }}
                        </p>
                    </div>
                    <div class="mt-4">
                        <span class="inline-block px-3 py-1 rounded-full bg-zinc-800 border border-zinc-700/50 text-[10px] font-bold text-gold-400 uppercase tracking-widest">
                            🐾 {{ $fact['animal'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- PART 3.5: MEET THE RESIDENTS --}}
    <section class="w-full max-w-6xl px-6 mb-16">
        <div class="text-center mb-10">
            <span class="inline-block text-xs font-mono tracking-[0.3em] text-gold-400 font-bold mb-3 uppercase">
                🌍 EXPEDITION SANCTUARIES
            </span>
            <h2 class="font-fredoka text-3xl md:text-4xl font-bold text-white">
                Meet the Residents
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($animals as $animal)
                <div class="group bg-zinc-800/40 border border-zinc-700/20 rounded-2xl overflow-hidden shadow-lg hover:border-gold-500/50 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative overflow-hidden aspect-video w-full bg-zinc-900/50">
                            <img src="{{ $animal->image_path }}" 
                                 onerror="this.src='https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?w=800'"
                                 loading="lazy" 
                                 alt="{{ $animal->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 to-transparent opacity-60"></div>
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase bg-[#C9952A]/20 text-[#C9952A] border border-[#C9952A]/30 backdrop-blur-md">
                                {{ $animal->habitat->name }}
                            </span>
                        </div>
                        
                        <div class="p-5">
                            <h3 class="font-fredoka text-xl font-bold text-white mb-2 group-hover:text-gold-400 transition-colors">
                                {{ $animal->name }}
                            </h3>
                            <p class="font-nunito text-zinc-400 text-xs italic mb-3">
                                {{ $animal->scientific_name }}
                            </p>
                            <p class="font-nunito text-zinc-400 text-xs line-clamp-2 leading-relaxed">
                                {{ $animal->fun_fact }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="px-5 pb-5">
                        <a href="/animals/{{ $animal->id }}" class="w-full inline-flex justify-center items-center py-2.5 rounded-xl border border-[#C9952A]/20 bg-[#C9952A]/5 text-[#C9952A] hover:bg-[#C9952A] hover:text-zinc-900 hover:border-[#C9952A] transition-all duration-300 text-[10px] tracking-widest font-bold uppercase">
                            View Profile →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- PART 4: WILDLIFE QUIZ --}}
    <section id="quiz-section" class="w-full max-w-3xl px-6 mb-16" x-data="quizApp()">
        <div class="bg-zinc-800/40 border border-gold-500/20 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden">
            <!-- Background glow -->
            <div class="absolute -right-16 -top-16 w-32 h-32 bg-gold-500/10 rounded-full filter blur-xl pointer-events-none"></div>

            <!-- Quiz Intro Screen -->
            <div x-show="step === 'intro'" class="text-center py-6">
                <span class="text-5xl block mb-4">🏆</span>
                <h3 class="font-fredoka text-2xl md:text-3xl font-bold text-white mb-4">Are you a Wildlife Expert?</h3>
                <p class="font-nunito text-zinc-300 text-sm md:text-base mb-8 max-w-md mx-auto leading-relaxed">
                    Test your knowledge with 6 quick multiple-choice questions about the earth's most fascinating creatures!
                </p>
                <button 
                    @click="step = 'quiz'" 
                    class="px-8 py-3.5 rounded-full bg-gold-500 text-forest-950 font-bold text-xs tracking-[0.25em] shadow-lg hover:bg-gold-400 hover:scale-105 transition-all duration-300 uppercase cursor-pointer"
                >
                    Start Quiz
                </button>
            </div>

            <!-- Quiz Active Screen -->
            <div x-show="step === 'quiz'" style="display: none;">
                <!-- Header / Progress -->
                <div class="flex justify-between items-center mb-6">
                    <span class="font-fredoka text-sm text-gold-400">
                        Question <span x-text="currentQuestionIndex + 1"></span> of 6
                    </span>
                    <span class="font-mono text-xs text-zinc-400">
                        Score: <span x-text="score"></span>
                    </span>
                </div>

                <!-- Progress Bar -->
                <div class="w-full h-2 bg-zinc-700/50 rounded-full overflow-hidden mb-8">
                    <div 
                        class="h-full bg-[#C9952A] rounded-full transition-all duration-300"
                        :style="'width: ' + (((currentQuestionIndex) / 6) * 100) + '%'"
                    ></div>
                </div>

                <!-- Question Text -->
                <h3 class="font-fredoka text-xl md:text-2xl font-bold text-white mb-8 text-center" x-text="currentQuestion.text"></h3>

                <!-- 2x2 Answer Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <template x-for="(option, index) in currentQuestion.options" :key="index">
                        <button
                            @click="selectAnswer(index)"
                            :disabled="isAnswered"
                            :class="[
                                !isAnswered ? 'bg-zinc-800/60 border-zinc-700/50 text-zinc-200 hover:border-[#C9952A]/50 hover:bg-zinc-800 cursor-pointer' : '',
                                isAnswered && index === currentQuestion.correct ? 'bg-emerald-600/30 border-emerald-500 text-emerald-400 font-bold shadow-[0_0_15px_rgba(16,185,129,0.2)]' : '',
                                isAnswered && selectedAnswer === index && index !== currentQuestion.correct ? 'bg-red-600/30 border-red-500 text-red-400 font-bold' : '',
                                isAnswered && selectedAnswer !== index && index !== currentQuestion.correct ? 'bg-zinc-850 border-zinc-800 text-zinc-500 opacity-60' : ''
                            ]"
                            class="w-full p-4 rounded-2xl border-2 text-left font-nunito text-sm md:text-base font-semibold transition-all duration-300 flex items-center justify-between"
                        >
                            <span x-text="option"></span>
                            
                            <!-- Correct/Incorrect badge -->
                            <template x-if="isAnswered && index === currentQuestion.correct">
                                <span class="text-emerald-400 font-bold">✓</span>
                            </template>
                            <template x-if="isAnswered && selectedAnswer === index && index !== currentQuestion.correct">
                                <span class="text-red-400 font-bold">✕</span>
                            </template>
                        </button>
                    </template>
                </div>

                <!-- Explanation / Trivia Fun Fact -->
                <div 
                    x-show="isAnswered" 
                    x-transition
                    class="bg-[#C9952A]/10 border border-[#C9952A]/30 rounded-2xl p-5 mb-8 text-center text-xs md:text-sm font-nunito font-semibold text-gold-300 leading-relaxed"
                >
                    <span class="block text-gold-400 font-bold font-fredoka text-sm mb-1">💡 DID YOU KNOW?</span>
                    <span x-text="currentQuestion.fact"></span>
                </div>

                <!-- Next Question Action Button -->
                <div class="flex justify-end" x-show="isAnswered">
                    <button
                        @click="nextQuestion()"
                        class="px-6 py-3 rounded-full bg-gold-500 text-forest-950 font-bold text-xs tracking-widest shadow-lg hover:bg-gold-400 hover:scale-105 transition-all duration-200 uppercase cursor-pointer"
                    >
                        <span x-text="currentQuestionIndex === 5 ? 'Finish Quiz' : 'Next Question →'"></span>
                    </button>
                </div>
            </div>

            <!-- Quiz Results Screen -->
            <div x-show="step === 'result'" style="display: none;" class="text-center py-6">
                <span class="text-5xl block mb-4" x-text="score === 6 ? '🏆' : (score >= 4 ? '🌿' : '🔍')"></span>
                <h3 class="font-fredoka text-3xl font-bold text-white mb-2" x-text="getFeedbackTitle()"></h3>
                
                <div class="font-fredoka text-6xl text-[#C9952A] my-6">
                    <span x-text="score"></span> / 6
                </div>

                <p class="font-nunito text-zinc-300 text-sm md:text-base mb-8 max-w-md mx-auto leading-relaxed" x-text="getFeedbackMessage()"></p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <button 
                        @click="resetQuiz()" 
                        class="px-8 py-3.5 rounded-full bg-gold-500 text-forest-950 font-bold text-xs tracking-widest shadow-lg hover:bg-gold-400 hover:scale-105 transition-all duration-300 uppercase cursor-pointer"
                    >
                        Try Again
                    </button>
                    <a 
                        href="/animals" 
                        class="px-8 py-3.5 rounded-full border border-white/20 text-white font-semibold text-xs tracking-widest hover:bg-white/5 hover:border-white/40 hover:scale-105 transition-all duration-300 uppercase text-center"
                    >
                        Discover Animals →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- PART 5: BOTTOM CTA STRIP --}}
    <section class="w-full max-w-6xl px-6">
        <div class="bg-gradient-to-br from-[#0a140f] to-moss-950 border border-gold-500/10 rounded-3xl p-10 md:p-14 text-center shadow-xl relative overflow-hidden">
            <div class="absolute inset-0 bg-radial-gradient from-emerald-950/20 to-transparent pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="font-fredoka text-3xl md:text-5xl text-white font-bold mb-4">
                    Ready to meet the animals?
                </h2>
                <p class="font-nunito text-zinc-300 text-sm md:text-base mb-8 font-light max-w-md mx-auto leading-relaxed">
                    Your wild adventure has just begun! Dive into our habitats or view the full list of species.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-stretch sm:items-center gap-4">
                    <a href="/explore" class="px-8 py-3.5 rounded-full bg-gold-500 text-forest-950 font-bold text-xs tracking-[0.2em] shadow-lg hover:bg-gold-400 hover:scale-105 transition-all duration-300 text-center">
                        Explore Habitats
                    </a>
                    <a href="/animals" class="px-8 py-3.5 rounded-full border border-white/20 text-white font-semibold text-xs tracking-[0.2em] bg-white/5 hover:bg-white/10 hover:border-white/40 hover:scale-105 transition-all duration-300 text-center">
                        See All Animals
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    function quizApp() {
        return {
            step: 'intro',
            currentQuestionIndex: 0,
            selectedAnswer: null,
            isAnswered: false,
            score: 0,
            questions: [
                {
                    text: "What is the fastest land animal?",
                    options: ["A) Lion", "B) Cheetah", "C) Leopard", "D) Horse"],
                    correct: 1,
                    fact: "Cheetahs can accelerate from 0 to 100 km/h in just 3 seconds!"
                },
                {
                    text: "How many hearts does an octopus have?",
                    options: ["A) 1", "B) 2", "C) 3", "D) 4"],
                    correct: 2,
                    fact: "Octopuses have 3 hearts and blue blood. Two pump blood to the gills, one to the body!"
                },
                {
                    text: "Which animal has the longest lifespan?",
                    options: ["A) Elephant", "B) Tortoise", "C) Whale", "D) Parrot"],
                    correct: 1,
                    fact: "Giant tortoises can live for over 150 years! Some have even lived over 250 years."
                },
                {
                    text: "What do you call a group of lions?",
                    options: ["A) Pack", "B) Herd", "C) Pride", "D) Colony"],
                    correct: 2,
                    fact: "A pride consists of related females, their offspring, and a small group of males."
                },
                {
                    text: "How far can a lion's roar be heard?",
                    options: ["A) 2 km", "B) 5 km", "C) 8 km", "D) 15 km"],
                    correct: 2,
                    fact: "A lion's roar is so loud it can be heard from 8 kilometers (5 miles) away!"
                },
                {
                    text: "Which animal shares the most DNA with humans?",
                    options: ["A) Chimpanzee", "B) Gorilla", "C) Orangutan", "D) Baboon"],
                    correct: 1,
                    fact: "Gorillas share about 98.3% of their DNA with humans, making them our close relatives!"
                }
            ],

            get currentQuestion() {
                return this.questions[this.currentQuestionIndex];
            },

            selectAnswer(index) {
                if (this.isAnswered) return;
                this.selectedAnswer = index;
                this.isAnswered = true;
                if (index === this.currentQuestion.correct) {
                    this.score++;
                }
            },

            nextQuestion() {
                this.selectedAnswer = null;
                this.isAnswered = false;
                if (this.currentQuestionIndex < this.questions.length - 1) {
                    this.currentQuestionIndex++;
                } else {
                    this.step = 'result';
                }
            },

            resetQuiz() {
                this.currentQuestionIndex = 0;
                this.selectedAnswer = null;
                this.isAnswered = false;
                this.score = 0;
                this.step = 'quiz';
            },

            getFeedbackTitle() {
                if (this.score === 6) return "Wildlife Expert! 🏆";
                if (this.score >= 4) return "Nature Lover! 🌿";
                return "Keep Exploring! 🔍";
            },

            getFeedbackMessage() {
                if (this.score === 6) return "Amazing job! You know almost everything about our planet's wildlife!";
                if (this.score >= 4) return "Great score! You have a wonderful heart for nature and wild animals.";
                return "Every expert started as a beginner. Explore our biomes to learn more fun facts!";
            }
        };
    }
</script>
@endsection
