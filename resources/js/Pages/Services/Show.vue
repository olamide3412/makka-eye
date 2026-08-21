<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';
import Layout from '@/Layouts/Layout.vue';
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue';
import EyeIcon from '@/Components/Services/EyeIcon.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout });

const { t, tm, te } = useI18n();

const props = defineProps({
    slug: {
        type: String,
        required: true
    }
});

const allServices = [
    { key: 'glaucoma', iconType: 'glaucoma', image: '/images/services/glaucoma.jpg' },
    { key: 'squint', iconType: 'squint', image: '/images/services/squint.jpg' },
    { key: 'cataracts', iconType: 'cataracts', image: '/images/services/cataracts.jpg' },
    { key: 'prosthetic', iconType: 'prosthetic' },
    { key: 'examination', iconType: 'examination' },
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

const serviceTypes = computed(() => {
    try {
        const types = tm(`serviceList.list.${currentService.value.key}.types`);
        return Array.isArray(types) ? types : [];
    } catch {
        return [];
    }
});

const riskFactors = computed(() => {
    try {
        const list = tm(`serviceList.list.${currentService.value.key}.riskFactors`);
        return Array.isArray(list) ? list : [];
    } catch {
        return [];
    }
});
</script>

<template>
    <Head :title="$t('serviceList.list.' + currentService.key + '.title') + ' | Makkah Specialist Eye Hospital'" />

    <div class="bg-slate-50 transition-colors duration-300 min-h-screen">
        <!-- Page Hero Banner (Moorfields Style) -->
        <PageHeroBanner 
            :title="$t('serviceList.list.' + currentService.key + '.title')"
            :badge="$t('serviceShow.specializedCare')"
            :breadcrumbs="[
                { label: $t('nav.home') || 'Home', href: route('home') },
                { label: $t('services.sectionLabel') || 'Services', href: route('services') },
                { label: $t('serviceList.list.' + currentService.key + '.title') }
            ]"
        />

        <!-- Service Overview & Highlights Header -->
        <div class="bg-white border-b border-gray-100 py-10 md:py-14">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
                    <!-- Text Info -->
                    <div class="lg:col-span-8" data-aos="fade-up" data-aos-duration="800">
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <!-- Retinal Visiting Doctor Badge -->
                            <div v-if="currentService.key === 'retina'" class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 font-extrabold text-xs px-3.5 py-1.5 rounded-full border border-amber-200 shadow-xs">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                <span>{{ $t('serviceList.retinaNotice.badge') }}</span>
                            </div>

                            <!-- Corneal Head Office Only Badge -->
                            <div v-if="currentService.key === 'cornea'" class="inline-flex items-center gap-1.5 bg-sky-50 text-primary font-extrabold text-xs px-3.5 py-1.5 rounded-full border border-sky-200 shadow-xs">
                                <span class="w-2 h-2 rounded-full bg-primary"></span>
                                <span>{{ $t('serviceList.corneaNotice.badge') }}</span>
                            </div>
                        </div>

                        <p class="text-base sm:text-lg text-slate-700 leading-relaxed max-w-3xl font-medium">
                            {{ $t('serviceList.list.' + currentService.key + '.description') }}
                        </p>

                        <!-- Secondary Paragraph if present -->
                        <p v-if="te('serviceList.list.' + currentService.key + '.p2')" class="mt-4 text-base sm:text-lg text-slate-700 leading-relaxed max-w-3xl font-medium">
                            {{ $t('serviceList.list.' + currentService.key + '.p2') }}
                        </p>

                        <!-- Retinal Disorders Highlight Alert Banner -->
                        <div v-if="currentService.key === 'retina'" class="mt-6 p-4 sm:p-5 rounded-2xl bg-amber-50/90 border border-amber-200/90 flex items-start gap-4 hover:shadow-md transition-shadow duration-300">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 text-lg font-bold shadow-xs">
                                🩺
                            </div>
                            <div>
                                <h4 class="font-bold text-sm sm:text-base text-amber-950">{{ $t('serviceList.retinaNotice.title') }}</h4>
                                <p class="text-xs sm:text-sm text-amber-800 mt-1 leading-relaxed">{{ $t('serviceList.retinaNotice.desc') }}</p>
                            </div>
                        </div>

                        <!-- Corneal Transplantation Highlight Alert Banner -->
                        <div v-if="currentService.key === 'cornea'" class="mt-6 p-4 sm:p-5 rounded-2xl bg-sky-50/90 border border-sky-200/90 flex items-start gap-4 hover:shadow-md transition-shadow duration-300">
                            <div class="w-10 h-10 rounded-xl bg-sky-100 text-primary flex items-center justify-center shrink-0 text-lg font-bold shadow-xs">
                                🏥
                            </div>
                            <div>
                                <h4 class="font-bold text-sm sm:text-base text-slate-900">{{ $t('serviceList.corneaNotice.title') }}</h4>
                                <p class="text-xs sm:text-sm text-slate-700 mt-1 leading-relaxed">{{ $t('serviceList.corneaNotice.desc') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex flex-wrap gap-4 items-center">
                            <Link 
                                v-if="$page.props.settings?.enable_appointments"
                                :href="route('book-appointment')" 
                                class="inline-flex items-center justify-center bg-primary hover:bg-[#0880cc] text-white font-extrabold text-sm px-8 py-3.5 rounded-full transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5"
                            >
                                {{ $t('hero.bookAppointment') }}
                            </Link>
                            <Link 
                                :href="route('contact')" 
                                class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-900 font-bold text-sm px-8 py-3.5 rounded-full transition-all duration-300 hover:-translate-y-0.5"
                            >
                                {{ $t('hero.contactUs') }}
                            </Link>
                        </div>
                    </div>

                    <!-- Image / Icon Banner -->
                    <div class="mt-8 lg:mt-0 lg:col-span-4 flex justify-center" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">
                        <div v-if="currentService.image" class="w-full max-w-[360px] sm:max-w-[420px] aspect-[4/3] rounded-3xl overflow-hidden shadow-lg border border-sky-100/80 bg-white group hover:shadow-2xl transition-all duration-300 relative">
                            <img 
                                :src="currentService.image" 
                                :alt="$t('serviceList.list.' + currentService.key + '.title')" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent pointer-events-none"></div>
                            <div class="absolute bottom-3 left-3 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-800 shadow-sm flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span>Clinical Care & Diagnostics</span>
                            </div>
                        </div>
                        <div v-else class="w-40 h-40 sm:w-48 sm:h-48 rounded-3xl bg-sky-50/80 border border-sky-100 flex items-center justify-center p-7 shadow-sm text-primary hover:scale-105 hover:shadow-lg transition-all duration-300">
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
                <div class="lg:col-span-2 space-y-8" data-aos="fade-up" data-aos-duration="800">

                    <!-- Types Section (if available) -->
                    <div v-if="serviceTypes.length" class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 font-['Outfit',sans-serif] flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-sky-50 text-primary flex items-center justify-center text-sm font-black">📋</span>
                            {{ $t('serviceList.list.' + currentService.key + '.typesTitle') }}
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div v-for="(typeItem, idx) in serviceTypes" :key="idx" class="bg-slate-50 p-5 rounded-2xl border border-gray-100/90 hover:border-primary/30 hover:bg-sky-50/30 transition-all duration-200">
                                <h4 class="font-bold text-slate-900 text-base font-['Outfit',sans-serif] mb-2 text-primary">
                                    {{ typeItem.name }}
                                </h4>
                                <p class="text-sm text-slate-600 leading-relaxed font-medium">
                                    {{ typeItem.desc }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Risk Factors Section (if available) -->
                    <div v-if="riskFactors.length" class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h2 class="text-2xl font-bold text-slate-900 mb-2 font-['Outfit',sans-serif] flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-black">⚠️</span>
                            {{ $t('serviceList.list.' + currentService.key + '.riskFactorsTitle') }}
                        </h2>
                        <p class="text-sm text-slate-600 mb-6 font-medium">
                            {{ $t('serviceList.list.' + currentService.key + '.riskFactorsSubtitle') }}
                        </p>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <li v-for="(factor, fIdx) in riskFactors" :key="fIdx" class="flex items-start gap-3 bg-slate-50 p-3.5 rounded-xl border border-gray-100 text-sm font-semibold text-slate-800">
                                <span class="w-2 h-2 rounded-full bg-amber-500 mt-2 shrink-0"></span>
                                <span>{{ factor }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Our Approach Section (if available) -->
                    <div v-if="te('serviceList.list.' + currentService.key + '.approachDesc')" class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4 font-['Outfit',sans-serif] flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-black">🌟</span>
                            {{ $t('serviceList.list.' + currentService.key + '.approachTitle') }}
                        </h2>
                        <p class="text-base text-slate-700 leading-relaxed font-medium">
                            {{ $t('serviceList.list.' + currentService.key + '.approachDesc') }}
                        </p>
                    </div>

                    <!-- Service Inclusions / Diagnostics -->
                    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 font-['Outfit',sans-serif]">
                            {{ $t('serviceList.includes') }}
                        </h2>
                        <ul class="space-y-4">
                            <li v-for="n in 5" :key="n" class="flex items-start bg-slate-50 p-4 rounded-2xl border border-gray-100/80 hover:bg-sky-50/40 hover:border-primary/20 hover:translate-x-1 transition-all duration-200">
                                <div class="w-7 h-7 rounded-full bg-sky-100 text-primary flex items-center justify-center shrink-0 mt-0.5 font-black text-sm">
                                    ✓
                                </div>
                                <span class="ml-4 text-base font-semibold text-slate-800 leading-relaxed">
                                    {{ $t('serviceList.list.' + currentService.key + '.f' + n) }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Quality & Safety Info Card -->
                    <div class="bg-gradient-to-br from-primary to-[#06465C] text-white rounded-3xl p-6 sm:p-10 shadow-lg hover:shadow-xl transition-all duration-300">
                        <h3 class="text-xl sm:text-2xl font-extrabold font-['Outfit',sans-serif] mb-3">
                            {{ $t('serviceShow.whyChoose') }} {{ $t('serviceList.list.' + currentService.key + '.title') }}?
                        </h3>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed mb-6">
                            {{ $t('serviceShow.whyChooseDesc') }}
                        </p>
                        <Link :href="route('book-appointment')" class="inline-flex items-center bg-white text-primary hover:bg-slate-100 font-extrabold text-sm px-6 py-3 rounded-full transition-all duration-300 shadow hover:shadow-md hover:scale-105">
                            {{ $t('serviceShow.scheduleConsultation') }}
                        </Link>
                    </div>
                </div>

                <!-- Sidebar: Patient Info & Quick Contact -->
                <div class="lg:col-span-1 space-y-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    <!-- Retinal Visiting Doctor Sidebar Card -->
                    <div v-if="currentService.key === 'retina'" class="bg-amber-50/80 rounded-3xl p-6 sm:p-8 border border-amber-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg font-bold shadow-xs">🩺</span>
                            <h3 class="text-base font-bold text-amber-950 font-['Outfit',sans-serif]">Visiting Doctor Clinic</h3>
                        </div>
                        <p class="text-xs text-amber-900 leading-relaxed mb-4">
                            {{ $t('serviceList.retinaNotice.desc') }}
                        </p>
                        <a href="tel:+2349166661264" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-bold transition-all duration-300 shadow-xs hover:shadow-md">
                            Confirm Schedule: (+234) 916 666 1264
                        </a>
                    </div>

                    <!-- Corneal Head Office Sidebar Card -->
                    <div v-if="currentService.key === 'cornea'" class="bg-sky-50/80 rounded-3xl p-6 sm:p-8 border border-sky-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="w-9 h-9 rounded-xl bg-sky-100 text-primary flex items-center justify-center text-lg font-bold shadow-xs">🏥</span>
                            <h3 class="text-base font-bold text-slate-900 font-['Outfit',sans-serif]">Head Office Only</h3>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-4">
                            {{ $t('serviceList.corneaNotice.desc') }}
                        </p>
                        <div class="p-3 bg-white rounded-xl border border-sky-100 text-xs text-slate-600 font-medium">
                            📍 Ark07 Elebu Junction, Alao-Akala express, Ibadan
                        </div>
                    </div>

                    <!-- Quick Contact Card -->
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 font-['Outfit',sans-serif]">
                            {{ $t('serviceShow.needAssistance') }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                            {{ $t('serviceShow.needAssistanceDesc') }}
                        </p>
                        <div class="space-y-3 text-sm">
                            <a href="tel:+2349166661264" class="flex items-center space-x-3 p-3 bg-slate-50 rounded-xl hover:bg-sky-50 hover:text-primary transition-all duration-200 font-bold text-slate-800 hover:translate-x-1">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>+234 916 666 1264</span>
                            </a>
                            <a href="tel:+2348025666772" class="flex items-center space-x-3 p-3 bg-slate-50 rounded-xl hover:bg-sky-50 hover:text-primary transition-all duration-200 font-bold text-slate-800 hover:translate-x-1">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>+234 802 566 6772</span>
                            </a>
                        </div>
                    </div>

                    <!-- All Services Quick Links -->
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-base font-bold text-slate-900 mb-4 font-['Outfit',sans-serif]">
                            {{ $t('serviceShow.exploreAll') }}
                        </h3>
                        <ul class="space-y-1.5 text-sm">
                            <li v-for="service in allServices" :key="service.key">
                                <Link 
                                    :href="route('services.show', service.key)"
                                    :class="[
                                        'block px-3 py-2 rounded-xl font-semibold transition-all duration-200 flex items-center justify-between',
                                        service.key === currentService.key 
                                            ? 'bg-primary text-white shadow-xs' 
                                            : 'text-slate-600 hover:bg-sky-50 hover:text-primary hover:translate-x-1'
                                    ]"
                                >
                                    <span>{{ $t('serviceList.list.' + service.key + '.title') }}</span>
                                    <span class="text-xs">→</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- Other Services Grid -->
        <div class="bg-white py-12 md:py-16 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 font-['Outfit',sans-serif]">
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
                        class="bg-slate-50 p-6 rounded-2xl border border-gray-100 hover:border-primary transition-all duration-300 group flex items-start space-x-4 hover:shadow-md"
                    >
                        <div class="w-14 h-14 rounded-2xl bg-sky-100/80 flex items-center justify-center shrink-0 text-primary p-3">
                            <EyeIcon :type="service.iconType" class="w-full h-full" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-bold text-slate-900 group-hover:text-primary transition-colors line-clamp-1">
                                {{ $t('serviceList.list.' + service.key + '.title') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">
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
