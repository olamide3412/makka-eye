<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const testimonials = [
    {
        text: 'The care I received at Makkah Specialist Eye Hospital was exceptional. The cataract surgery was seamless and my vision has never been better. The entire staff was professional and compassionate.',
        name: 'Ahmed Al-Rashid',
    },
    {
        text: 'I brought my daughter for a routine eye check-up and was impressed by how the pediatric team handled everything. They made her feel comfortable and the diagnosis was thorough.',
        name: 'Fatima Hassan',
    },
    {
        text: 'After years of struggling with glaucoma, the treatment plan from the specialists here has significantly improved my quality of life. I highly recommend their glaucoma management program.',
        name: 'Omar Saleh',
    },
    {
        text: 'The emergency team was incredible when I had an eye injury late at night. They responded quickly and the treatment was excellent. Truly a 24/7 facility you can count on.',
        name: 'Khalid Al-Mansour',
    },
];

const currentPage = ref(0);
const totalPages = Math.ceil(testimonials.length / 2);
let autoSlide = null;

const nextPage = () => {
    currentPage.value = (currentPage.value + 1) % totalPages;
};

onMounted(() => {
    autoSlide = setInterval(nextPage, 6000);
});

onUnmounted(() => {
    if (autoSlide) clearInterval(autoSlide);
});
</script>

<template>
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white" style="font-family: Georgia, serif;">
                    What Our Patients Say
                </h2>
                <p class="mt-3 text-gray-500 dark:text-gray-400 text-lg">Trusted by thousands of families for their eye care needs.</p>
            </div>

            <!-- Testimonials Grid -->
            <transition name="fade" mode="out-in">
                <div :key="currentPage" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div 
                        v-for="(t, i) in testimonials.slice(currentPage * 2, currentPage * 2 + 2)" 
                        :key="i"
                        class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-sm relative"
                    >
                        <!-- Large quote mark -->
                        <span class="text-6xl text-primary font-serif leading-none absolute top-4 left-6 select-none">"</span>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed mt-10 mb-6 text-base md:text-lg italic">
                            {{ t.text }}
                        </p>
                        <h4 class="font-bold text-gray-900 dark:text-white text-lg" style="font-family: Georgia, serif;">{{ t.name }}</h4>
                    </div>
                </div>
            </transition>

            <!-- Carousel indicators -->
            <div class="flex justify-center space-x-2 mt-10">
                <button 
                    v-for="p in totalPages" 
                    :key="p"
                    @click="currentPage = p - 1"
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="currentPage === p - 1 ? 'bg-primary scale-125' : 'bg-gray-300 dark:bg-gray-600'"
                ></button>
            </div>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.4s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
