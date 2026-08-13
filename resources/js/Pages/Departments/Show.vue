<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout });

const props = defineProps({
    slug: {
        type: String,
        required: true
    }
});

const deptBadgeColors = {
    'diagnostic': 'bg-sky-50 text-sky-600 border-sky-100 dark:bg-sky-950/50 dark:text-sky-400 dark:border-sky-900',
    'pharmacy': 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-950/50 dark:text-emerald-400 dark:border-emerald-900',
    'optical-shop': 'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-950/50 dark:text-amber-400 dark:border-amber-900',
    'optical-workshop': 'bg-indigo-50 text-indigo-600 border-indigo-100 dark:bg-indigo-950/50 dark:text-indigo-400 dark:border-indigo-900'
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

    <div class="bg-slate-50 dark:bg-slate-900 transition-colors duration-300 min-h-screen">
        <!-- Breadcrumb Bar -->
        <div class="bg-white dark:bg-slate-800 border-b border-gray-100 dark:border-slate-700 py-3.5 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex items-center space-x-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium overflow-x-auto">
                <Link href="/" class="hover:text-primary transition-colors">{{ $t('nav.home') }}</Link>
                <span>/</span>
                <Link href="/departments" class="hover:text-primary transition-colors">{{ $t('departments.navTitle') }}</Link>
                <span>/</span>
                <span class="text-slate-900 dark:text-white font-bold truncate">{{ $t('departments.list.' + props.slug + '.title') }}</span>
            </div>
        </div>

        <!-- Hero Header -->
        <div class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider mb-4 border" :class="badgeColor">
                        {{ $t('departments.list.' + props.slug + '.badge') }}
                    </span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight font-['Outfit',sans-serif]">
                        {{ $t('departments.list.' + props.slug + '.title') }}
                    </h1>
                    <p class="mt-5 text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                        {{ $t('departments.list.' + props.slug + '.longDesc') }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4 items-center">
                        <Link 
                            :href="route('book-appointment')" 
                            class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white font-extrabold text-sm px-8 py-3.5 rounded-full transition-all duration-300 shadow-md hover:shadow-lg"
                        >
                            {{ $t('departments.bookVisit') }}
                        </Link>
                        <Link 
                            :href="route('contact')" 
                            class="inline-flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-900 dark:text-white font-bold text-sm px-8 py-3.5 rounded-full transition-colors duration-300"
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
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 font-['Outfit',sans-serif]">
                            {{ $t('departments.highlights') }}
                        </h2>
                        <ul class="space-y-4">
                            <li v-for="n in 5" :key="n" class="flex items-start bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-gray-100/80 dark:border-slate-700/50">
                                <div class="w-7 h-7 rounded-full bg-sky-100 dark:bg-sky-950/60 text-primary flex items-center justify-center shrink-0 mt-0.5 font-black text-sm">
                                    ✓
                                </div>
                                <span class="ml-4 text-base font-semibold text-slate-800 dark:text-slate-200 leading-relaxed">
                                    {{ $t('departments.list.' + props.slug + '.f' + n) }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Sidebar: Other Departments -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4 font-['Outfit',sans-serif]">
                            {{ $t('departments.exploreTitle') }}
                        </h3>
                        <ul class="space-y-2 font-['Plus_Jakarta_Sans',sans-serif]">
                            <li v-for="dept in allDeptList" :key="dept.slug">
                                <Link 
                                    :href="route('departments.show', dept.slug)"
                                    :class="[
                                        'block px-4 py-3 rounded-xl font-semibold transition-colors flex items-center justify-between text-sm',
                                        dept.slug === props.slug 
                                            ? 'bg-primary text-white font-bold' 
                                            : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-primary'
                                    ]"
                                >
                                    <span>{{ $t('departments.list.' + dept.slug + '.title') }}</span>
                                    <span v-if="dept.slug === props.slug" class="text-xs">▶</span>
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
