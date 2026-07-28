<script setup>
import HeroSection from '@/Components/Home/HeroSection.vue';
import MissionSection from '@/Components/Home/MissionSection.vue';
import CoreServices from '@/Components/Home/CoreServices.vue';
import WhyChooseUs from '@/Components/Home/WhyChooseUs.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';
import Testimonials from '@/Components/Home/Testimonials.vue';
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: Layout })

const props = defineProps({ testimonials: Array })
</script>

<template>
    <Head title="Home"/>
    <div>
        <HeroSection/>
        <MissionSection/>
        <WhyChooseUs/>
        <CoreServices/>
        <Testimonials :items="props.testimonials" />
        <CallToAction/>
    </div>
</template>
