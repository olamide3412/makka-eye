<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import EyeIcon from '@/Components/Services/EyeIcon.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout });

const props = defineProps({
    slug: {
        type: String,
        required: true
    }
});

const allServices = [
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

const currentService = computed(() => {
    return allServices.find(s => s.key === props.slug) || allServices[0];
});

const otherServices = computed(() => {
    return allServices.filter(s => s.key !== currentService.value.key);
});
</script>

<template>
    <Head :title="$t('serviceList.list.' + currentService.key + '.title') + ' | Makkah Specialist Eye Hospital'" />

    <div class="bg-slate-50 dark:bg-slate-900 transition-colors duration-300 min-h-screen">
        <!-- Breadcrumb Bar -->
        <div class="bg-white dark:bg-slate-800 border-b border-gray-100 dark:border-slate-700 py-3.5 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex items-center space-x-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium overflow-x-auto">
                <Link href="/" class="hover:text-primary transition-colors">{{ $t('nav.home') }}</Link>
                <span>/</span>
                <Link href="/services" class="hover:text-primary transition-colors">{{ $t('services.sectionLabel') }}</Link>
                <span>/</span>
                <span class="text-slate-900 dark:text-white font-bold truncate">{{ $t('serviceList.list.' + currentService.key + '.title') }}</span>
            </div>
        </div>

        <!-- Service Hero Header -->
        <div class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
                    <!-- Text Info -->
                    <div class="lg:col-span-8">
                        <div class="inline-flex items-center space-x-2 bg-sky-50 dark:bg-sky-950/40 text-primary dark:text-sky-400 font-extrabold text-xs px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-4 border border-sky-100 dark:border-sky-900/50">
                            <span>{{ $t('serviceShow.specializedCare') }}</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight font-['Outfit',sans-serif]">
                            {{ $t('serviceList.list.' + currentService.key + '.title') }}
                        </h1>
                        <p class="mt-5 text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                            {{ $t('serviceList.list.' + currentService.key + '.description') }}
                        </p>
                        
                        <div class="mt-8 flex flex-wrap gap-4 items-center">
                            <Link 
                                v-if="$page.props.settings?.enable_appointments"
                                :href="route('book-appointment')" 
                                class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white font-extrabold text-sm px-8 py-3.5 rounded-full transition-all duration-300 shadow-md hover:shadow-lg hover:scale-105"
                            >
                                {{ $t('hero.bookAppointment') }}
                            </Link>
                            <Link 
                                :href="route('contact')" 
                                class="inline-flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-900 dark:text-white font-bold text-sm px-8 py-3.5 rounded-full transition-colors duration-300"
                            >
                                {{ $t('hero.contactUs') }}
                            </Link>
                        </div>
                    </div>

                    <!-- Icon Banner -->
                    <div class="mt-10 lg:mt-0 lg:col-span-4 flex justify-center">
                        <div class="w-48 h-48 sm:w-56 sm:h-56 rounded-3xl bg-sky-50/80 dark:bg-slate-800/80 border border-sky-100 dark:border-slate-700 flex items-center justify-center p-8 shadow-sm text-primary">
                            <EyeIcon :type="currentService.iconType" class="w-full h-full" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Inclusions & Features Details -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- Main Content Panel -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 font-['Outfit',sans-serif]">
                            {{ $t('serviceList.includes') }}
                        </h2>
                        <ul class="space-y-4">
                            <li v-for="n in 5" :key="n" class="flex items-start bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-gray-100/80 dark:border-slate-700/50">
                                <div class="w-7 h-7 rounded-full bg-sky-100 dark:bg-sky-950/60 text-primary dark:text-sky-400 flex items-center justify-center shrink-0 mt-0.5 font-black text-sm">
                                    ✓
                                </div>
                                <span class="ml-4 text-base font-semibold text-slate-800 dark:text-slate-200 leading-relaxed">
                                    {{ $t('serviceList.list.' + currentService.key + '.f' + n) }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Quality & Safety Info Card -->
                    <div class="bg-gradient-to-br from-primary to-primary-dark text-white rounded-3xl p-6 sm:p-10 shadow-lg">
                        <h3 class="text-xl sm:text-2xl font-extrabold font-['Outfit',sans-serif] mb-3">
                            {{ $t('serviceShow.whyChoose') }} {{ $t('serviceList.list.' + currentService.key + '.title') }}?
                        </h3>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed mb-6">
                            {{ $t('serviceShow.whyChooseDesc') }}
                        </p>
                        <Link :href="route('book-appointment')" class="inline-flex items-center bg-white text-primary hover:bg-slate-100 font-extrabold text-sm px-6 py-3 rounded-full transition-colors shadow">
                            {{ $t('serviceShow.scheduleConsultation') }}
                        </Link>
                    </div>
                </div>

                <!-- Sidebar: Patient Info & Quick Contact -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Quick Contact Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 font-['Outfit',sans-serif]">
                            {{ $t('serviceShow.needAssistance') }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 leading-relaxed">
                            {{ $t('serviceShow.needAssistanceDesc') }}
                        </p>
                        <div class="space-y-3 text-sm">
                            <a href="tel:+2349166661264" class="flex items-center space-x-3 p-3 bg-slate-50 dark:bg-slate-900 rounded-xl hover:text-primary transition-colors font-bold text-slate-800 dark:text-white">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>+234 916 666 1264</span>
                            </a>
                            <a href="tel:+2348025666772" class="flex items-center space-x-3 p-3 bg-slate-50 dark:bg-slate-900 rounded-xl hover:text-primary transition-colors font-bold text-slate-800 dark:text-white">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>+234 802 566 6772</span>
                            </a>
                        </div>
                    </div>

                    <!-- All Services Quick Links -->
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4 font-['Outfit',sans-serif]">
                            {{ $t('serviceShow.exploreAll') }}
                        </h3>
                        <ul class="space-y-1.5 text-sm">
                            <li v-for="service in allServices" :key="service.key">
                                <Link 
                                    :href="route('services.show', service.key)"
                                    :class="[
                                        'block px-3 py-2 rounded-xl font-semibold transition-colors flex items-center justify-between',
                                        service.key === currentService.key 
                                            ? 'bg-primary text-white font-bold' 
                                            : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-primary'
                                    ]"
                                >
                                    <span>{{ $t('serviceList.list.' + service.key + '.title') }}</span>
                                    <span v-if="service.key === currentService.key" class="text-xs">▶</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- Other Services Grid -->
        <div class="bg-white dark:bg-slate-900 py-12 md:py-16 border-t border-gray-100 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white font-['Outfit',sans-serif]">
                        {{ $t('serviceShow.otherServices') }}
                    </h2>
                    <Link href="/services" class="text-primary hover:text-primary-dark text-sm font-bold flex items-center gap-1">
                        {{ $t('serviceShow.viewAllServices') }} →
                    </Link>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <Link 
                        v-for="service in otherServices.slice(0, 3)" 
                        :key="service.key"
                        :href="route('services.show', service.key)"
                        class="bg-slate-50 dark:bg-slate-800 p-6 rounded-2xl border border-gray-100 dark:border-slate-700 hover:border-primary transition-all duration-300 group flex items-start space-x-4 hover:shadow-md"
                    >
                        <div class="w-14 h-14 rounded-2xl bg-sky-100/80 dark:bg-slate-700 flex items-center justify-center shrink-0 text-primary p-3">
                            <EyeIcon :type="service.iconType" class="w-full h-full" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1">
                                {{ $t('serviceList.list.' + service.key + '.title') }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">
                                {{ $t('serviceList.list.' + service.key + '.description') }}
                            </p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <CallToAction />
    </div>
</template>
