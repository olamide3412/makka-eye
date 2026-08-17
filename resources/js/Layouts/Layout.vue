<script setup>
import { onMounted, nextTick } from 'vue';
import { router } from '@inertiajs/vue3';
import AOS from 'aos';
import Navbar from '@/Components/Navigations/Navbar.vue';
import WhatsAppButton from '@/Components/WhatsAppButton.vue';
import Footer from '@/Components/Footer.vue';
import FlashMessages from '../Components/FlashMessages.vue';
import RouteLoader from '@/Components/Common/RouteLoader.vue';

onMounted(() => {
    AOS.refresh();
    router.on('navigate', () => {
        nextTick(() => {
            setTimeout(() => {
                AOS.refreshHard();
            }, 50);
        });
    });
});
</script>

<template>
    <div class="bg-white font-sans">
        <!-- Global Route Navigation Loader Overlay -->
        <RouteLoader />

        <!-- Unified header (top bar + nav) is inside Navbar component -->
        <Navbar />

        <!-- Top bar (52px) + nav default (~135px-145px) = ~190px at top of page -->
        <main class="pt-[175px] md:pt-[190px]">
            <slot />
            <WhatsAppButton v-if="$page.props.auth.user" />
        </main>

        <Footer />
        <FlashMessages />
    </div>
</template>
