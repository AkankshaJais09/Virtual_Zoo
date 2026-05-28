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

    /* Wooden pill styles */
    .hab-tab {
        background-color: #e8f5e9;
        color: #2e7d32;
        font-family: 'Fredoka One', cursive;
        border-color: transparent;
        transition: all 0.2s ease-in-out;
    }
    
    .hab-tab:hover {
        transform: scale(1.05);
    }

    .hab-tab.active {
        background-color: #2e7d32 !important;
        color: white !important;
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(46, 125, 50, 0.4);
    }
</style>

<div id="visitApp" x-data="safariApp()" class="pt-24 pb-16 min-h-screen bg-[#1a1a1a] text-zinc-100 flex flex-col items-center">
    
    <!-- Title Section -->
    <div class="text-center py-6 px-4">
        <h1 class="font-fredoka text-4xl md:text-6xl font-bold tracking-wide mb-2 text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-gold-500 to-amber-500">
            🌍 WildVerse Safari
        </h1>
        <p class="font-nunito text-zinc-400 text-base md:text-lg max-w-lg mx-auto">
            Hop in the jeep and explore the wild!
        </p>
    </div>

    <!-- Habitat Tabs Section -->
    <div class="flex flex-wrap justify-center gap-3 md:gap-4 mb-8 px-4">
        <button 
            onclick="switchHabitat('savanna')"
            class="hab-tab active flex items-center gap-2 px-5 py-2.5 rounded-full font-bold shadow-md text-xs md:text-sm cursor-pointer"
            data-habitat="savanna"
        >
            🌅 African Savanna
        </button>
        <button 
            onclick="switchHabitat('amazon')"
            class="hab-tab flex items-center gap-2 px-5 py-2.5 rounded-full font-bold shadow-md text-xs md:text-sm cursor-pointer"
            data-habitat="amazon"
        >
            🌿 Amazon Jungle
        </button>
        <button 
            onclick="switchHabitat('arctic')"
            class="hab-tab flex items-center gap-2 px-5 py-2.5 rounded-full font-bold shadow-md text-xs md:text-sm cursor-pointer"
            data-habitat="arctic"
        >
            ❄️ Arctic Tundra
        </button>
        <button 
            onclick="switchHabitat('reef')"
            class="hab-tab flex items-center gap-2 px-5 py-2.5 rounded-full font-bold shadow-md text-xs md:text-sm cursor-pointer"
            data-habitat="reef"
        >
            🐠 Coral Reef
        </button>
    </div>

    <!-- Canvas Scene Area -->
    <div class="relative w-full max-w-5xl px-4 mb-8">
        <div class="relative w-full overflow-hidden rounded-3xl shadow-2xl border-4 border-gold-500/40 bg-slate-900">
            <!-- Canvas -->
            <canvas id="safariCanvas" class="w-full block"></canvas>

            <!-- Floating Animal Info Popup -->
            <div 
                id="safariPopup" 
                x-show="popupVisible"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                style="display:none; position:absolute; bottom:20px; left:50%;
                       transform:translateX(-50%); background:linear-gradient(135deg,#fffde7,#e8f5e9);
                       border-radius:20px; padding:20px 28px; border:3px solid #ffd54f;
                       box-shadow:0 8px 32px rgba(0,0,0,0.35); max-width:340px; width:90%; z-index:50;
                       font-family:'Fredoka One',cursive; text-align:center;"
            >
                <button @click="closePopup()" style="position:absolute;top:8px;right:12px;
                    background:none;border:none;font-size:22px;cursor:pointer;color:#999;">✕</button>
                
                <!-- Icon/Emoji Area -->
                <div class="w-16 h-16 mx-auto rounded-full bg-[#C9952A]/10 border-2 border-[#C9952A] flex items-center justify-center text-4xl mb-3 shadow-inner">
                    <span x-text="getAnimalEmoji(activeAnimal?.name)"></span>
                </div>
                
                <!-- Animal Name -->
                <div style="font-size:26px;color:#2e7d32;margin-bottom:6px;" x-text="activeAnimal?.name"></div>
                
                <!-- Tags -->
                <div style="font-size:13px;background:#fff9c4;border-radius:20px;
                    padding:4px 14px;display:inline-block;margin-bottom:10px;color:#5d4037;" 
                    class="font-nunito font-bold" x-text="activeAnimal?.tag"></div>
                
                <!-- Fact -->
                <div style="font-size:14px;color:#1b5e20;line-height:1.6;
                    margin-bottom:12px;" class="font-nunito font-bold" x-text="activeAnimal?.fact"></div>
                
                <!-- Learn More Link -->
                <a :href="'/animals/' + activeAnimal?.animalId" style="background:#2e7d32;color:#fff;border-radius:30px;
                    padding:8px 22px;text-decoration:none;font-size:14px;display:inline-block;" class="hover:bg-[#1b5e20] transition-colors">Learn More →</a>
            </div>
        </div>
    </div>

    <!-- Discovery Passport Section -->
    <div class="w-full max-w-5xl px-4">
        <div class="bg-[#111811]/90 border border-gold-500/20 rounded-3xl p-6 md:p-8 shadow-xl">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 border-b border-gold-500/10 pb-4">
                <div>
                    <h2 class="font-fredoka text-2xl md:text-3xl text-gold-500 flex items-center gap-2">
                        🎒 Your Safari Passport
                    </h2>
                    <p class="font-nunito text-zinc-400 text-sm mt-1">
                        Discover all animals to complete your adventure!
                    </p>
                </div>
                <!-- Progress Counter & Bar -->
                <div class="w-full md:w-64">
                    <div class="flex justify-between text-sm font-bold font-fredoka mb-1">
                        <span class="text-zinc-300">Discovered</span>
                        <span class="text-[#C9952A]" x-text="discoveryCount + ' / 16'"></span>
                    </div>
                    <div class="w-full h-3 bg-zinc-800 rounded-full overflow-hidden p-0.5 border border-zinc-700/50">
                        <div 
                            class="h-full bg-gradient-to-r from-amber-400 to-[#C9952A] rounded-full transition-all duration-500"
                            :style="'width: ' + ((discoveryCount / 16) * 100) + '%'"
                        ></div>
                    </div>
                </div>
            </div>

            <!-- Passport Badges Grid -->
            <div class="flex flex-wrap justify-center gap-3 mt-6">
                <template x-for="animal in allPassportAnimals" :key="animal.name">
                    <div 
                        :class="discovered.includes(animal.name) 
                            ? 'bg-gradient-to-br ' + animal.color + ' border-2 border-gold-500 scale-105 text-white shadow-xl' 
                            : 'bg-zinc-800/40 border border-zinc-700/20 text-zinc-600 grayscale opacity-45'"
                        class="relative flex flex-col items-center justify-center p-2 rounded-2xl transition-all duration-300 shadow-md border-2 border-transparent"
                        style="width: 90px; height: 100px; font-family: 'Fredoka One', cursive;"
                    >
                        <!-- Checkmark -->
                        <template x-if="discovered.includes(animal.name)">
                            <span class="absolute -top-1.5 -right-1.5 bg-emerald-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] leading-none font-bold shadow-md">
                                ✅
                            </span>
                        </template>
                        
                        <!-- Emoji -->
                        <span class="text-3xl filter drop-shadow-sm" x-text="animal.emoji"></span>
                        
                        <!-- Animal Name -->
                        <span class="text-[9px] font-bold text-center tracking-wide uppercase leading-tight mt-1" x-text="animal.name"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    // Set browser tab title
    document.title = "Safari | WildVerse";

    // Passport Animals Config
    const allPassportAnimals = [
        // Savanna
        { name: 'Lion', emoji: '🦁', color: 'from-amber-500 to-yellow-600', habitat: 'savanna' },
        { name: 'Giraffe', emoji: '🦒', color: 'from-orange-400 to-yellow-600', habitat: 'savanna' },
        { name: 'Elephant', emoji: '🐘', color: 'from-zinc-400 to-zinc-600', habitat: 'savanna' },
        { name: 'Zebra', emoji: '🦓', color: 'from-slate-700 to-slate-900', habitat: 'savanna' },
        // Amazon
        { name: 'Jaguar', emoji: '🐆', color: 'from-yellow-500 to-amber-700', habitat: 'amazon' },
        { name: 'Toucan', emoji: '🦜', color: 'from-green-500 to-emerald-700', habitat: 'amazon' },
        { name: 'Anaconda', emoji: '🐍', color: 'from-emerald-600 to-green-800', habitat: 'amazon' },
        { name: 'Poison Dart Frog', emoji: '🐸', color: 'from-cyan-500 to-blue-700', habitat: 'amazon' },
        // Arctic
        { name: 'Polar Bear', emoji: '🐻‍❄️', color: 'from-blue-100 to-slate-300', habitat: 'arctic' },
        { name: 'Arctic Fox', emoji: '🦊', color: 'from-sky-200 to-slate-400', habitat: 'arctic' },
        { name: 'Snowy Owl', emoji: '🦉', color: 'from-indigo-100 to-blue-300', habitat: 'arctic' },
        { name: 'Walrus', emoji: '🦭', color: 'from-amber-800 to-amber-950', habitat: 'arctic' },
        // Reef
        { name: 'Clownfish', emoji: '🐠', color: 'from-orange-500 to-red-600', habitat: 'reef' },
        { name: 'Sea Turtle', emoji: '🐢', color: 'from-green-600 to-emerald-800', habitat: 'reef' },
        { name: 'Octopus', emoji: '🐙', color: 'from-purple-500 to-pink-600', habitat: 'reef' },
        { name: 'Hammerhead Shark', emoji: '🦈', color: 'from-blue-600 to-slate-800', habitat: 'reef' }
    ];

    // AlpineJS Safari State Handler
    function safariApp() {
        return {
            currentHabitat: 'savanna',
            discovered: [],
            discoveryCount: 0,
            activeAnimal: null,
            popupVisible: false,
            dismissTimer: null,
            allPassportAnimals: allPassportAnimals,

            init() {
                window.safariAppInstance = this;
                // Load discovered state from localStorage to make it feel persistent
                if (localStorage.getItem('safari_discovered')) {
                    try {
                        this.discovered = JSON.parse(localStorage.getItem('safari_discovered'));
                        this.discoveryCount = this.discovered.length;
                    } catch(e) {}
                }
            },

            getAnimalEmoji(name) {
                const match = this.allPassportAnimals.find(a => a.name === name);
                return match ? match.emoji : '🐾';
            },

            showPopup(animal) {
                this.activeAnimal = animal;
                this.popupVisible = true;
                
                // Add to discovered if new
                if (!this.discovered.includes(animal.name)) {
                    this.discovered.push(animal.name);
                    this.discoveryCount = this.discovered.length;
                    localStorage.setItem('safari_discovered', JSON.stringify(this.discovered));
                }

                // Auto dismiss after 5 seconds
                if (this.dismissTimer) clearTimeout(this.dismissTimer);
                this.dismissTimer = setTimeout(() => {
                    this.popupVisible = false;
                }, 5000);
            },

            closePopup() {
                this.popupVisible = false;
                if (this.dismissTimer) clearTimeout(this.dismissTimer);
            }
        };
    }

    // ==========================================
    // CANVAS ENGINE
    // ==========================================
    const canvas = document.getElementById('safariCanvas');
    const ctx = canvas.getContext('2d');

    function resizeCanvas() {
        canvas.width = canvas.offsetWidth;
        canvas.height = window.innerWidth < 768 ? 300 : 480;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    let scrollX = 0;
    let t = 0;
    let currentHabitat = 'savanna';

    function getGroundY() { 
        return canvas.height * 0.72; 
    }
    
    function mod(n, m) { 
        return ((n % m) + m) % m; 
    }

    // Drawing Helper functions
    function drawCircle(ctx, x, y, r, fillColor, strokeColor = '#000', strokeWidth = 3) {
        ctx.beginPath();
        ctx.arc(x, y, r, 0, Math.PI * 2);
        ctx.fillStyle = fillColor;
        ctx.fill();
        if (strokeColor) {
            ctx.strokeStyle = strokeColor;
            ctx.lineWidth = strokeWidth;
            ctx.stroke();
        }
    }

    function drawEllipse(ctx, x, y, rx, ry, fillColor, strokeColor = '#000', strokeWidth = 3, rotation = 0) {
        ctx.beginPath();
        ctx.ellipse(x, y, rx, ry, rotation, 0, Math.PI * 2);
        ctx.fillStyle = fillColor;
        ctx.fill();
        if (strokeColor) {
            ctx.strokeStyle = strokeColor;
            ctx.lineWidth = strokeWidth;
            ctx.stroke();
        }
    }

    function drawRect(ctx, x, y, w, h, fillColor, strokeColor = '#000', strokeWidth = 3) {
        ctx.beginPath();
        ctx.rect(x, y, w, h);
        ctx.fillStyle = fillColor;
        ctx.fill();
        if (strokeColor) {
            ctx.strokeStyle = strokeColor;
            ctx.lineWidth = strokeWidth;
            ctx.stroke();
        }
    }

    function drawRoundedRect(ctx, x, y, w, h, r, fillColor, strokeColor = '#000', strokeWidth = 3) {
        ctx.beginPath();
        ctx.moveTo(x + r, y);
        ctx.lineTo(x + w - r, y);
        ctx.quadraticCurveTo(x + w, y, x + w, y + r);
        ctx.lineTo(x + w, y + h - r);
        ctx.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
        ctx.lineTo(x + r, y + h);
        ctx.quadraticCurveTo(x, y + h, x, y + h - r);
        ctx.lineTo(x, y + r);
        ctx.quadraticCurveTo(x, y, x + r, y);
        ctx.closePath();
        ctx.fillStyle = fillColor;
        ctx.fill();
        if (strokeColor) {
            ctx.strokeStyle = strokeColor;
            ctx.lineWidth = strokeWidth;
            ctx.stroke();
        }
    }

    // Habitat engine structures
    const habitats = {
        savanna: {
            title: '🌅 African Savanna',
            drawBackground(ctx, canvas, t) {
                let skyGrad = ctx.createLinearGradient(0, 0, 0, canvas.height);
                skyGrad.addColorStop(0, '#FF7043');
                skyGrad.addColorStop(0.3, '#FF9800');
                skyGrad.addColorStop(0.6, '#FFE082');
                skyGrad.addColorStop(1, '#87CEEB');
                ctx.fillStyle = skyGrad;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                let sunR = 42 + Math.sin(t * 2) * 4;
                ctx.beginPath();
                ctx.arc(canvas.width * 0.8, 80, sunR, 0, Math.PI * 2);
                ctx.fillStyle = '#FFF176';
                ctx.shadowColor = '#FFD54F';
                ctx.shadowBlur = 30;
                ctx.fill();
                ctx.shadowBlur = 0; // reset

                // Drifting clouds
                ctx.fillStyle = 'rgba(255, 255, 255, 0.45)';
                for (let i = 0; i < 3; i++) {
                    let cx = mod(200 + i * 400 - scrollX * 0.08, canvas.width + 200) - 100;
                    let cy = 50 + Math.sin(t + i) * 10;
                    ctx.beginPath();
                    ctx.arc(cx, cy, 18, 0, Math.PI * 2);
                    ctx.arc(cx + 15, cy - 8, 22, 0, Math.PI * 2);
                    ctx.arc(cx + 32, cy, 18, 0, Math.PI * 2);
                    ctx.fill();
                }

                // V-shaped birds flying slowly
                ctx.strokeStyle = '#5d4037';
                ctx.lineWidth = 2.5;
                for (let i = 0; i < 4; i++) {
                    let bx = mod(150 + i * 300 - scrollX * 0.25, canvas.width + 100) - 50;
                    let by = 60 + Math.sin(t * 2 + i) * 20 + i * 25;
                    ctx.beginPath();
                    ctx.moveTo(bx, by);
                    ctx.quadraticCurveTo(bx + 8, by - 6, bx + 16, by);
                    ctx.quadraticCurveTo(bx + 24, by - 6, bx + 32, by);
                    ctx.stroke();
                }
            },
            layers: [
                {
                    speed: 0.15,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#C8A96E';
                        ctx.beginPath();
                        ctx.moveTo(0, canvas.height);
                        const loopWidth = 1200;
                        let x = -mod(ox, loopWidth);
                        ctx.lineTo(x, canvas.height);
                        for (let i = 0; i <= loopWidth + 200; i += 50) {
                            let cx = x + i;
                            let cy = canvas.height * 0.65 + Math.sin(cx / 120) * 22;
                            ctx.lineTo(cx, cy);
                        }
                        ctx.lineTo(canvas.width + 200, canvas.height);
                        ctx.closePath();
                        ctx.fill();
                    }
                },
                {
                    speed: 0.35,
                    draw(ctx, canvas, ox) {
                        const loopWidth = 800;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 100) {
                            ctx.save();
                            ctx.translate(x + 200, getGroundY() - 5);
                            ctx.fillStyle = '#5c3a21';
                            ctx.beginPath();
                            ctx.moveTo(-6, 0);
                            ctx.lineTo(-3, -50);
                            ctx.lineTo(-18, -75);
                            ctx.lineTo(-16, -75);
                            ctx.lineTo(-2, -55);
                            ctx.lineTo(8, -70);
                            ctx.lineTo(10, -70);
                            ctx.lineTo(2, -50);
                            ctx.lineTo(6, 0);
                            ctx.closePath();
                            ctx.fill();

                            ctx.fillStyle = '#1B4332';
                            drawEllipse(ctx, -14, -76, 28, 10, '#1B4332', '#081C15', 2);
                            drawEllipse(ctx, 10, -72, 22, 9, '#1B4332', '#081C15', 2);
                            drawEllipse(ctx, -2, -62, 38, 11, '#2D6A4F', '#081C15', 2);
                            ctx.restore();
                            x += loopWidth;
                        }
                    }
                },
                {
                    speed: 0.6,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#D4A853';
                        ctx.beginPath();
                        ctx.rect(0, getGroundY(), canvas.width, canvas.height - getGroundY());
                        ctx.fill();

                        ctx.strokeStyle = '#A0784A';
                        ctx.lineWidth = 10;
                        ctx.beginPath();
                        ctx.moveTo(0, getGroundY() + 35);
                        ctx.lineTo(canvas.width, getGroundY() + 40);
                        ctx.moveTo(0, getGroundY() + 70);
                        ctx.lineTo(canvas.width, getGroundY() + 75);
                        ctx.stroke();

                        const loopWidth = 400;
                        let x = -mod(ox, loopWidth);
                        ctx.strokeStyle = '#8B6B14';
                        ctx.lineWidth = 2.5;
                        while (x < canvas.width + 100) {
                            ctx.beginPath();
                            ctx.moveTo(x + 50, getGroundY());
                            ctx.lineTo(x + 45, getGroundY() - 12);
                            ctx.moveTo(x + 50, getGroundY());
                            ctx.lineTo(x + 50, getGroundY() - 16);
                            ctx.moveTo(x + 50, getGroundY());
                            ctx.lineTo(x + 55, getGroundY() - 12);
                            ctx.stroke();
                            x += loopWidth;
                        }
                    }
                }
            ],
            animals: [
                {
                    name: 'Lion',
                    baseX: 350,
                    y: null,
                    animalId: 16, // tiger/wildcat fallback ID
                    fact: 'Lions are the only cats that live in groups called prides!',
                    tag: '🦁 Savanna | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 5) * 2);
                        ctx.strokeStyle = '#c8922a';
                        ctx.lineWidth = 4;
                        ctx.beginPath();
                        ctx.moveTo(40, -10);
                        ctx.quadraticCurveTo(60, -20, 55, -45);
                        ctx.stroke();
                        drawCircle(ctx, 55, -45, 6, '#5a3a00', '#000', 2);

                        drawRoundedRect(ctx, 22, -3, 10, 25, 4, '#d9a030', '#000', 2.5);
                        drawRoundedRect(ctx, -2, -3, 10, 25, 4, '#d9a030', '#000', 2.5);
                        drawRoundedRect(ctx, -20, -25, 65, 32, 12, '#c8922a', '#000', 2.5);
                        drawRoundedRect(ctx, -15, -3, 10, 25, 4, '#d9a030', '#000', 2.5);

                        drawCircle(ctx, -24, -32, 28, '#7a5200', '#000', 2.5);
                        drawCircle(ctx, -20, -40, 24, '#7a5200', '#000', 2.5);
                        drawCircle(ctx, -12, -44, 25, '#7a5200', '#000', 2.5);
                        drawCircle(ctx, -28, -20, 22, '#7a5200', '#000', 2.5);

                        drawCircle(ctx, -18, -30, 18, '#d9a030', '#000', 2.5);
                        drawCircle(ctx, -28, -44, 6, '#c8922a', '#000', 2);
                        drawCircle(ctx, -8, -44, 6, '#c8922a', '#000', 2);
                        drawCircle(ctx, -23, -33, 2.5, '#000', null);
                        drawCircle(ctx, -13, -33, 2.5, '#000', null);
                        drawCircle(ctx, -18, -26, 5, '#f5d68a', null);
                        
                        ctx.fillStyle = '#a06820';
                        ctx.beginPath();
                        ctx.moveTo(-20, -28);
                        ctx.lineTo(-16, -28);
                        ctx.lineTo(-18, -25);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    }
                },
                {
                    name: 'Giraffe',
                    baseX: 650,
                    y: null,
                    animalId: 19, // camel/antelope fallback ID
                    fact: 'Giraffes only need to drink water once every few days because they get moisture from leaves!',
                    tag: '🦒 Savanna | 🌿 Herbivore',
                    draw(ctx, t) {
                        ctx.save();
                        let legSwing = Math.sin(t * 6) * 8;
                        ctx.translate(0, Math.sin(t * 6) * 1.5);

                        ctx.strokeStyle = '#d9a030';
                        ctx.lineWidth = 3;
                        ctx.beginPath();
                        ctx.moveTo(35, 10);
                        ctx.lineTo(42, 28);
                        ctx.stroke();
                        drawCircle(ctx, 42, 28, 4, '#5a3a00', '#000', 1.5);

                        ctx.save();
                        ctx.translate(22, 25);
                        ctx.rotate(legSwing * Math.PI / 180);
                        drawRoundedRect(ctx, -4, 0, 8, 42, 3, '#d9a030', '#000', 2.5);
                        drawRect(ctx, -4, 38, 8, 4, '#5a3a00', '#000', 2);
                        ctx.restore();

                        ctx.save();
                        ctx.translate(10, 25);
                        ctx.rotate(-legSwing * Math.PI / 180);
                        drawRoundedRect(ctx, -4, 0, 8, 42, 3, '#c8922a', '#000', 2.5);
                        drawRect(ctx, -4, 38, 8, 4, '#5a3a00', '#000', 2);
                        ctx.restore();

                        ctx.save();
                        ctx.rotate(-15 * Math.PI / 180);
                        drawRoundedRect(ctx, -10, 5, 52, 28, 10, '#d9a030', '#000', 2.5);
                        ctx.restore();

                        ctx.fillStyle = '#8b5a2b';
                        drawCircle(ctx, 8, 12, 4, '#8b5a2b', null);
                        drawCircle(ctx, 18, 16, 5, '#8b5a2b', null);
                        drawCircle(ctx, 28, 14, 4.5, '#8b5a2b', null);
                        drawCircle(ctx, 12, 24, 3.5, '#8b5a2b', null);
                        drawCircle(ctx, 24, 26, 4, '#8b5a2b', null);

                        ctx.save();
                        ctx.translate(-5, 25);
                        ctx.rotate(-legSwing * Math.PI / 180);
                        drawRoundedRect(ctx, -4, 0, 8, 42, 3, '#d9a030', '#000', 2.5);
                        drawRect(ctx, -4, 38, 8, 4, '#5a3a00', '#000', 2);
                        ctx.restore();

                        ctx.save();
                        ctx.translate(-15, 25);
                        ctx.rotate(legSwing * Math.PI / 180);
                        drawRoundedRect(ctx, -4, 0, 8, 42, 3, '#c8922a', '#000', 2.5);
                        drawRect(ctx, -4, 38, 8, 4, '#5a3a00', '#000', 2);
                        ctx.restore();

                        ctx.save();
                        ctx.translate(-16, 8);
                        ctx.rotate(22 * Math.PI / 180);
                        drawRoundedRect(ctx, -6, -65, 12, 70, 4, '#d9a030', '#000', 2.5);
                        ctx.fillStyle = '#8b5a2b';
                        drawCircle(ctx, 0, -50, 2.5, '#8b5a2b', null);
                        drawCircle(ctx, -1, -38, 3, '#8b5a2b', null);
                        drawCircle(ctx, 1, -26, 3, '#8b5a2b', null);
                        drawCircle(ctx, -1, -12, 3.5, '#8b5a2b', null);
                        
                        drawEllipse(ctx, -2, -68, 14, 8, '#d9a030', '#000', 2.5, -15 * Math.PI / 180);
                        drawCircle(ctx, -10, -66, 6, '#f5d68a', '#000', 2);
                        drawEllipse(ctx, 6, -74, 8, 3, '#d9a030', '#000', 2, -45 * Math.PI / 180);
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 2.5;
                        ctx.beginPath();
                        ctx.moveTo(0, -74);
                        ctx.lineTo(2, -84);
                        ctx.stroke();
                        drawCircle(ctx, 2, -84, 3, '#5a3a00', '#000', 1.5);
                        ctx.restore();

                        ctx.restore();
                    }
                },
                {
                    name: 'Elephant',
                    baseX: 950,
                    y: null,
                    animalId: 11, // elephant ID
                    fact: 'Elephants communicate over long distances using low-frequency rumbles that travel through the ground!',
                    tag: '🐘 Savanna | 🌿 Herbivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 4) * 1.5);

                        ctx.strokeStyle = '#7f8c8d';
                        ctx.lineWidth = 3;
                        ctx.beginPath();
                        ctx.moveTo(42, -5);
                        ctx.lineTo(48, 25);
                        ctx.stroke();
                        drawCircle(ctx, 48, 25, 3, '#333', '#000', 1.5);

                        drawRoundedRect(ctx, 20, 10, 16, 25, 4, '#7f8c8d', '#000', 2.5);
                        drawRoundedRect(ctx, 5, 10, 16, 25, 4, '#95a5a6', '#000', 2.5);
                        drawRoundedRect(ctx, -20, 10, 16, 25, 4, '#7f8c8d', '#000', 2.5);
                        drawRoundedRect(ctx, -35, 10, 16, 25, 4, '#95a5a6', '#000', 2.5);

                        drawRoundedRect(ctx, -42, -35, 90, 52, 18, '#95a5a6', '#000', 2.5);
                        drawCircle(ctx, -40, -22, 22, '#95a5a6', '#000', 2.5);

                        drawEllipse(ctx, -24, -26, 15, 22, '#7f8c8d', '#000', 2.5, 5 * Math.PI / 180);
                        drawEllipse(ctx, -22, -26, 12, 18, '#e8a7a1', null, 0);

                        ctx.fillStyle = '#fff';
                        ctx.beginPath();
                        ctx.moveTo(-54, -14);
                        ctx.quadraticCurveTo(-68, -12, -70, -22);
                        ctx.quadraticCurveTo(-64, -20, -56, -18);
                        ctx.closePath();
                        ctx.fill();
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 2;
                        ctx.stroke();

                        ctx.strokeStyle = '#95a5a6';
                        ctx.lineWidth = 9;
                        ctx.lineCap = 'round';
                        ctx.beginPath();
                        ctx.moveTo(-50, -18);
                        let trunkCurl = Math.sin(t * 3) * 10;
                        ctx.quadraticCurveTo(-70, -20 + trunkCurl, -65, -35 + trunkCurl);
                        ctx.stroke();
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 12;
                        ctx.globalCompositeOperation = 'destination-over';
                        ctx.beginPath();
                        ctx.moveTo(-50, -18);
                        ctx.quadraticCurveTo(-70, -20 + trunkCurl, -65, -35 + trunkCurl);
                        ctx.stroke();
                        ctx.globalCompositeOperation = 'source-over';

                        drawCircle(ctx, -46, -26, 2.5, '#000', null);
                        ctx.restore();
                    }
                },
                {
                    name: 'Zebra',
                    baseX: 1250,
                    y: null,
                    animalId: 17, // antelope fallback ID
                    fact: 'A zebra\'s stripes act as natural sunscreen and keep them cool in the hot sun!',
                    tag: '🦓 Savanna | 🌿 Herbivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 5) * 1.5);

                        ctx.strokeStyle = '#eee';
                        ctx.lineWidth = 3;
                        ctx.beginPath();
                        ctx.moveTo(38, -5);
                        ctx.lineTo(44, 22);
                        ctx.stroke();
                        drawCircle(ctx, 44, 22, 3, '#000', '#000', 1.5);

                        drawRoundedRect(ctx, 18, 5, 8, 30, 3, '#fff', '#000', 2.5);
                        drawRoundedRect(ctx, 8, 5, 8, 30, 3, '#eee', '#000', 2.5);
                        drawRoundedRect(ctx, -14, 5, 8, 30, 3, '#fff', '#000', 2.5);
                        drawRoundedRect(ctx, -24, 5, 8, 30, 3, '#eee', '#000', 2.5);

                        drawRoundedRect(ctx, -30, -25, 70, 35, 12, '#fff', '#000', 2.5);

                        ctx.fillStyle = '#000';
                        ctx.fillRect(5, -24, 4, 25);
                        ctx.fillRect(15, -24, 4, 20);
                        ctx.fillRect(25, -24, 4, 18);
                        ctx.fillRect(-5, -24, 4, 28);
                        ctx.fillRect(-15, -24, 4, 25);

                        ctx.save();
                        ctx.translate(-24, -15);
                        ctx.rotate(35 * Math.PI / 180);
                        drawRoundedRect(ctx, -6, -42, 14, 45, 4, '#fff', '#000', 2.5);
                        ctx.fillStyle = '#000';
                        ctx.fillRect(8, -42, 4, 40);
                        drawEllipse(ctx, -2, -45, 15, 8, '#fff', '#000', 2.5, -20 * Math.PI / 180);
                        drawCircle(ctx, -12, -41, 6, '#000', null);
                        ctx.fillRect(-1, -35, 8, 3);
                        ctx.fillRect(-2, -25, 8, 3);
                        ctx.fillRect(-3, -15, 8, 3);
                        drawEllipse(ctx, 6, -52, 6, 3, '#fff', '#000', 2, -60 * Math.PI / 180);
                        ctx.restore();

                        ctx.restore();
                    }
                }
            ]
        },
        amazon: {
            title: '🌿 Amazon Jungle',
            drawBackground(ctx, canvas, t) {
                let skyGrad = ctx.createLinearGradient(0, 0, 0, canvas.height);
                skyGrad.addColorStop(0, '#081C15');
                skyGrad.addColorStop(0.5, '#1B4332');
                skyGrad.addColorStop(1, '#2D6A4F');
                ctx.fillStyle = skyGrad;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.fillStyle = 'rgba(216, 243, 220, 0.04)';
                for (let i = 0; i < 6; i++) {
                    let alpha = 0.03 + Math.sin(t + i * 2) * 0.02;
                    ctx.fillStyle = `rgba(216, 243, 220, ${alpha})`;
                    ctx.beginPath();
                    ctx.moveTo(100 + i * 150, 0);
                    ctx.lineTo(250 + i * 150, 0);
                    ctx.lineTo(50 + i * 150, canvas.height);
                    ctx.lineTo(-50 + i * 150, canvas.height);
                    ctx.closePath();
                    ctx.fill();
                }

                // Waterfall on the far right
                ctx.fillStyle = 'rgba(142, 202, 230, 0.8)';
                let wfX = canvas.width - 90;
                ctx.fillRect(wfX, 0, 45, getGroundY() + 30);
                
                // Animated water lines
                ctx.strokeStyle = '#fff';
                ctx.lineWidth = 3;
                for (let i = 0; i < 3; i++) {
                    let lineY = ((t * 220 + i * 100) % (getGroundY() + 30));
                    ctx.beginPath();
                    ctx.moveTo(wfX + 8 + i * 15, lineY);
                    ctx.lineTo(wfX + 8 + i * 15, lineY + 40);
                    ctx.stroke();
                }
                // Mist pool at bottom
                ctx.fillStyle = 'rgba(224, 251, 252, 0.6)';
                drawCircle(ctx, wfX + 22, getGroundY() + 25, 28, 'rgba(224, 251, 252, 0.55)', null, 0);
            },
            layers: [
                {
                    speed: 0.15,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#081C15';
                        const loopWidth = 600;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 200) {
                            ctx.beginPath();
                            ctx.arc(x + 100, 20, 80, 0, Math.PI * 2);
                            ctx.arc(x + 220, 30, 95, 0, Math.PI * 2);
                            ctx.arc(x + 340, 10, 85, 0, Math.PI * 2);
                            ctx.arc(x + 480, 25, 90, 0, Math.PI * 2);
                            ctx.fill();
                            x += loopWidth;
                        }
                    }
                },
                {
                    speed: 0.35,
                    draw(ctx, canvas, ox) {
                        const loopWidth = 400;
                        let x = -mod(ox, loopWidth);
                        ctx.strokeStyle = '#1B4332';
                        ctx.lineWidth = 3.5;
                        while (x < canvas.width + 100) {
                            let sway = Math.sin(t + x) * 15;
                            ctx.beginPath();
                            ctx.moveTo(x + 150, 0);
                            ctx.quadraticCurveTo(x + 150 + sway, canvas.height * 0.3, x + 150 + sway, canvas.height * 0.55);
                            ctx.stroke();

                            ctx.fillStyle = '#2D6A4F';
                            drawCircle(ctx, x + 150 + sway * 0.5, canvas.height * 0.25, 5, '#2D6A4F', null);
                            drawCircle(ctx, x + 150 + sway * 0.8, canvas.height * 0.45, 6, '#2D6A4F', null);
                            x += loopWidth;
                        }
                    }
                },
                {
                    speed: 0.6,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#3E2723';
                        ctx.beginPath();
                        ctx.rect(0, getGroundY(), canvas.width, canvas.height - getGroundY());
                        ctx.fill();

                        ctx.fillStyle = '#1A3D24';
                        ctx.beginPath();
                        ctx.ellipse(200, getGroundY() + 10, 220, 18, 0, 0, Math.PI * 2);
                        ctx.ellipse(600, getGroundY() + 15, 300, 22, 0, 0, Math.PI * 2);
                        ctx.ellipse(1000, getGroundY() + 10, 240, 18, 0, 0, Math.PI * 2);
                        ctx.fill();

                        // Tropical Flowers
                        ctx.fillStyle = '#e63946';
                        drawCircle(ctx, 180, getGroundY() + 15, 6, '#e63946', '#000', 1.5);
                        drawCircle(ctx, 186, getGroundY() + 10, 5, '#f1c40f', null, 0);
                        drawCircle(ctx, 800, getGroundY() + 20, 7, '#e63946', '#000', 1.5);
                        drawCircle(ctx, 808, getGroundY() + 16, 5, '#f1c40f', null, 0);

                        const loopWidth = 900;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 100) {
                            ctx.save();
                            ctx.translate(x + 150, getGroundY() + 18);
                            drawRoundedRect(ctx, 0, 0, 90, 20, 6, '#5c3a21', '#000', 2);
                            drawEllipse(ctx, 90, 10, 3, 10, '#8b5a2b', '#000', 1.5);
                            ctx.restore();
                            x += loopWidth;
                        }

                        // Blinking fireflies
                        ctx.fillStyle = '#d8f3dc';
                        for (let i = 0; i < 8; i++) {
                            let fx = mod(150 + i * 200 - ox * 0.8, canvas.width + 200) - 100;
                            let fy = getGroundY() - 80 + Math.sin(t + i) * 30;
                            let opacity = 0.3 + Math.sin(t * 4 + i) * 0.7;
                            if (opacity > 0.1) {
                                ctx.shadowColor = '#95d5b2';
                                ctx.shadowBlur = 10;
                                ctx.fillStyle = `rgba(183, 228, 199, ${opacity})`;
                                drawCircle(ctx, fx, fy, 3.5, ctx.fillStyle, null, 0);
                                ctx.shadowBlur = 0;
                            }
                        }
                    }
                }
            ],
            animals: [
                {
                    name: 'Jaguar',
                    baseX: 300,
                    y: null,
                    animalId: 2, // jaguar ID
                    fact: 'Jaguars love the water and are incredible swimmers, unlike most other domestic and wild cats!',
                    tag: '🐆 Amazon | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 6) * 1);

                        ctx.strokeStyle = '#d49b13';
                        ctx.lineWidth = 4;
                        ctx.beginPath();
                        ctx.moveTo(35, -5);
                        ctx.quadraticCurveTo(55, -2, 50, 18);
                        ctx.stroke();

                        drawRoundedRect(ctx, 18, 5, 8, 20, 3, '#d49b13', '#000', 2.5);
                        drawRoundedRect(ctx, 8, 5, 8, 20, 3, '#b58209', '#000', 2.5);
                        drawRoundedRect(ctx, -14, 5, 8, 20, 3, '#d49b13', '#000', 2.5);
                        drawRoundedRect(ctx, -24, 5, 8, 20, 3, '#b58209', '#000', 2.5);

                        drawRoundedRect(ctx, -30, -20, 68, 28, 10, '#d49b13', '#000', 2.5);

                        ctx.fillStyle = '#000';
                        drawCircle(ctx, -18, -12, 3, '#000', null);
                        drawCircle(ctx, -10, -8, 2.5, '#000', null);
                        drawCircle(ctx, -2, -14, 3, '#000', null);
                        drawCircle(ctx, 8, -10, 2.5, '#000', null);
                        drawCircle(ctx, 18, -13, 3, '#000', null);
                        drawCircle(ctx, 24, -6, 2, '#000', null);

                        drawCircle(ctx, -32, -26, 14, '#d49b13', '#000', 2.5);
                        drawCircle(ctx, -40, -36, 4, '#d49b13', '#000', 2);
                        drawCircle(ctx, -26, -36, 4, '#d49b13', '#000', 2);
                        drawCircle(ctx, -32, -20, 5, '#fcebb6', '#000', 1.5);

                        ctx.fillStyle = '#0dff00';
                        drawCircle(ctx, -36, -28, 2.5, '#0dff00', null);
                        drawCircle(ctx, -28, -28, 2.5, '#0dff00', null);
                        ctx.restore();
                    }
                },
                {
                    name: 'Toucan',
                    baseX: 600,
                    y: 0.45, // relative to height
                    animalId: 26, // toucan ID
                    fact: 'A toucan\'s bill is actually very light because it is made of keratin with hollow pockets!',
                    tag: '🦜 Amazon | 🍌 Frugivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 4) * 2);

                        ctx.strokeStyle = '#5c3a21';
                        ctx.lineWidth = 6;
                        ctx.beginPath();
                        ctx.moveTo(-40, 25);
                        ctx.lineTo(40, 25);
                        ctx.stroke();

                        ctx.fillStyle = '#000';
                        ctx.fillRect(8, 12, 6, 20);

                        drawEllipse(ctx, 0, 0, 18, 22, '#000', '#000', 2.5);
                        ctx.fillStyle = '#fff';
                        ctx.beginPath();
                        ctx.ellipse(-8, -2, 10, 14, 0, 0, Math.PI * 2);
                        ctx.fill();

                        drawCircle(ctx, -10, -22, 11, '#000', '#000', 2.5);
                        drawCircle(ctx, -13, -24, 3.5, '#3498db', null);
                        drawCircle(ctx, -13, -24, 1.5, '#000', null);

                        ctx.save();
                        ctx.translate(-16, -26);
                        let beakGrad = ctx.createLinearGradient(-35, 0, 0, 0);
                        beakGrad.addColorStop(0, '#e74c3c');
                        beakGrad.addColorStop(0.4, '#e67e22');
                        beakGrad.addColorStop(1, '#f1c40f');
                        
                        ctx.beginPath();
                        ctx.moveTo(0, 0);
                        ctx.quadraticCurveTo(-15, -15, -35, -5);
                        ctx.quadraticCurveTo(-20, 10, 0, 8);
                        ctx.closePath();
                        ctx.fillStyle = beakGrad;
                        ctx.fill();
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 2;
                        ctx.stroke();
                        ctx.restore();

                        ctx.fillStyle = '#3498db';
                        ctx.fillRect(-6, 20, 4, 6);
                        ctx.fillRect(2, 20, 4, 6);
                        ctx.restore();
                    }
                },
                {
                    name: 'Anaconda',
                    baseX: 850,
                    y: 0.62, // relative to height
                    animalId: 5, // spider monkey fallback ID
                    fact: 'Anacondas are members of the boa constrictor family and can live in water for long periods!',
                    tag: '🐍 Amazon | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 3) * 3);

                        ctx.strokeStyle = '#4e2d14';
                        ctx.lineWidth = 8;
                        ctx.beginPath();
                        ctx.moveTo(-50, 40);
                        ctx.lineTo(50, 40);
                        ctx.stroke();

                        ctx.strokeStyle = '#1e3f20';
                        ctx.lineWidth = 14;
                        ctx.lineCap = 'round';
                        ctx.beginPath();
                        ctx.moveTo(-35, 40);
                        ctx.bezierCurveTo(-20, 15, -10, 15, 0, 40);
                        ctx.bezierCurveTo(10, 60, 20, 60, 35, 40);
                        ctx.stroke();

                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 18;
                        ctx.globalCompositeOperation = 'destination-over';
                        ctx.beginPath();
                        ctx.moveTo(-35, 40);
                        ctx.bezierCurveTo(-20, 15, -10, 15, 0, 40);
                        ctx.bezierCurveTo(10, 60, 20, 60, 35, 40);
                        ctx.stroke();
                        ctx.globalCompositeOperation = 'source-over';

                        ctx.fillStyle = '#0a0f0a';
                        drawCircle(ctx, -22, 28, 4, '#0a0f0a', null);
                        drawCircle(ctx, 0, 34, 4, '#0a0f0a', null);
                        drawCircle(ctx, 22, 48, 4, '#0a0f0a', null);

                        ctx.save();
                        ctx.translate(-38, 30);
                        drawEllipse(ctx, 0, 0, 12, 8, '#2a592e', '#000', 2, -10 * Math.PI / 180);
                        drawCircle(ctx, -2, -2, 2, '#f1c40f', null);
                        ctx.strokeStyle = '#e74c3c';
                        ctx.lineWidth = 2;
                        ctx.beginPath();
                        ctx.moveTo(-10, 2);
                        let tongueOut = Math.abs(Math.sin(t * 8)) * 8;
                        ctx.lineTo(-10 - tongueOut, 2 + Math.sin(t * 15) * 2);
                        ctx.stroke();
                        ctx.restore();
                        ctx.restore();
                    }
                },
                {
                    name: 'Poison Dart Frog',
                    baseX: 1100,
                    y: null,
                    animalId: 4, // sloth fallback ID
                    fact: 'Their bright colors warn predators that they are highly toxic and should not be eaten!',
                    tag: '🐸 Amazon | 🐜 Insectivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.fillStyle = '#2d6a4f';
                        ctx.beginPath();
                        ctx.ellipse(0, 15, 45, 12, 0, 0, Math.PI * 2);
                        ctx.fill();
                        ctx.strokeStyle = '#1b4332';
                        ctx.lineWidth = 2;
                        ctx.stroke();

                        ctx.translate(0, Math.sin(t * 8) * 1.5);

                        drawCircle(ctx, -15, 5, 8, '#00b4d8', '#000', 2);
                        drawCircle(ctx, 15, 5, 8, '#00b4d8', '#000', 2);

                        drawRoundedRect(ctx, -15, -15, 30, 22, 8, '#0077b6', '#000', 2.5);

                        ctx.fillStyle = '#e63946';
                        ctx.beginPath();
                        ctx.arc(0, -6, 5, 0, Math.PI * 2);
                        ctx.arc(-8, -12, 4, 0, Math.PI * 2);
                        ctx.arc(8, -12, 4, 0, Math.PI * 2);
                        ctx.fill();

                        drawCircle(ctx, -10, -16, 7, '#fff', '#000', 2);
                        drawCircle(ctx, -10, -16, 3.5, '#000', null);
                        drawCircle(ctx, 10, -16, 7, '#fff', '#000', 2);
                        drawCircle(ctx, 10, -16, 3.5, '#000', null);

                        ctx.strokeStyle = '#00b4d8';
                        ctx.lineWidth = 4;
                        ctx.beginPath();
                        ctx.moveTo(-10, 5);
                        ctx.lineTo(-14, 15);
                        ctx.moveTo(10, 5);
                        ctx.lineTo(14, 15);
                        ctx.stroke();
                        ctx.restore();
                    }
                }
            ]
        },
        arctic: {
            title: '❄️ Arctic Tundra',
            drawBackground(ctx, canvas, t) {
                let skyGrad = ctx.createLinearGradient(0, 0, 0, canvas.height);
                skyGrad.addColorStop(0, '#B3D9FF');
                skyGrad.addColorStop(1, '#E8F4FD');
                ctx.fillStyle = skyGrad;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.save();
                for (let i = 0; i < 3; i++) {
                    let opacity = 0.08 + Math.sin(t * 2 + i * 2) * 0.06;
                    let aurGrad = ctx.createLinearGradient(0, 0, canvas.width, 0);
                    aurGrad.addColorStop(0, 'transparent');
                    aurGrad.addColorStop(0.3 + i * 0.1, `rgba(46, 204, 113, ${opacity})`);
                    aurGrad.addColorStop(0.5 + i * 0.1, `rgba(52, 152, 219, ${opacity})`);
                    aurGrad.addColorStop(0.7 + i * 0.1, 'transparent');
                    ctx.fillStyle = aurGrad;
                    ctx.beginPath();
                    ctx.ellipse(canvas.width / 2, 60 + i * 20, canvas.width * 0.6, 40, Math.sin(t + i) * 0.05, 0, Math.PI * 2);
                    ctx.fill();
                }
                ctx.restore();

                // Snow particles drifting down
                ctx.fillStyle = '#ffffff';
                if (!this.snowflakes) {
                    this.snowflakes = [];
                    for (let i = 0; i < 30; i++) {
                        this.snowflakes.push({
                            x: Math.random() * 1200,
                            y: Math.random() * 480,
                            r: 2 + Math.random() * 3,
                            speed: 0.5 + Math.random() * 1
                        });
                    }
                }
                this.snowflakes.forEach(s => {
                    s.y += s.speed;
                    s.x += Math.sin(t + s.y / 30) * 0.3;
                    if (s.y > canvas.height) {
                        s.y = -10;
                        s.x = Math.random() * canvas.width;
                    }
                    drawCircle(ctx, s.x, s.y, s.r, '#fff', null, 0);
                });
            },
            layers: [
                {
                    speed: 0.15,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#c5e3f7';
                        const loopWidth = 1000;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 200) {
                            ctx.beginPath();
                            ctx.moveTo(x, getGroundY());
                            ctx.lineTo(x + 120, getGroundY() - 80);
                            ctx.lineTo(x + 200, getGroundY() - 110);
                            ctx.lineTo(x + 280, getGroundY() - 70);
                            ctx.lineTo(x + 360, getGroundY() - 95);
                            ctx.lineTo(x + 480, getGroundY());
                            ctx.closePath();
                            ctx.fill();
                            x += loopWidth;
                        }
                    }
                },
                {
                    speed: 0.35,
                    draw(ctx, canvas, ox) {
                        const loopWidth = 700;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 100) {
                            ctx.save();
                            ctx.translate(x + 250, getGroundY());
                            ctx.fillStyle = '#3E2723';
                            ctx.fillRect(-6, -20, 12, 20);

                            ctx.fillStyle = '#1A3D24';
                            ctx.beginPath();
                            ctx.moveTo(0, -90);
                            ctx.lineTo(-30, -50);
                            ctx.lineTo(-20, -50);
                            ctx.lineTo(-40, -15);
                            ctx.lineTo(40, -15);
                            ctx.lineTo(20, -50);
                            ctx.lineTo(30, -50);
                            ctx.closePath();
                            ctx.fill();

                            ctx.fillStyle = '#fff';
                            ctx.beginPath();
                            ctx.moveTo(0, -90);
                            ctx.lineTo(-10, -75);
                            ctx.lineTo(10, -75);
                            ctx.closePath();
                            ctx.fill();
                            ctx.beginPath();
                            ctx.moveTo(-20, -50);
                            ctx.lineTo(-25, -45);
                            ctx.lineTo(25, -45);
                            ctx.lineTo(20, -50);
                            ctx.closePath();
                            ctx.fill();

                            ctx.restore();
                            x += loopWidth;
                        }
                    }
                },
                {
                    speed: 0.6,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#ffffff';
                        ctx.beginPath();
                        ctx.rect(0, getGroundY(), canvas.width, canvas.height - getGroundY());
                        ctx.fill();

                        ctx.fillStyle = '#e1f0fa';
                        ctx.beginPath();
                        ctx.ellipse(300, getGroundY() + 15, 350, 15, 0, 0, Math.PI * 2);
                        ctx.ellipse(800, getGroundY() + 20, 400, 20, 0, 0, Math.PI * 2);
                        ctx.fill();

                        const loopWidth = 900;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 100) {
                            ctx.save();
                            ctx.translate(x + 100, getGroundY() + 30);
                            ctx.fillStyle = '#e8f4fd';
                            ctx.beginPath();
                            ctx.moveTo(0, 5);
                            ctx.lineTo(80, 0);
                            ctx.lineTo(110, 25);
                            ctx.lineTo(-10, 20);
                            ctx.closePath();
                            ctx.fill();
                            ctx.strokeStyle = '#c5e3f7';
                            ctx.lineWidth = 2.5;
                            ctx.stroke();
                            ctx.restore();
                            x += loopWidth;
                        }
                    }
                }
            ],
            animals: [
                {
                    name: 'Polar Bear',
                    baseX: 320,
                    y: null,
                    animalId: 8, // polar bear ID
                    fact: 'Polar bears have black skin under their white fur to absorb heat from the sun!',
                    tag: '🐻‍❄️ Arctic | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 4) * 1.5);

                        drawRoundedRect(ctx, 16, 5, 14, 18, 4, '#f0ede8', '#000', 2.5);
                        drawRoundedRect(ctx, 2, 5, 14, 18, 4, '#e3ded7', '#000', 2.5);
                        drawRoundedRect(ctx, -18, 5, 14, 18, 4, '#f0ede8', '#000', 2.5);
                        drawRoundedRect(ctx, -32, 5, 14, 18, 4, '#e3ded7', '#000', 2.5);

                        drawRoundedRect(ctx, -35, -28, 68, 38, 14, '#f7f4ee', '#000', 2.5);
                        drawCircle(ctx, -34, -20, 15, '#f7f4ee', '#000', 2.5);
                        drawCircle(ctx, -42, -32, 4.5, '#f7f4ee', '#000', 2);
                        drawCircle(ctx, -28, -32, 4.5, '#f7f4ee', '#000', 2);
                        drawEllipse(ctx, -44, -16, 6, 4, '#e8e2db', '#000', 1.5);
                        drawCircle(ctx, -46, -17, 2, '#000', null);
                        drawCircle(ctx, -36, -23, 2, '#000', null);
                        ctx.restore();
                    }
                },
                {
                    name: 'Arctic Fox',
                    baseX: 580,
                    y: null,
                    animalId: 6, // fox ID
                    fact: 'Their tails (called sweeps) are so fluffy they can wrap them around their faces like blankets!',
                    tag: '🦊 Arctic | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 6) * 2);

                        ctx.save();
                        ctx.translate(22, -3);
                        ctx.rotate(Math.sin(t * 5) * 0.15);
                        drawEllipse(ctx, 12, 5, 14, 8, '#f4f0ec', '#000', 2.5, 15 * Math.PI / 180);
                        drawCircle(ctx, 22, 6, 4, '#fff', null);
                        ctx.restore();

                        drawRoundedRect(ctx, 12, 6, 6, 18, 2, '#f4f0ec', '#000', 2);
                        drawRoundedRect(ctx, 4, 6, 6, 18, 2, '#e2ddd6', '#000', 2);
                        drawRoundedRect(ctx, -8, 6, 6, 18, 2, '#f4f0ec', '#000', 2);
                        drawRoundedRect(ctx, -14, 6, 6, 18, 2, '#e2ddd6', '#000', 2);

                        drawRoundedRect(ctx, -20, -12, 44, 22, 8, '#f4f0ec', '#000', 2.5);
                        drawCircle(ctx, -18, -18, 11, '#f4f0ec', '#000', 2.5);
                        drawEllipse(ctx, -24, -14, 5, 3.5, '#fff', '#000', 1.5);
                        drawCircle(ctx, -26, -14, 1.5, '#000', null);
                        drawEllipse(ctx, -24, -26, 6, 3, '#f4f0ec', '#000', 2, -60 * Math.PI / 180);
                        drawEllipse(ctx, -14, -26, 6, 3, '#f4f0ec', '#000', 2, -40 * Math.PI / 180);
                        drawCircle(ctx, -20, -20, 1.5, '#000', null);
                        ctx.restore();
                    }
                },
                {
                    name: 'Snowy Owl',
                    baseX: 840,
                    y: 0.45,
                    animalId: 24, // owl ID
                    fact: 'Snowy owls hunt during the daytime because Arctic summer days have 24 hours of sunlight!',
                    tag: '🦉 Arctic | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 3) * 2.5);

                        ctx.fillStyle = '#b5d0ea';
                        ctx.beginPath();
                        ctx.moveTo(-15, 20);
                        ctx.lineTo(15, 20);
                        ctx.lineTo(25, 100);
                        ctx.lineTo(-25, 100);
                        ctx.closePath();
                        ctx.fill();
                        ctx.strokeStyle = '#8bb2d6';
                        ctx.stroke();

                        drawEllipse(ctx, 0, -10, 18, 24, '#fff', '#000', 2.5);
                        ctx.strokeStyle = '#7f8c8d';
                        ctx.lineWidth = 1.5;
                        ctx.beginPath();
                        ctx.moveTo(-8, -12); ctx.lineTo(-6, -10); ctx.lineTo(-4, -12);
                        ctx.moveTo(4, -12); ctx.lineTo(6, -10); ctx.lineTo(8, -12);
                        ctx.moveTo(-4, -2); ctx.lineTo(-2, 0); ctx.lineTo(0, -2);
                        ctx.stroke();

                        drawEllipse(ctx, -14, -8, 5, 16, '#fff', '#000', 2, 8 * Math.PI / 180);
                        drawEllipse(ctx, 14, -8, 5, 16, '#fff', '#000', 2, -8 * Math.PI / 180);

                        drawCircle(ctx, 0, -32, 13, '#fff', '#000', 2.5);
                        drawCircle(ctx, -5, -32, 5, '#f5f7fa', null);
                        drawCircle(ctx, 5, -32, 5, '#f5f7fa', null);

                        drawCircle(ctx, -5, -33, 3.5, '#f1c40f', '#000', 1.5);
                        drawCircle(ctx, -5, -33, 1.5, '#000', null);
                        drawCircle(ctx, 5, -33, 3.5, '#f1c40f', '#000', 1.5);
                        drawCircle(ctx, 5, -33, 1.5, '#000', null);

                        ctx.fillStyle = '#e67e22';
                        ctx.beginPath();
                        ctx.moveTo(-2, -29);
                        ctx.lineTo(2, -29);
                        ctx.lineTo(0, -25);
                        ctx.closePath();
                        ctx.fill();

                        ctx.fillStyle = '#000';
                        ctx.fillRect(-6, 12, 4, 6);
                        ctx.fillRect(2, 12, 4, 6);
                        ctx.restore();
                    }
                },
                {
                    name: 'Walrus',
                    baseX: 1100,
                    y: null,
                    animalId: 10, // walrus ID
                    fact: 'Walruses can change color! They turn pink when warm because blood vessels widen in the skin.',
                    tag: '🦭 Arctic | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.fillStyle = '#e8f4fd';
                        ctx.beginPath();
                        ctx.ellipse(0, 16, 50, 12, 0, 0, Math.PI * 2);
                        ctx.fill();
                        ctx.strokeStyle = '#c5e3f7';
                        ctx.lineWidth = 2;
                        ctx.stroke();

                        ctx.translate(0, Math.sin(t * 3.5) * 1);

                        drawEllipse(ctx, 28, 5, 14, 8, '#704f37', '#000', 2.5);
                        drawEllipse(ctx, -5, -5, 34, 20, '#866147', '#000', 2.5);
                        drawEllipse(ctx, -14, 8, 12, 6, '#704f37', '#000', 2.5, 20 * Math.PI / 180);
                        drawCircle(ctx, -24, -14, 15, '#866147', '#000', 2.5);
                        drawCircle(ctx, -30, -10, 7, '#bda391', '#000', 2);
                        drawCircle(ctx, -23, -9, 6, '#bda391', '#000', 2);

                        ctx.fillStyle = '#fff';
                        ctx.beginPath();
                        ctx.rect(-32, -6, 4, 18);
                        ctx.rect(-24, -5, 4, 16);
                        ctx.fill();
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 1.5;
                        ctx.strokeRect(-32, -6, 4, 18);
                        ctx.strokeRect(-24, -5, 4, 16);

                        drawCircle(ctx, -25, -20, 2, '#000', null);
                        ctx.restore();
                    }
                }
            ]
        },
        reef: {
            title: '🐠 Coral Reef',
            drawBackground(ctx, canvas, t) {
                let skyGrad = ctx.createLinearGradient(0, 0, 0, canvas.height);
                skyGrad.addColorStop(0, '#005f73');
                skyGrad.addColorStop(0.5, '#0a9396');
                skyGrad.addColorStop(1, '#001219');
                ctx.fillStyle = skyGrad;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.strokeStyle = 'rgba(148, 210, 189, 0.08)';
                ctx.lineWidth = 8;
                for (let i = 0; i < 8; i++) {
                    ctx.beginPath();
                    let bx = 50 + i * 150 + Math.sin(t * 1.5 + i) * 20;
                    ctx.moveTo(bx, 0);
                    ctx.bezierCurveTo(bx + 40, canvas.height * 0.3, bx - 40, canvas.height * 0.7, bx + 10, canvas.height);
                    ctx.stroke();
                }

                // Swaying kelp
                ctx.fillStyle = '#0f4c5c';
                for (let i = 0; i < 5; i++) {
                    let sx = 100 + i * 220 + Math.sin(t + i) * 15;
                    ctx.beginPath();
                    ctx.moveTo(sx, canvas.height);
                    ctx.quadraticCurveTo(sx + 30, canvas.height * 0.6, sx - 20, canvas.height * 0.3);
                    ctx.quadraticCurveTo(sx - 30, canvas.height * 0.1, sx, 0);
                    ctx.lineTo(sx + 30, 0);
                    ctx.lineTo(sx + 40, canvas.height);
                    ctx.closePath();
                    ctx.fill();
                }

                // Bubbles rising
                ctx.fillStyle = 'rgba(255,255,255,0.25)';
                if (!this.bubbles) {
                    this.bubbles = [];
                    for (let i = 0; i < 20; i++) {
                        this.bubbles.push({
                            x: Math.random() * 1200,
                            y: canvas.height + Math.random() * 100,
                            r: 2.5 + Math.random() * 4,
                            speed: 0.8 + Math.random() * 1.2
                        });
                    }
                }
                this.bubbles.forEach(b => {
                    b.y -= b.speed;
                    b.x += Math.sin(t + b.y / 20) * 0.4;
                    if (b.y < -10) {
                        b.y = canvas.height + 10;
                        b.x = Math.random() * canvas.width;
                    }
                    drawCircle(ctx, b.x, b.y, b.r, 'rgba(255, 255, 255, 0.15)', 'rgba(255,255,255,0.3)', 1);
                });
            },
            layers: [
                {
                    speed: 0.15,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#0a9396';
                        let schoolX = -mod(ox * 0.5, 1600);
                        for (let i = 0; i < 12; i++) {
                            let fx = schoolX + 300 + (i % 4) * 35;
                            let fy = 120 + Math.sin(t * 3 + i) * 10 + (i / 4) * 25;
                            drawEllipse(ctx, fx, fy, 8, 4, '#94d2bd', null, 0);
                            ctx.beginPath();
                            ctx.moveTo(fx + 8, fy);
                            ctx.lineTo(fx + 14, fy - 4);
                            ctx.lineTo(fx + 14, fy + 4);
                            ctx.closePath();
                            ctx.fill();
                        }
                    }
                },
                {
                    speed: 0.35,
                    draw(ctx, canvas, ox) {
                        const loopWidth = 800;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 100) {
                            ctx.save();
                            ctx.translate(x + 200, getGroundY() + 40);

                            ctx.fillStyle = '#ee9b00';
                            ctx.beginPath();
                            ctx.arc(-20, -30, 22, 0, Math.PI * 2);
                            ctx.arc(10, -50, 25, 0, Math.PI * 2);
                            ctx.arc(35, -25, 20, 0, Math.PI * 2);
                            ctx.fill();

                            ctx.fillStyle = '#ca6702';
                            ctx.fillRect(-60, -40, 14, 50);
                            ctx.fillRect(-45, -55, 12, 60);
                            drawCircle(ctx, -53, -40, 7, '#ae2012', null, 0);
                            drawCircle(ctx, -39, -55, 6, '#ae2012', null, 0);

                            ctx.restore();
                            x += loopWidth;
                        }
                    }
                },
                {
                    speed: 0.6,
                    draw(ctx, canvas, ox) {
                        ctx.fillStyle = '#e9d8a6';
                        ctx.beginPath();
                        ctx.rect(0, getGroundY(), canvas.width, canvas.height - getGroundY());
                        ctx.fill();

                        ctx.strokeStyle = '#ee9b00';
                        ctx.lineWidth = 2.5;
                        const loopWidth = 400;
                        let x = -mod(ox, loopWidth);
                        while (x < canvas.width + 100) {
                            ctx.beginPath();
                            ctx.moveTo(x + 50, getGroundY() + 15);
                            ctx.quadraticCurveTo(x + 100, getGroundY() + 20, x + 150, getGroundY() + 15);
                            ctx.moveTo(x + 120, getGroundY() + 40);
                            ctx.quadraticCurveTo(x + 180, getGroundY() + 45, x + 240, getGroundY() + 40);
                            ctx.stroke();
                            x += loopWidth;
                        }
                    }
                }
            ],
            animals: [
                {
                    name: 'Clownfish',
                    baseX: 340,
                    y: 0.58,
                    animalId: 27, // dolphin fallback ID
                    fact: 'Clownfish live in anemones because they have a special mucus coating that protects them from stings!',
                    tag: '🐠 Reef | 🌾 Planktivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 8) * 8);

                        drawEllipse(ctx, -4, 2, 6, 8, '#e67e22', '#000', 2, Math.sin(t * 10) * 0.3);
                        drawEllipse(ctx, 0, 0, 24, 15, '#e67e22', '#000', 2.5);

                        ctx.fillStyle = '#fff';
                        ctx.fillRect(-10, -11, 6, 22);
                        ctx.fillRect(8, -8, 5, 16);
                        
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 1.5;
                        ctx.strokeRect(-10, -11, 6, 22);
                        ctx.strokeRect(8, -8, 5, 16);

                        ctx.fillStyle = '#e67e22';
                        ctx.beginPath();
                        ctx.moveTo(22, 0);
                        ctx.lineTo(34, -12);
                        ctx.lineTo(32, 0);
                        ctx.lineTo(34, 12);
                        ctx.closePath();
                        ctx.fill();
                        ctx.stroke();

                        ctx.fillStyle = '#000';
                        drawCircle(ctx, 33, -8, 2, '#000', null);
                        drawCircle(ctx, 33, 8, 2, '#000', null);

                        drawCircle(ctx, -14, -4, 3.5, '#fff', '#000', 1);
                        drawCircle(ctx, -15, -4, 1.5, '#000', null);
                        ctx.restore();
                    }
                },
                {
                    name: 'Sea Turtle',
                    baseX: 620,
                    y: 0.48,
                    animalId: 30, // sea turtle ID
                    fact: 'Sea turtles have been swimming in the oceans for over 100 million years — since the dinosaurs!',
                    tag: '🐢 Reef | 🪼 Jellyfish Eater',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 2) * 5);

                        drawEllipse(ctx, 16, 12, 10, 5, '#2ec4b6', '#000', 2, 35 * Math.PI / 180);
                        drawEllipse(ctx, 0, 0, 28, 22, '#283618', '#000', 2.5);
                        
                        ctx.strokeStyle = '#606c38';
                        ctx.lineWidth = 2;
                        ctx.strokeRect(-14, -10, 10, 10);
                        ctx.strokeRect(4, -10, 10, 10);
                        ctx.strokeRect(-8, 2, 12, 10);

                        drawCircle(ctx, -35, -4, 7, '#2ec4b6', '#000', 2);
                        drawCircle(ctx, -37, -6, 1.5, '#000', null);

                        ctx.save();
                        ctx.translate(-14, -8);
                        ctx.rotate(Math.sin(t * 3.5) * 0.6);
                        drawEllipse(ctx, -6, -14, 8, 20, '#2ec4b6', '#000', 2.5, -40 * Math.PI / 180);
                        ctx.restore();
                        ctx.restore();
                    }
                },
                {
                    name: 'Octopus',
                    baseX: 860,
                    y: 0.68,
                    animalId: 29, // octopus ID
                    fact: 'Octopuses have three hearts and blue blood! They are also highly intelligent tool users.',
                    tag: '🐙 Reef | 🦀 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 4) * 2.5);

                        ctx.strokeStyle = '#9d4edd';
                        ctx.lineWidth = 6.5;
                        ctx.lineCap = 'round';
                        for (let i = 0; i < 8; i++) {
                            let offset = i * (Math.PI / 4);
                            let angle = Math.sin(t * 5 + offset) * 0.4;
                            ctx.save();
                            ctx.translate(-10 + i * 3, 10);
                            ctx.rotate(angle);
                            ctx.beginPath();
                            ctx.moveTo(0, 0);
                            ctx.quadraticCurveTo(-15 + i * 4, 15, -10 + i * 2, 28);
                            ctx.stroke();

                            ctx.fillStyle = '#fff';
                            drawCircle(ctx, -12 + i * 3, 12, 2.5, '#fff', null);
                            drawCircle(ctx, -8 + i * 2, 22, 2, '#fff', null);
                            ctx.restore();
                        }

                        drawEllipse(ctx, 0, -10, 22, 18, '#c77dff', '#000', 2.5);
                        drawCircle(ctx, -8, -6, 6.5, '#fff', '#000', 1.5);
                        drawCircle(ctx, -8, -6, 3, '#000', null);
                        drawCircle(ctx, 8, -6, 6.5, '#fff', '#000', 1.5);
                        drawCircle(ctx, 8, -6, 3, '#000', null);
                        ctx.restore();
                    }
                },
                {
                    name: 'Hammerhead Shark',
                    baseX: 1100,
                    y: 0.36,
                    animalId: 31, // whale fallback ID
                    fact: 'Their hammer-shaped head (cephalofoil) gives them 360-degree vision and helps scan for food!',
                    tag: '🦈 Reef | 🍖 Carnivore',
                    draw(ctx, t) {
                        ctx.save();
                        ctx.translate(0, Math.sin(t * 5) * 3);

                        ctx.fillStyle = '#7f8c8d';
                        ctx.beginPath();
                        ctx.moveTo(-10, -12);
                        ctx.lineTo(-26, -34);
                        ctx.lineTo(-24, -10);
                        ctx.closePath();
                        ctx.fill();
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 2.5;
                        ctx.stroke();

                        ctx.save();
                        ctx.translate(28, 0);
                        ctx.rotate(Math.sin(t * 10) * 0.25);
                        ctx.beginPath();
                        ctx.moveTo(0, 0);
                        ctx.lineTo(18, -18);
                        ctx.lineTo(12, 0);
                        ctx.lineTo(18, 14);
                        ctx.closePath();
                        ctx.fillStyle = '#7f8c8d';
                        ctx.fill();
                        ctx.strokeStyle = '#000';
                        ctx.lineWidth = 2;
                        ctx.stroke();
                        ctx.restore();

                        drawEllipse(ctx, 0, 0, 32, 14, '#95a5a6', '#000', 2.5);

                        ctx.save();
                        ctx.translate(-24, 0);
                        drawRoundedRect(ctx, -6, -20, 10, 40, 3.5, '#7f8c8d', '#000', 2.5);
                        drawCircle(ctx, -1, -16, 2, '#000', null);
                        drawCircle(ctx, -1, 16, 2, '#000', null);
                        ctx.restore();
                        ctx.restore();
                    }
                }
            ]
        }
    };

    function drawJeep(ctx, t) {
        const jeepX = 80;
        const bobY = Math.sin(t * 7) * 2.5;
        const jeepY = getGroundY() - 36 + bobY;

        // Dust clouds trail
        ctx.fillStyle = 'rgba(180, 180, 180, 0.4)';
        for (let i = 0; i < 4; i++) {
            let dx = jeepX - 15 - i * 18 - (t * 80) % 15;
            let dy = getGroundY() - 5 + Math.sin(t * 5 + i) * 3;
            let dr = 8 + i * 4;
            drawCircle(ctx, dx, dy, dr, 'rgba(180, 180, 180, 0.2)', null, 0);
        }

        const wheelR = 14;
        const wheelY = getGroundY() - 5;
        const backWheelX = jeepX + 22;
        const frontWheelX = jeepX + 85;

        [backWheelX, frontWheelX].forEach(wx => {
            drawCircle(ctx, wx, wheelY, wheelR, '#222', '#000', 3);
            drawCircle(ctx, wx, wheelY, 6, '#7f8c8d', '#000', 2);
            ctx.strokeStyle = '#fff';
            ctx.lineWidth = 1.5;
            ctx.save();
            ctx.translate(wx, wheelY);
            ctx.rotate(t * 8);
            for (let s = 0; s < 6; s++) {
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.lineTo(0, -wheelR + 2);
                ctx.stroke();
                ctx.rotate(Math.PI / 3);
            }
            ctx.restore();
        });

        // Roll bars
        ctx.strokeStyle = '#5a3a10';
        ctx.lineWidth = 4;
        ctx.beginPath();
        ctx.moveTo(jeepX + 15, jeepY + 10);
        ctx.lineTo(jeepX + 15, jeepY - 25);
        ctx.lineTo(jeepX + 70, jeepY - 25);
        ctx.lineTo(jeepX + 70, jeepY + 10);
        ctx.stroke();

        // Passengers
        drawCircle(ctx, jeepX + 32, jeepY - 6, 8, '#FDBCB4', '#000', 2);
        drawCircle(ctx, jeepX + 30, jeepY - 8, 1, '#000', null);
        drawCircle(ctx, jeepX + 34, jeepY - 8, 1, '#000', null);
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 1.2;
        ctx.beginPath();
        ctx.arc(jeepX + 32, jeepY - 5, 3, 0, Math.PI);
        ctx.stroke();

        drawCircle(ctx, jeepX + 50, jeepY - 8, 8, '#8D5524', '#000', 2);
        drawCircle(ctx, jeepX + 48, jeepY - 10, 1, '#000', null);
        drawCircle(ctx, jeepX + 52, jeepY - 10, 1, '#000', null);
        ctx.beginPath();
        ctx.arc(jeepX + 50, jeepY - 7, 3, 0, Math.PI);
        ctx.stroke();

        // Roof
        drawRoundedRect(ctx, jeepX + 10, jeepY - 28, 68, 6, 2, '#7A5A10', '#000', 2.5);

        // Body
        drawRoundedRect(ctx, jeepX, jeepY, 110, 30, 8, '#8B6B14', '#000', 3);

        // Windshield
        ctx.fillStyle = 'rgba(140, 210, 255, 0.5)';
        ctx.beginPath();
        ctx.moveTo(jeepX + 85, jeepY);
        ctx.lineTo(jeepX + 75, jeepY - 24);
        ctx.lineTo(jeepX + 100, jeepY - 24);
        ctx.lineTo(jeepX + 105, jeepY);
        ctx.closePath();
        ctx.fill();
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2.5;
        ctx.stroke();

        drawEllipse(ctx, jeepX + 108, jeepY + 12, 5, 8, '#FFF176', '#000', 2);
        drawEllipse(ctx, jeepX + 2, jeepY + 12, 3, 6, '#E53935', '#000', 2);
    }

    // Engine Loop
    function loop() {
        scrollX += 1.8;
        t += 0.016;
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        const hab = habitats[currentHabitat];
        if (hab) {
            hab.drawBackground(ctx, canvas, t);
            hab.layers.forEach(layer => {
                layer.draw(ctx, canvas, scrollX * layer.speed);
            });
            drawJeep(ctx, t);
            hab.animals.forEach(animal => {
                const sx = mod(animal.baseX - scrollX * 0.6, canvas.width + 400) - 200;
                const sy = animal.y ? (typeof animal.y === 'function' ? animal.y(canvas) : animal.y * canvas.height) : getGroundY() - 30;
                ctx.save();
                ctx.translate(sx, sy);
                animal.draw(ctx, t);
                ctx.restore();
            });
        }

        requestAnimationFrame(loop);
    }
    requestAnimationFrame(loop);

    // Habitat tab switch functionality
    function switchHabitat(name) {
        currentHabitat = name;
        scrollX = 0;
        t = 0;
        
        // Update tabs active state
        document.querySelectorAll('.hab-tab').forEach(b => {
            b.classList.toggle('active', b.dataset.habitat === name);
        });

        // Sync with AlpineJS
        if (window.safariAppInstance) {
            window.safariAppInstance.currentHabitat = name;
            window.safariAppInstance.closePopup();
        }
    }

    // Interaction click handler
    canvas.addEventListener('click', e => {
        const rect = canvas.getBoundingClientRect();
        const mx = (e.clientX - rect.left) * (canvas.width / rect.width);
        const my = (e.clientY - rect.top) * (canvas.height / rect.height);
        
        const hab = habitats[currentHabitat];
        if (hab) {
            hab.animals.forEach(animal => {
                const sx = mod(animal.baseX - scrollX * 0.6, canvas.width + 400) - 200;
                const sy = animal.y ? (typeof animal.y === 'function' ? animal.y(canvas) : animal.y * canvas.height) : getGroundY() - 30;
                
                if (Math.hypot(mx - sx, my - sy) < 55) {
                    if (window.safariAppInstance) {
                        window.safariAppInstance.showPopup(animal);
                    }
                }
            });
        }
    });

    // Hover state feedback
    canvas.addEventListener('mousemove', e => {
        const rect = canvas.getBoundingClientRect();
        const mx = (e.clientX - rect.left) * (canvas.width / rect.width);
        const my = (e.clientY - rect.top) * (canvas.height / rect.height);
        
        let hovering = false;
        const hab = habitats[currentHabitat];
        if (hab) {
            hab.animals.forEach(animal => {
                const sx = mod(animal.baseX - scrollX * 0.6, canvas.width + 400) - 200;
                const sy = animal.y ? (typeof animal.y === 'function' ? animal.y(canvas) : animal.y * canvas.height) : getGroundY() - 30;
                
                if (Math.hypot(mx - sx, my - sy) < 55) {
                    hovering = true;
                }
            });
        }
        canvas.style.cursor = hovering ? 'pointer' : 'default';
    });
</script>
@endsection
