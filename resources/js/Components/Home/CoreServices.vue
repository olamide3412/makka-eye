<script setup>
import { ref, nextTick } from 'vue';
import { Link } from '@inertiajs/vue3';
import EyeIcon from '@/Components/Services/EyeIcon.vue';

const activeService = ref(0);
const detailsSection = ref(null);

const services = [
    { key: 'comprehensive', iconType: 'examination' },
    { key: 'cataract',      iconType: 'cataracts' },
    { key: 'retina',        iconType: 'retina' },
    { key: 'glaucoma',      iconType: 'glaucoma' },
    { key: 'pediatric',     iconType: 'squint' },
    { key: 'emergency',     iconType: 'emergency' },
];

const selectService = (index) => {
    activeService.value = index;
    nextTick(() => {
        if (detailsSection.value) {
            // Scroll to detail box on mobile/tablet so user sees the change immediately
            detailsSection.value.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    });
};
</script>

<template>
    <section class="py-16 sm:py-20 bg-gray-100 transition-colors duration-300 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-8 sm:mb-12" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 font-['Outfit',sans-serif] tracking-tight">
                    {{ $t('services.sectionLabel') }}
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-gray-500 block lg:hidden">
                    Tap a service to view details below ↓
                </p>
            </div>

            <!-- Service Tabs -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4 mb-8 sm:mb-10" data-aos="fade-up" data-aos-duration="900" data-aos-delay="150">
                <button
                    v-for="(service, index) in services"
                    :key="service.key"
                    @click="selectService(index)"
                    class="relative rounded-2xl p-4 sm:p-5 text-center transition-all duration-300 cursor-pointer group flex flex-col items-center justify-between min-h-[140px] sm:min-h-[160px] transform hover:-translate-y-1.5"
                    :class="activeService === index
                        ? 'bg-primary text-white shadow-xl scale-102 sm:scale-105 ring-2 ring-primary ring-offset-2'
                        : 'bg-white text-gray-700 hover:shadow-xl hover:border-primary/40 border border-gray-100'"
                >
                    <div class="w-12 h-10 sm:w-16 sm:h-12 mb-2 sm:mb-3 flex items-center justify-center shrink-0 transform group-hover:scale-115 transition-transform duration-300">
                        <EyeIcon
                            :type="service.iconType"
                            :class="activeService === index ? 'text-white' : 'text-primary'"
                            class="w-full h-full"
                        />
                    </div>
                    <span class="text-xs sm:text-sm font-bold block leading-tight mt-auto group-hover:text-primary transition-colors"
                          :class="activeService === index ? 'group-hover:text-white' : ''">
                        {{ $t(`services.list.${service.key}.title`) }}
                    </span>
                    <!-- Active indicator triangle -->
                    <div v-if="activeService === index" class="hidden sm:block absolute -bottom-3 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[12px] border-r-[12px] border-t-[12px] border-l-transparent border-r-transparent border-t-primary"></div>
                </button>
            </div>

            <!-- Active Service Details (With ref for auto-scroll on mobile) -->
            <div ref="detailsSection" class="scroll-mt-24 sm:scroll-mt-32" data-aos="fade-up" data-aos-duration="900" data-aos-delay="250">
                <transition name="fade" mode="out-in">
                    <div :key="activeService" class="bg-white rounded-3xl p-6 sm:p-8 md:p-12 shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">
                            <div class="w-20 h-16 sm:w-24 sm:h-18 flex items-center justify-center shrink-0 text-primary transform hover:scale-110 transition-transform duration-300">
                                <EyeIcon :type="services[activeService].iconType" class="w-full h-full" />
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3" style="font-family: Georgia, serif;">
                                    {{ $t(`services.list.${services[activeService].key}.title`) }}
                                </h3>
                                <p class="text-gray-600 leading-relaxed text-sm sm:text-lg mb-6">
                                    {{ $t(`services.list.${services[activeService].key}.description`) }}
                                </p>
                                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                                    <Link
                                        :href="route('services')"
                                        class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold text-xs sm:text-sm px-6 py-3 rounded-full transition-all duration-300 shadow-md hover:shadow-xl hover:scale-105"
                                    >
                                        <span>Explore All Services</span>
                                        <span>→</span>
                                    </Link>
                                    <Link
                                        :href="route('contact')"
                                        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold text-xs sm:text-sm px-6 py-3 rounded-full transition-all duration-300 hover:scale-105"
                                    >
                                        <span>Book Appointment / Contact</span>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
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
