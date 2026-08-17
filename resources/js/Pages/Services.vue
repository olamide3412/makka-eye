<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue';
import ServiceList from '@/Components/Services/ServiceList.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout });
</script>

<template>
    <Head :title="$t('services.sectionLabel') + ' | Makkah Specialist Eye Hospital'" />

    <div class="bg-slate-50 min-h-screen">
        <!-- Page Hero Banner (Moorfields Style) -->
        <PageHeroBanner 
            :title="$t('services.sectionLabel') || 'Clinical Services'"
            :breadcrumbs="[
                { label: $t('nav.home') || 'Home', href: route('home') },
                { label: $t('services.sectionLabel') || 'Services' }
            ]"
        />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-2">
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-3xl" data-aos="fade-up" data-aos-duration="800">
                {{ $t('services.pageDescription') }}
            </p>
        </div>

        <ServiceList />
        <CallToAction />
    </div>
</template>
