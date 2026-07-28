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
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div 
                    v-for="(service, index) in services" 
                    :key="index"
                    @click="selectService(index)"
                    class="bg-white dark:bg-gray-800 p-5 rounded-2xl border transition-all duration-300 cursor-pointer flex items-center space-x-4 group"
                    :class="activeService === index 
                        ? 'border-primary ring-2 ring-primary/20 shadow-md scale-[1.02]' 
                        : 'border-gray-100 dark:border-gray-700 hover:border-gray-200 dark:hover:border-gray-600 hover:shadow-sm hover:scale-[1.01]'"
                >
                    <!-- Left: Rounded Light Blue Background Box with custom eye icon -->
                    <div class="w-20 h-20 rounded-2xl bg-blue-50/70 dark:bg-blue-950/30 flex items-center justify-center shrink-0 transition-colors group-hover:bg-blue-100/80 dark:group-hover:bg-blue-900/40 text-slate-800 dark:text-slate-100 p-4">
                        <EyeIcon :type="service.iconType" class="w-full h-full" />
                    </div>

                    <!-- Right: Service Title -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors">
                            {{ $t('serviceList.list.' + service.key + '.title') }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Active Service Details Panel -->
            <div ref="detailsSection" class="mt-12 transition-all duration-500">
                <transition name="fade" mode="out-in">
                    <div :key="activeService" class="bg-gray-50 dark:bg-gray-800 rounded-3xl p-8 md:p-12 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="lg:grid lg:grid-cols-3 lg:gap-12 items-start">
                            <!-- Title & Description -->
                            <div class="lg:col-span-1">
                                <span class="text-xs font-bold text-primary tracking-wider uppercase">{{ $t('serviceList.title') }}</span>
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mt-2 mb-4" style="font-family: Georgia, serif;">
                                    {{ $t('serviceList.list.' + services[activeService].key + '.title') }}
                                </h2>
                                <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
                                    {{ $t('serviceList.list.' + services[activeService].key + '.description') }}
                                </p>
                                <Link 
                                    v-if="$page.props.settings?.enable_appointments"
                                    :href="route('book-appointment')" 
                                    class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white font-bold px-8 py-3 rounded-full transition-colors duration-300 shadow-md hover:shadow-lg"
                                >
                                    {{ $t('hero.bookAppointment') }}
                                </Link>
                                <Link 
                                    v-else
                                    :href="route('contact')" 
                                    class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white font-bold px-8 py-3 rounded-full transition-colors duration-300 shadow-md hover:shadow-lg"
                                >
                                    {{ $t('hero.contactUs') }}
                                </Link>
                            </div>

                            <!-- Features List -->
                            <div class="mt-8 lg:mt-0 lg:col-span-2">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">
                                    {{ $t('serviceList.includes') }}
                                </h3>
                                <ul class="space-y-4">
                                    <li v-for="n in 5" :key="n" class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <svg class="h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span class="ml-3 text-base text-gray-700 dark:text-gray-300">{{ $t('serviceList.list.' + services[activeService].key + '.f' + n) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </transition>
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
