<script setup>
import { ref } from 'vue';

const activeService = ref(0);

const services = [
    {
        title: 'Comprehensive Eye Care',
        icon: '👁️',
        description: 'Complete eye health evaluations including visual acuity testing, intraocular pressure measurement, dilated eye exams, and personalized treatment plans for patients of all ages.',
    },
    {
        title: 'Cataract Surgery',
        icon: '🔬',
        description: 'State-of-the-art phacoemulsification and advanced intraocular lens implantation to restore clear, vibrant vision. Our surgeons have performed thousands of successful procedures.',
    },
    {
        title: 'LASIK & Refractive',
        icon: '✨',
        description: 'Advanced laser vision correction using the latest excimer laser technology. Achieve freedom from glasses and contact lenses with our precise, bladeless LASIK procedures.',
    },
    {
        title: 'Glaucoma Treatment',
        icon: '💊',
        description: 'Early detection and comprehensive management of glaucoma through advanced imaging, medication therapy, laser treatment, and minimally invasive surgical options.',
    },
    {
        title: 'Pediatric Eye Care',
        icon: '👶',
        description: 'Specialized eye care for infants, children, and adolescents. Early detection of vision problems, strabismus treatment, and amblyopia management in a child-friendly environment.',
    },
    {
        title: 'Emergency Care',
        icon: '🚑',
        description: 'Round-the-clock emergency eye care services for injuries, sudden vision loss, chemical exposure, and other urgent ocular conditions. Available 24 hours, 7 days a week.',
    },
];
</script>

<template>
    <section class="py-20 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <span class="text-6xl font-bold text-gray-200 dark:text-gray-800 block leading-none select-none" style="font-family: Georgia, serif;">Our Services</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white -mt-8 relative z-10" style="font-family: Georgia, serif;">
                    Featured Eye Care Services
                </h2>
            </div>

            <!-- Service Tabs -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
                <button 
                    v-for="(service, index) in services" 
                    :key="service.title"
                    @click="activeService = index"
                    class="relative rounded-xl p-5 text-center transition-all duration-300 cursor-pointer group"
                    :class="activeService === index 
                        ? 'bg-primary text-white shadow-lg scale-105' 
                        : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:shadow-md'"
                >
                    <div class="text-3xl mb-3">{{ service.icon }}</div>
                    <span class="text-sm font-bold block leading-tight">{{ service.title }}</span>
                    <!-- Active indicator triangle -->
                    <div v-if="activeService === index" class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[12px] border-r-[12px] border-t-[12px] border-l-transparent border-r-transparent border-t-primary"></div>
                </button>
            </div>

            <!-- Active Service Details -->
            <transition name="fade" mode="out-in">
                <div :key="activeService" class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-12 shadow-sm">
                    <div class="flex flex-col md:flex-row items-start gap-6">
                        <div class="text-5xl">{{ services[activeService].icon }}</div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4" style="font-family: Georgia, serif;">
                                {{ services[activeService].title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-lg">
                                {{ services[activeService].description }}
                            </p>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
