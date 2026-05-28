<section id="hero" class="relative h-screen w-full flex items-center overflow-hidden bg-moss-950">
    
    <!-- Fullscreen background video -->
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
        <video 
            autoplay 
            muted 
            loop 
            playsinline 
            class="w-full h-full object-cover select-none pointer-events-none scale-100"
            src="{{ asset('videos/hero-wildlife.mp4') }}">
        </video>
        <!-- Subtle dark gradient overlay for text legibility without overly darkening the wildlife -->
        <div class="absolute inset-0 bg-gradient-to-r from-moss-950/80 via-moss-950/45 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-moss-950/50 via-transparent to-transparent z-10"></div>
    </div>

    <!-- Minimal Ambient Particles Canvas -->
    <canvas id="ambient-particles" class="absolute inset-0 w-full h-full z-15 pointer-events-none opacity-40"></canvas>

    <!-- Hero Content (Positioned slightly left-aligned and in front of the video) -->
    <div class="relative z-20 w-full max-w-7xl mx-auto px-6 md:px-12 flex justify-start items-center h-full">
        <div class="max-w-2xl text-left animate-fade-in-up">
            
            <!-- Small Label -->
            <span class="inline-block text-xs font-mono tracking-[0.4em] text-gold-400 font-bold mb-4 uppercase">
                WELCOME TO WILDVERSE
            </span>
            
            <!-- Main Heading -->
            <h1 class="font-serif tracking-tight text-white text-5xl sm:text-7xl lg:text-8xl font-bold mb-6 leading-[1.1]">
                Step Into<br>
                <span class="text-gold-300">The Wild</span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-zinc-300 text-base sm:text-lg leading-relaxed font-light mb-10 max-w-lg">
                Experience wildlife through immersive habitats and interactive exploration designed for all age groups.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                <a href="{{ route('explore') }}" class="px-8 py-4 rounded-full bg-gold-500 text-forest-950 font-bold text-xs tracking-[0.2em] shadow-lg hover:bg-gold-400 hover:scale-105 transition-all duration-300 text-center">
                    EXPLORE HABITATS
                </a>
                <a href="{{ route('animals.index') }}" class="px-8 py-4 rounded-full border border-white/20 text-white font-semibold text-xs tracking-[0.2em] bg-white/5 hover:bg-white/10 hover:border-white/40 hover:scale-105 transition-all duration-300 text-center">
                    DISCOVER ANIMALS
                </a>
            </div>

        </div>
    </div>

    <!-- Animated Scroll Indicator -->
    <a href="#facts" class="absolute bottom-8 left-6 md:left-12 z-25 flex items-center gap-3 group cursor-pointer text-zinc-500 hover:text-gold-400 transition-colors duration-300">
        <div class="flex flex-col items-center">
            <span class="text-[9px] tracking-[0.3em] text-zinc-400 font-mono">SCROLL TO EXPLORE</span>
            <div class="mt-2 text-zinc-500 group-hover:text-gold-400 transition-colors animate-scroll-indicator">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </div>
    </a>

</section>

<!-- Lightweight Canvas Particle Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const canvas = document.getElementById('ambient-particles');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let particles = [];
        
        const resize = () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        };
        
        window.addEventListener('resize', resize);
        resize();
        
        class Particle {
            constructor() {
                this.reset();
                this.y = Math.random() * canvas.height;
            }
            
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = canvas.height + 10;
                this.size = Math.random() * 2 + 0.5;
                this.speedY = -(Math.random() * 0.4 + 0.1);
                this.speedX = Math.random() * 0.2 - 0.1;
                this.alpha = Math.random() * 0.5 + 0.1;
            }
            
            update() {
                this.y += this.speedY;
                this.x += this.speedX;
                if (this.y < -10 || this.x < -10 || this.x > canvas.width + 10) {
                    this.reset();
                }
            }
            
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(226, 185, 120, ${this.alpha})`;
                ctx.fill();
            }
        }
        
        // Spawn 20 subtle particles
        for (let i = 0; i < 20; i++) {
            particles.push(new Particle());
        }
        
        const animate = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animate);
        };
        
        animate();
    });
</script>
