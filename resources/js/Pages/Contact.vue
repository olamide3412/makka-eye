<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue';
import ContactForm from '@/Components/Contact/ContactForm.vue';

defineOptions({ layout: Layout });
</script>

<template>
    <Head :title="($t('hero.contactUs') || 'Contact Us') + ' | Makkah Specialist Eye Hospital'" />
    
    <div>
        <!-- Page Hero Banner (Moorfields Style) -->
        <PageHeroBanner 
            :title="$t('hero.contactUs') || 'Contact Us'"
            :breadcrumbs="[
                { label: $t('nav.home') || 'Home', href: route('home') },
                { label: $t('hero.contactUs') || 'Contact Us' }
            ]"
        />

        <ContactForm />
    </div>
</template>
