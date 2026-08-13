<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CallToAction from '@/Components/Home/CallToAction.vue';
import AboutHospitalImg from '../../images/about_hospital.jpg';

defineOptions({ layout: Layout });

const props = defineProps({
    about_mission: {
        type: String,
        default: '<p>To eradicate preventable blindness and provide accessible, world-class ophthalmic care across Africa and Asia through clinical excellence, advanced diagnostics, and compassionate service.</p>'
    },
    about_vision: {
        type: String,
        default: '<p>To create a world where quality eye care is accessible to every individual, ensuring a future free of preventable visual impairment and blindness.</p>'
    },
    about_founder_name: {
        type: String,
        default: 'His Highness Prince Abdul-Aziz bin Ahmed Al-Saud'
    },
    about_founder_title: {
        type: String,
        default: 'Founder & Chairman, Al-Basar International Foundation'
    },
    about_founder_bio: {
        type: String,
        default: '<p>Founded in 1989, Al-Basar International Foundation has established specialized eye hospitals and mobile eye clinics across Africa and Asia, treating millions of patients and preventing avoidable blindness.</p>'
    },
    about_founder_image: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <Head title="About Us | Makkah Specialist Eye Hospital" />

    <div class="bg-slate-50 dark:bg-slate-900 transition-colors duration-300 min-h-screen">
        
        <!-- Hero Section -->
        <div class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <span class="inline-block px-3.5 py-1.5 bg-sky-50 dark:bg-sky-950/60 text-primary font-extrabold text-xs rounded-full uppercase tracking-wider mb-4 border border-sky-100 dark:border-sky-900/50">
                        {{ $t('aboutPage.heroTag') }}
                    </span>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tight leading-tight font-['Outfit',sans-serif]">
                        {{ $t('aboutPage.heroTitle') }}
                    </h1>
                    <p class="mt-6 text-lg sm:text-xl text-slate-600 dark:text-slate-300 leading-relaxed font-['Plus_Jakarta_Sans',sans-serif]">
                        {{ $t('aboutPage.subtitle') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission & Vision Cards Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Our Mission Card -->
                <div class="bg-white dark:bg-slate-800 p-8 sm:p-10 rounded-3xl border border-gray-100 dark:border-slate-700 shadow-xl transition-transform hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-slate-700 text-primary flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xs font-extrabold text-primary uppercase tracking-widest">{{ $t('aboutPage.corePurpose') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white mt-1 mb-4 font-['Outfit',sans-serif]">
                        {{ $t('about.mission') }}
                    </h2>
                    <div 
                        class="prose prose-slate dark:prose-invert text-base leading-relaxed text-slate-600 dark:text-slate-300 font-['Plus_Jakarta_Sans',sans-serif]" 
                        v-html="props.about_mission"
                    ></div>
                </div>

                <!-- Our Vision Card -->
                <div class="bg-white dark:bg-slate-800 p-8 sm:p-10 rounded-3xl border border-gray-100 dark:border-slate-700 shadow-xl transition-transform hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-slate-700 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <span class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">{{ $t('aboutPage.globalGoal') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white mt-1 mb-4 font-['Outfit',sans-serif]">
                        {{ $t('about.vision') }}
                    </h2>
                    <div 
                        class="prose prose-slate dark:prose-invert text-base leading-relaxed text-slate-600 dark:text-slate-300 font-['Plus_Jakarta_Sans',sans-serif]" 
                        v-html="props.about_vision"
                    ></div>
                </div>

            </div>
        </div>

        <!-- Founder Showcase Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-gray-100 dark:border-slate-700 p-8 sm:p-12 md:p-16 shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    
                    <!-- Founder Portrait Column -->
                    <div class="lg:col-span-5 flex justify-center">
                        <div class="relative w-full max-w-sm rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-slate-700 bg-slate-100 dark:bg-slate-900">
                            <img 
                                v-if="props.about_founder_image" 
                                :src="props.about_founder_image" 
                                :alt="props.about_founder_name"
                                class="w-full h-[420px] object-cover object-top"
                            />
                            <!-- Placeholder portrait avatar if no custom photo uploaded -->
                            <div v-else class="w-full h-[420px] bg-gradient-to-br from-slate-800 to-slate-950 flex flex-col items-center justify-center p-8 text-center text-white">
                                <div class="w-24 h-24 rounded-full bg-primary/20 text-primary border-2 border-primary flex items-center justify-center mb-4 text-3xl font-black">
                                    {{ (props.about_founder_name || 'A')[0] }}
                                </div>
                                <h4 class="text-xl font-bold font-['Outfit',sans-serif]">{{ props.about_founder_name }}</h4>
                                <span class="text-xs text-slate-400 mt-1">{{ props.about_founder_title }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Founder Details & Bio Column -->
                    <div class="lg:col-span-7 space-y-6">
                        <span class="inline-block px-3.5 py-1 bg-amber-50 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400 font-extrabold text-xs rounded-full uppercase tracking-wider border border-amber-200/60 dark:border-amber-900/50">
                            {{ $t('aboutPage.founderTag') }}
                        </span>
                        
                        <div>
                            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight font-['Outfit',sans-serif] leading-snug">
                                {{ props.about_founder_name }}
                            </h2>
                            <p class="text-base font-bold text-primary dark:text-sky-400 mt-1">
                                {{ props.about_founder_title }}
                            </p>
                        </div>

                        <!-- Bio / Quote Container -->
                        <div class="relative bg-slate-50 dark:bg-slate-900/60 p-6 sm:p-8 rounded-2xl border-l-4 border-primary dark:border-sky-500">
                            <div 
                                class="prose prose-slate dark:prose-invert text-base leading-relaxed text-slate-700 dark:text-slate-300 font-['Plus_Jakarta_Sans',sans-serif]" 
                                v-html="props.about_founder_bio"
                            ></div>
                        </div>

                        <div class="pt-2 flex flex-wrap gap-4 items-center">
                            <Link 
                                :href="route('contact')" 
                                class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white font-extrabold text-sm px-6 py-3 rounded-full transition-all shadow-md hover:shadow-lg"
                            >
                                Contact Our Team
                            </Link>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Hospital Info & visiting Hours -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 md:pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Hospital Image Card -->
                <div class="relative rounded-3xl overflow-hidden shadow-xl h-96 border border-gray-100 dark:border-slate-700">
                    <img :src="AboutHospitalImg" alt="Makkah Specialist Eye Hospital Facility" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-sky-300">Ibadan Centre</span>
                        <h3 class="text-2xl font-bold font-['Outfit',sans-serif]">State-of-the-Art Ophthalmic Facility</h3>
                    </div>
                </div>

                <!-- Visiting Hours & Patient Information -->
                <div class="space-y-6">
                    <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white font-['Outfit',sans-serif]">
                        {{ $t('aboutPage.visitingTitle') }}
                    </h2>
                    <div class="text-slate-600 dark:text-slate-300 space-y-4 font-['Plus_Jakarta_Sans',sans-serif]">
                        <p class="text-base bg-white dark:bg-slate-800 p-4 rounded-2xl border border-gray-100 dark:border-slate-700">
                            <strong class="text-slate-900 dark:text-white">{{ $t('aboutPage.visitingHours') }}:</strong> <br>
                            • {{ $t('aboutPage.monFri') }}<br>
                            • {{ $t('aboutPage.sat') }}<br>
                            • {{ $t('aboutPage.sun') }}<br>
                            • <span class="text-primary font-bold">{{ $t('aboutPage.emergency') }}</span>
                        </p>
                        <p class="text-sm bg-white dark:bg-slate-800 p-4 rounded-2xl border border-gray-100 dark:border-slate-700">
                            <strong class="text-slate-900 dark:text-white">{{ $t('aboutPage.insuranceTitle') }}:</strong> {{ $t('aboutPage.insuranceDesc') }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <CallToAction />
    </div>
</template>
