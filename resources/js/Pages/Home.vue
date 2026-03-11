<script setup>
import HeroSection from '@/Components/Home/HeroSection.vue';
import CoreServices from '@/Components/Home/CoreServices.vue';
import WhyChooseUs from '@/Components/Home/WhyChooseUs.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';
import Testimonials from '@/Components/Home/Testimonials.vue';
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: Layout })
</script>

<template>
    <Head title="Home"/>
    <div>
        <HeroSection/>
        <WhyChooseUs/>
        <CoreServices/>
        <Testimonials/>
        <CallToAction/>
    </div>
</template>
