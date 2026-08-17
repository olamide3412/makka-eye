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
    <section class="relative overflow-hidden min-h-[550px] md:min-h-[650px] flex items-center justify-center">
        <!-- Background Slider -->
        <div class="absolute inset-0 w-full h-full z-0">
            <transition-group name="fade" tag="div" class="w-full h-full relative">
                <div 
                    v-for="(slide, index) in slides" 
                    :key="index + '-' + slide"
                    v-show="currentSlide === index"
                    class="absolute inset-0 w-full h-full"
                >
                    <img 
                        :src="slide" 
                        alt="Hospital Facility" 
                        class="w-full h-full object-cover"
                    />
                </div>
            </transition-group>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 w-full text-center">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight" style="font-family: Georgia, serif;">
                <span class="text-primary drop-shadow-md select-none">{{ $t('hero.headline1') }}</span>
            </h1>
        </div>

        <!-- Slider Indicators -->
        <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-3 z-20">
            <button 
                v-for="(_, index) in slides" 
                :key="'indicator-'+index"
                @click="setSlide(index)"
                class="w-3 h-3 rounded-full transition-all duration-300 focus:outline-none"
                :class="currentSlide === index ? 'bg-primary scale-125 w-8' : 'bg-white/50 hover:bg-white/80'"
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
