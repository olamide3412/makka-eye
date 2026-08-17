<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue';
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

    <div class="bg-slate-50 min-h-screen transition-colors duration-300">
        <!-- Page Hero Banner (Moorfields Style) -->
        <PageHeroBanner 
            :title="$t('departments.indexTitle') || 'Hospital Departments'"
            :breadcrumbs="[
                { label: $t('nav.home') || 'Home', href: route('home') },
                { label: $t('departments.navTitle') || 'Departments' }
            ]"
        />

        <!-- Intro Text -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-3xl" data-aos="fade-up" data-aos-duration="800">
                {{ $t('departments.indexSubtitle') }}
            </p>
        </div>

        <!-- Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <Link 
                    v-for="dept in departments" 
                    :key="dept.slug"
                    :href="route('departments.show', dept.slug)"
                    class="bg-white p-8 rounded-3xl border border-gray-100 hover:border-primary transition-all duration-300 shadow-sm hover:shadow-lg group"
                >
                    <span class="inline-block px-3 py-1 bg-sky-50 text-primary font-extrabold text-xs rounded-full uppercase tracking-wider mb-4">
                        {{ $t('departments.list.' + dept.slug + '.badge') }}
                    </span>
                    <h2 class="text-2xl font-bold text-slate-900 group-hover:text-primary transition-colors font-['Outfit',sans-serif]">
                        {{ $t('departments.list.' + dept.slug + '.title') }}
                    </h2>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">
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
