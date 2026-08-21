<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed, onMounted, onUnmounted } from 'vue';

const page = usePage();
const slides = computed(() => {
    const customSlides = page.props.settings?.hero_slides;
    if (customSlides && Array.isArray(customSlides) && customSlides.length > 0) {
        return customSlides.map(slide => slide.value);
    }
    // Fallback default slides
    return [
        'https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=2070&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=2080&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1581595219315-a187dd40c322?q=80&w=2070&auto=format&fit=crop',
    ];
});

const currentSlide = ref(0);
let slideInterval = null;

const nextSlide = () => {
    if (slides.value.length === 0) return;
    currentSlide.value = (currentSlide.value + 1) % slides.value.length;
};

const prevSlide = () => {
    if (slides.value.length === 0) return;
    currentSlide.value = (currentSlide.value - 1 + slides.value.length) % slides.value.length;
};

const setSlide = (index) => {
    currentSlide.value = index;
};

onMounted(() => {
    slideInterval = setInterval(nextSlide, 5000);
});

onUnmounted(() => {
    if (slideInterval) clearInterval(slideInterval);
});
</script>

<template>
    <section class="relative overflow-hidden w-full min-h-[580px] sm:min-h-[700px] md:min-h-[800px] lg:min-h-[880px] xl:min-h-[940px] h-[72vh] sm:h-[82vh] md:h-[88vh] lg:h-[92vh] max-h-[1100px] flex items-center justify-center bg-slate-900 group">
        <!-- Background Slider -->
        <div class="absolute inset-0 w-full h-full z-0">
            <transition-group name="fade" tag="div" class="w-full h-full relative">
                <div 
                    v-for="(slide, index) in slides" 
                    :key="index + '-' + slide"
                    v-show="currentSlide === index"
                    class="absolute inset-0 w-full h-full flex items-center justify-center overflow-hidden"
                >
                    <!-- Blurred ambient background to match aspect ratio seamlessly without hard edges -->
                    <img 
                        :src="slide" 
                        alt="" 
                        class="absolute inset-0 w-full h-full object-cover blur-3xl scale-125 opacity-40 pointer-events-none select-none" 
                        aria-hidden="true"
                    />

                    <!-- Full uncropped crisp hero image -->
                    <img 
                        :src="slide" 
                        alt="Hospital Facility" 
                        class="relative w-full h-full object-contain object-center z-1 select-none"
                    />
                </div>
            </transition-group>
        </div>

        <!-- Optional Headline Content -->
        <div v-if="$t('hero.headline1')" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 w-full text-center pointer-events-none">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight drop-shadow-xl" style="font-family: Georgia, serif;">
                <span class="text-primary select-none">{{ $t('hero.headline1') }}</span>
            </h1>
        </div>

        <!-- Navigation Arrows (for multiple slides) -->
        <button 
            v-if="slides.length > 1"
            @click="prevSlide"
            class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/30 hover:bg-primary text-white flex items-center justify-center backdrop-blur-md border border-white/20 transition-all duration-300 opacity-0 group-hover:opacity-100 shadow-lg cursor-pointer"
            aria-label="Previous Slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <button 
            v-if="slides.length > 1"
            @click="nextSlide"
            class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/30 hover:bg-primary text-white flex items-center justify-center backdrop-blur-md border border-white/20 transition-all duration-300 opacity-0 group-hover:opacity-100 shadow-lg cursor-pointer"
            aria-label="Next Slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <!-- Slider Indicators -->
        <div v-if="slides.length > 1" class="absolute bottom-6 sm:bottom-8 left-0 right-0 flex justify-center space-x-2.5 sm:space-x-3 z-20">
            <button 
                v-for="(_, index) in slides" 
                :key="'indicator-'+index"
                @click="setSlide(index)"
                class="h-2.5 sm:h-3 rounded-full transition-all duration-300 focus:outline-none shadow-md cursor-pointer"
                :class="currentSlide === index ? 'bg-primary scale-110 w-7 sm:w-9' : 'bg-white/60 hover:bg-white w-2.5 sm:w-3'"
                :aria-label="'Go to slide ' + (index + 1)"
            ></button>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1.2s ease-in-out;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}
</style>
