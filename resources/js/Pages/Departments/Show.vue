<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout });

const props = defineProps({
    slug: {
        type: String,
        required: true
    }
});

const deptBadgeColors = {
    'diagnostic': 'bg-sky-50 text-sky-600 border-sky-100',
    'pharmacy': 'bg-emerald-50 text-emerald-600 border-emerald-100',
    'optical-shop': 'bg-amber-50 text-amber-600 border-amber-100',
    'optical-workshop': 'bg-indigo-50 text-indigo-600 border-indigo-100'
};

const allDeptList = [
    { slug: 'diagnostic' },
    { slug: 'pharmacy' },
    { slug: 'optical-shop' },
    { slug: 'optical-workshop' }
];

const badgeColor = computed(() => deptBadgeColors[props.slug] || deptBadgeColors['diagnostic']);
</script>

<template>
    <Head :title="$t('departments.list.' + props.slug + '.title') + ' | Makkah Specialist Eye Hospital'" />

    <div class="bg-slate-50 transition-colors duration-300 min-h-screen">
        <!-- Page Hero Banner (Moorfields Style) -->
        <PageHeroBanner 
            :title="$t('departments.list.' + props.slug + '.title')"
            :badge="$t('departments.list.' + props.slug + '.badge')"
            :breadcrumbs="[
                { label: $t('nav.home') || 'Home', href: route('home') },
                { label: $t('departments.navTitle') || 'Departments', href: route('departments.index') },
                { label: $t('departments.list.' + props.slug + '.title') }
            ]"
        />

        <!-- Department Overview Header -->
        <div class="bg-white border-b border-gray-100 py-10 md:py-14">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl" data-aos="fade-up" data-aos-duration="800">
                    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-medium">
                        {{ $t('departments.list.' + props.slug + '.longDesc') }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4 items-center">
                        <Link 
                            :href="route('book-appointment')" 
                            class="inline-flex items-center justify-center bg-primary hover:bg-[#0880cc] text-white font-extrabold text-sm px-8 py-3.5 rounded-full transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5"
                        >
                            {{ $t('departments.bookVisit') }}
                        </Link>
                        <Link 
                            :href="route('contact')" 
                            class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-900 font-bold text-sm px-8 py-3.5 rounded-full transition-all duration-300 hover:-translate-y-0.5"
                        >
                            {{ $t('departments.contactHospital') }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features & Details Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- Main Details Card -->
                <div class="lg:col-span-2 space-y-8" data-aos="fade-up" data-aos-duration="800">
                    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 font-['Outfit',sans-serif]">
                            {{ $t('departments.highlights') }}
                        </h2>
                        <ul class="space-y-4">
                            <li v-for="n in 5" :key="n" class="flex items-start bg-slate-50 p-4 rounded-2xl border border-gray-100/80 hover:bg-sky-50/40 hover:border-primary/20 hover:translate-x-1 transition-all duration-200">
                                <div class="w-7 h-7 rounded-full bg-sky-100 text-primary flex items-center justify-center shrink-0 mt-0.5 font-black text-sm">
                                    ✓
                                </div>
                                <span class="ml-4 text-base font-semibold text-slate-800 leading-relaxed">
                                    {{ $t('departments.list.' + props.slug + '.f' + n) }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Sidebar: Other Departments -->
                <div class="lg:col-span-1 space-y-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-base font-bold text-slate-900 mb-4 font-['Outfit',sans-serif]">
                            {{ $t('departments.exploreTitle') }}
                        </h3>
                        <ul class="space-y-2 font-['Plus_Jakarta_Sans',sans-serif]">
                            <li v-for="dept in allDeptList" :key="dept.slug">
                                <Link 
                                    :href="route('departments.show', dept.slug)"
                                    :class="[
                                        'block px-4 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center justify-between text-sm',
                                        dept.slug === props.slug 
                                            ? 'bg-primary text-white font-bold shadow-xs' 
                                            : 'text-slate-700 hover:bg-sky-50 hover:text-primary hover:translate-x-1'
                                    ]"
                                >
                                    <span>{{ $t('departments.list.' + dept.slug + '.title') }}</span>
                                    <span class="text-xs">→</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <CallToAction />
    </div>
</template>
