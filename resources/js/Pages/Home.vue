<script setup>
import HeroSection from '@/Components/Home/HeroSection.vue';
import CoreServices from '@/Components/Home/CoreServices.vue';
import WhyChooseUs from '@/Components/Home/WhyChooseUs.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: Layout })
</script>

<template>
    <Head title="Home"/>
    <div>
        <HeroSection/>
        <CoreServices/>
        <WhyChooseUs/>
        <CallToAction/>
    </div>
</template>
