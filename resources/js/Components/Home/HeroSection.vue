<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

// Using high quality placeholders from unsplash for medical/hospital theme
const slides = ref([
    'https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=2070&auto=format&fit=crop', // Hospital corridor/medical tech
    'https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=2080&auto=format&fit=crop', // Surgery/operation
    'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?q=80&w=2070&auto=format&fit=crop', // Optic/tech equipment
]);

const currentSlide = ref(0);
let slideInterval = null;

const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % slides.value.length;
};

const setSlide = (index) => {
    currentSlide.value = index;
};

onMounted(() => {
    slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
});

onUnmounted(() => {
    if (slideInterval) clearInterval(slideInterval);
});
</script>

<template>
    <section class="relative bg-white dark:bg-gray-900 overflow-hidden min-h-[600px] flex items-center justify-center">
        <!-- Background Slider -->
        <div class="absolute inset-0 w-full h-full z-0">
            <transition-group name="fade" tag="div" class="w-full h-full relative">
                <div 
                    v-for="(slide, index) in slides" 
                    :key="slide"
                    v-show="currentSlide === index"
                    class="absolute inset-0 w-full h-full"
                >
                    <img 
                        :src="slide" 
                        alt="Hospital Facility" 
                        class="w-full h-full object-cover"
                    />
                    <!-- Overlay to ensure text readability in both dark and light modes -->
                    <div class="absolute inset-0 bg-white/70 dark:bg-gray-900/80 transition-colors duration-300"></div>
                </div>
            </transition-group>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 w-full">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl drop-shadow-sm">
                    <span class="block">World-Class</span>
                    <span class="block text-primary">Ophthalmology Services</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-700 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl drop-shadow-sm">
                    Our state-of-the-art facility combines advanced technology with experienced medical professionals to deliver exceptional patient care.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <Link :href="route('contact')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-dark md:py-4 md:text-lg md:px-10 transition-colors duration-300">
                            Book Appointment
                        </Link>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <Link :href="route('contact')" class="w-full flex items-center justify-center px-8 py-3 border-2 border-primary text-base font-medium rounded-md text-primary bg-white/90 dark:bg-gray-800/90 hover:bg-gray-50 dark:hover:bg-gray-700 dark:text-gray-100 dark:border-gray-500 md:py-4 md:text-lg md:px-10 transition-colors duration-300">
                            Emergency Info
                        </Link>
                    </div>
                </div>
            </div>
            
            <!-- Slider Indicators -->
            <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2 z-20">
                <button 
                    v-for="(_, index) in slides" 
                    :key="'indicator-'+index"
                    @click="setSlide(index)"
                    class="w-3 h-3 rounded-full transition-colors duration-300 focus:outline-none"
                    :class="currentSlide === index ? 'bg-primary scale-125' : 'bg-gray-400 dark:bg-gray-600 hover:bg-gray-500'"
                    :aria-label="'Go to slide ' + (index + 1)"
                ></button>
            </div>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s ease-in-out;
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
