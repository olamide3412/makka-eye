<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import EyeIcon from './EyeIcon.vue';

const activeService = ref(0);
const detailsSection = ref(null);

const selectService = (index) => {
    activeService.value = index;
    if (detailsSection.value) {
        detailsSection.value.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
};

const services = [
    { key: 'glaucoma', iconType: 'glaucoma' },
    { key: 'squint', iconType: 'squint' },
    { key: 'cataracts', iconType: 'cataracts' },
    { key: 'prosthetic', iconType: 'prosthetic' },
    { key: 'examination', iconType: 'examination' },
    { key: 'lasik', iconType: 'lasik' },
    { key: 'retina', iconType: 'retina' },
    { key: 'cornea', iconType: 'cornea' },
    { key: 'diabetic', iconType: 'diabetic' },
    { key: 'emergency', iconType: 'emergency' }
];
</script>

<template>
    <div class="py-12 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Services Grid: Each Card Links to Dynamic Detail Page -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <Link 
                    v-for="(service, index) in services" 
                    :key="index"
                    :href="route('services.show', service.key)"
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-primary/50 dark:hover:border-primary/50 transition-all duration-300 hover:shadow-md hover:-translate-y-1 group flex flex-col justify-between"
                >
                    <div>
                        <!-- Top: Light Blue Icon Container -->
                        <div class="w-16 h-16 rounded-2xl bg-blue-50/80 dark:bg-blue-950/40 flex items-center justify-center shrink-0 transition-colors group-hover:bg-primary group-hover:text-white text-primary p-3.5 mb-5">
                            <EyeIcon :type="service.iconType" class="w-full h-full" />
                        </div>

                        <!-- Service Title -->
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors font-['Outfit',sans-serif]">
                            {{ $t('serviceList.list.' + service.key + '.title') }}
                        </h3>

                        <!-- Short Description preview -->
                        <p class="mt-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400 line-clamp-3 leading-relaxed">
                            {{ $t('serviceList.list.' + service.key + '.description') }}
                        </p>
                    </div>

                    <!-- Bottom Link Arrow -->
                    <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-700/50 flex items-center justify-between text-xs font-extrabold text-primary group-hover:translate-x-1 transition-transform">
                        <span>{{ $t('services.learnMore') }}</span>
                        <span>→</span>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.fade-enter-from {
    opacity: 0;
    transform: translateY(10px);
}
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
