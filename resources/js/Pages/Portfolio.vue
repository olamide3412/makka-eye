<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';
import ProjectList from '@/Components/Portfolio/ProjectList.vue';
import CallToAction from '@/Components/Home/CallToAction.vue';

defineOptions({ layout: Layout })
</script>

<template>
    <Head title="Portfolio" />

    <ProjectList />
    <CallToAction />
</template>
