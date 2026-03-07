<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';
import ContactForm from '@/Components/Contact/ContactForm.vue';

defineOptions({ layout: Layout })
</script>

<template>
    <Head title="Contact" />
    <ContactForm />
</template>
