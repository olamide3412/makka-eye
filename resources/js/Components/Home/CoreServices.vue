<script setup>
import { ref } from 'vue';
import EyeIcon from '@/Components/Services/EyeIcon.vue';

const activeService = ref(0);

const services = [
    { key: 'comprehensive', iconType: 'examination' },
    { key: 'cataract',      iconType: 'cataracts' },
    { key: 'lasik',         iconType: 'lasik' },
    { key: 'glaucoma',      iconType: 'glaucoma' },
    { key: 'pediatric',     iconType: 'squint' },
    { key: 'emergency',     iconType: 'emergency' },
];
</script>

<template>
    <section class="py-20 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 dark:bg-primary/20 text-primary font-bold text-xs uppercase tracking-wider mb-3">
                    {{ $t('services.sectionLabel') }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white" style="font-family: Georgia, serif;">
                    {{ $t('services.sectionTitle') }}
                </h2>
            </div>

            <!-- Service Tabs -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
                <button
                    v-for="(service, index) in services"
                    :key="service.key"
                    @click="activeService = index"
                    class="relative rounded-xl p-5 text-center transition-all duration-300 cursor-pointer group flex flex-col items-center justify-between min-h-[160px]"
                    :class="activeService === index
                        ? 'bg-primary text-white shadow-lg scale-105'
                        : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:shadow-md'"
                >
                    <div class="w-16 h-12 mb-3 flex items-center justify-center shrink-0">
                        <EyeIcon
                            :type="service.iconType"
                            :class="activeService === index ? 'text-white' : 'text-primary dark:text-sky-400'"
                            class="w-full h-full"
                        />
                    </div>
                    <span class="text-sm font-bold block leading-tight mt-auto">{{ $t(`services.list.${service.key}.title`) }}</span>
                    <!-- Active indicator triangle -->
                    <div v-if="activeService === index" class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[12px] border-r-[12px] border-t-[12px] border-l-transparent border-r-transparent border-t-primary"></div>
                </button>
            </div>

            <!-- Active Service Details -->
            <transition name="fade" mode="out-in">
                <div :key="activeService" class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-12 shadow-sm">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                        <div class="w-24 h-18 flex items-center justify-center shrink-0 text-primary dark:text-sky-400">
                            <EyeIcon :type="services[activeService].iconType" class="w-full h-full" />
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-center md:text-left" style="font-family: Georgia, serif;">
                                {{ $t(`services.list.${services[activeService].key}.title`) }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-lg text-center md:text-left">
                                {{ $t(`services.list.${services[activeService].key}.description`) }}
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
