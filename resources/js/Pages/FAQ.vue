<script setup>
import Breadcrumb from '@/Components/Navigations/Breadcrumb.vue';
import Footer from '@/Components/Footer.vue';

</script>
<template>
    <Head :title=" ` | ${$page.component}` "/>
    <Breadcrumb title="Frequently Asked Questions" name="FAQ"/>
    <FaqSection/>
    <Footer/>
</template>
