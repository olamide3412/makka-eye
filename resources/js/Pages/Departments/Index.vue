<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout });

const departments = [
    { slug: 'diagnostic' },
    { slug: 'pharmacy' },
    { slug: 'optical-shop' },
    { slug: 'optical-workshop' }
];
</script>

<template>
    <Head :title="$t('departments.navTitle') + ' | Makkah Specialist Eye Hospital'" />

    <div class="bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors duration-300">
        <!-- Header -->
        <div class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <span class="text-xs font-extrabold text-primary uppercase tracking-wider">{{ $t('departments.unitBadge') }}</span>
                    <h1 class="text-4xl sm:text-5xl font-black text-slate-900 dark:text-white mt-2 tracking-tight font-['Outfit',sans-serif]">
                        {{ $t('departments.indexTitle') }}
                    </h1>
                    <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                        {{ $t('departments.indexSubtitle') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <Link 
                    v-for="dept in departments" 
                    :key="dept.slug"
                    :href="route('departments.show', dept.slug)"
                    class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-gray-100 dark:border-slate-700 hover:border-primary transition-all duration-300 shadow-sm hover:shadow-lg group"
                >
                    <span class="inline-block px-3 py-1 bg-sky-50 dark:bg-slate-700 text-primary dark:text-sky-400 font-extrabold text-xs rounded-full uppercase tracking-wider mb-4">
                        {{ $t('departments.list.' + dept.slug + '.badge') }}
                    </span>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors font-['Outfit',sans-serif]">
                        {{ $t('departments.list.' + dept.slug + '.title') }}
                    </h2>
                    <p class="mt-3 text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                        {{ $t('departments.list.' + dept.slug + '.desc') }}
                    </p>
                    <div class="mt-6 font-extrabold text-xs text-primary flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                        <span>{{ $t('common.learnMore') }}</span>
                        <span>→</span>
                    </div>
                </Link>
            </div>
        </div>

        <CallToAction />
    </div>
</template>
