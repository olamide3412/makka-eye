<script setup>
import HeroSection from '@/Components/Home/HeroSection.vue';
import MediaCenterSection from '@/Components/Home/MediaCenterSection.vue';
import MissionSection from '@/Components/Home/MissionSection.vue';
import CoreServices from '@/Components/Home/CoreServices.vue';
import WhyChooseUs from '@/Components/Home/WhyChooseUs.vue';
import BlogSection from '@/Components/Home/BlogSection.vue';
import PartnersSection from '@/Components/Home/PartnersSection.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';
import Testimonials from '@/Components/Home/Testimonials.vue';
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: Layout });

const props = defineProps({ 
    testimonials: Array,
    partners: Array,
    mediaCenterArticles: Object,
    blogPosts: Array
});
</script>

<template>
    <Head title="Home"/>
    <div>
        <HeroSection/>
        <MediaCenterSection :articles="props.mediaCenterArticles" />
        <MissionSection/>
        <WhyChooseUs/>
        <CoreServices/>
        <BlogSection :posts="props.blogPosts" />
        <PartnersSection :partners="props.partners" />
        <Testimonials :items="props.testimonials" />
        <CallToAction/>
    </div>
</template>
