<script setup>
import Navbar from '@/Components/Navigations/Navbar.vue'
import WhatsAppButton from '@/Components/WhatsAppButton.vue'
import Footer from '@/Components/Footer.vue'
import { onMounted, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import FlashMessages from '../Components/FlashMessages.vue';
</script>
<template>
    <div class="bg-light text-black dark:bg-dark dark:text-white">
        <!-- Top Contact Bar -->
        <div class="bg-primary text-white text-sm hidden md:block fixed top-0 left-0 w-full z-[60]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-2">
                <span class="font-medium">Makkah Specialist Eye Hospital</span>
                <div class="flex items-center space-x-6">
                    <a href="tel:+966000000000" class="flex items-center space-x-1 hover:text-secondary-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>24/7 Emergency</span>
                    </a>
                    <a href="mailto:patient.services@makkaheye.com" class="flex items-center space-x-1 hover:text-secondary-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>patient.services@makkaheye.com</span>
                    </a>
                </div>
            </div>
        </div>

        <Navbar />
        <main class="pt-28 md:pt-32"> <!-- Offset for top bar + navbar -->
            <slot />
            <WhatsAppButton v-if="$page.props.auth.user" />
        </main>
        <Footer />
        <FlashMessages/>
    </div>
</template>
