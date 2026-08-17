<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { ReviewCard } from '@/Components/Cards';

const props = defineProps({
    items: {
        type: Array,
        default: null,
    }
});

const fallbackTestimonials = [
    { text: 'The care I received at Makkah Specialist Eye Hospital was exceptional. The cataract surgery was seamless and my vision has never been better.', name: 'Ahmed Al-Rashid', rating: 5, role: 'Cataract Patient' },
    { text: 'I brought my daughter for a routine eye check-up and was impressed by how the pediatric team handled everything. They made her feel comfortable.', name: 'Fatima Hassan', rating: 5, role: 'Pediatric Care' },
    { text: 'After years of struggling with glaucoma, the treatment plan from the specialists here has significantly improved my quality of life.', name: 'Omar Saleh', rating: 5, role: 'Glaucoma Treatment' },
    { text: 'The emergency team was incredible when I had an eye injury late at night. They responded quickly and the treatment was excellent.', name: 'Khalid Al-Mansour', rating: 5, role: 'Emergency Care' },
];

const testimonials = computed(() =>
    props.items && props.items.length > 0
        ? props.items.map(t => ({ text: t.message, name: t.name, rating: t.rating, role: t.role || 'Verified Patient' }))
        : fallbackTestimonials
);

const currentPage = ref(0);
const totalPages = computed(() => Math.ceil(testimonials.value.length / 2));
let autoSlide = null;

const nextPage = () => {
    currentPage.value = (currentPage.value + 1) % totalPages.value;
};

onMounted(() => {
    autoSlide = setInterval(nextPage, 6000);
});

onUnmounted(() => {
    if (autoSlide) clearInterval(autoSlide);
});
</script>

<template>
    <section class="py-20 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900" style="font-family: Georgia, serif;">
                    What Our Patients Say
                </h2>
                <p class="mt-3 text-gray-500 text-lg">Trusted by thousands of families for their eye care needs.</p>
            </div>

            <!-- Testimonials Grid -->
            <transition name="fade" mode="out-in">
                <div :key="currentPage" class="grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-up" data-aos-duration="900" data-aos-delay="150">
                    <ReviewCard
                        v-for="(t, i) in testimonials.slice(currentPage * 2, currentPage * 2 + 2)"
                        :key="i"
                        :name="t.name"
                        :text="t.text"
                        :rating="t.rating || 5"
                        :role="t.role"
                        color-hover="#06465C"
                    />
                </div>
            </transition>

            <!-- Carousel indicators -->
            <div class="flex justify-center space-x-2 mt-10" data-aos="fade-up">
                <button 
                    v-for="p in totalPages" 
                    :key="p"
                    @click="currentPage = p - 1"
                    class="w-3 h-3 rounded-full transition-all duration-300 hover:scale-125"
                    :class="currentPage === p - 1 ? 'bg-primary scale-125 w-8' : 'bg-gray-300 hover:bg-primary/50'"
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
