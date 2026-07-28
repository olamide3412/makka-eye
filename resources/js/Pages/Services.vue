<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';
import ServiceList from '@/Components/Services/ServiceList.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout })
</script>

<template>
    <Head :title="$t('services.sectionLabel')" />

    <div class="bg-white dark:bg-gray-900 pt-16 md:pt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-left max-w-4xl">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl tracking-tight leading-none" style="font-family: Georgia, serif;">
                    {{ $t('services.sectionLabel') }}
                </h1>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-300 leading-relaxed">
                    {{ $t('services.pageDescription') }}
                </p>
            </div>
        </div>
    </div>

    <ServiceList />
    <CallToAction />
</template>
