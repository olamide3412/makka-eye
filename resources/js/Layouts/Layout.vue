<script setup>
import Navbar from '@/Components/Navigations/Navbar.vue'
import WhatsAppButton from '@/Components/WhatsAppButton.vue'
import Footer from '@/Components/Footer.vue'
import LanguageSelector from '@/Components/LanguageSelector.vue'
import { usePage } from '@inertiajs/vue3';
import FlashMessages from '../Components/FlashMessages.vue';
</script>
<template>
    <div class="bg-light text-black dark:bg-dark dark:text-white">
        <!-- Top Contact Bar — responsive: shows on all screens -->
        <div class="bg-primary text-white text-sm fixed top-0 left-0 w-full z-[60]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1.5">

                <!-- Single row: stacks cleanly on mobile, expands on md+ -->
                <div class="flex items-center justify-between gap-2 flex-wrap">

                    <!-- Left: Social icons (hidden on mobile to save space) -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="https://www.instagram.com/mseh_ibdan" target="_blank" rel="noopener noreferrer" class="hover:text-white/80 transition-colors text-base flex items-center" aria-label="Instagram">
                            <font-awesome-icon :icon="['fab', 'instagram']" />
                        </a>
                        <a href="https://www.facebook.com/p/Makkah-specialist-eye-hospital-Ibadan-61578301984579/" target="_blank" rel="noopener noreferrer" class="hover:text-white/80 transition-colors text-base flex items-center" aria-label="Facebook">
                            <font-awesome-icon :icon="['fab', 'facebook']" />
                        </a>
                        <a href="https://www.tiktok.com/@mseh_ibadan" target="_blank" rel="noopener noreferrer" class="hover:text-white/80 transition-colors text-base flex items-center" aria-label="TikTok">
                            <font-awesome-icon :icon="['fab', 'tiktok']" />
                        </a>
                       
                        <a href="https://x.com/MakkahIbadan" target="_blank" rel="noopener noreferrer" class="hover:text-white/80 transition-colors text-base flex items-center" aria-label="X">
                            <font-awesome-icon :icon="['fab', 'x-twitter']" />
                        </a>
                    </div>

                    <!-- Right: Phone + Language Selector (always visible) -->
                    <div class="flex items-center gap-3 ml-auto">

                        <!-- Hotlines — icon+first number on mobile, both on desktop -->
                        <a href="tel:+2349166661264" class="flex items-center gap-1.5 hover:text-white/80 transition-colors group">
                            <!-- Phone icon always shows -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 flex-shrink-0 text-white/80 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <!-- "Hotline:" label — hidden on very small screens -->
                            <span class="hidden sm:inline text-xs font-medium text-white/70">Hotline:</span>
                            <!-- First number — shows from sm+ -->
                            <span class="hidden sm:inline text-xs font-semibold tracking-wide">+234 916 666 1264</span>
                        </a>

                        <!-- Second hotline — desktop only, separated by pipe -->
                        <span class="hidden md:inline text-white/30 text-xs select-none">|</span>
                        <a href="tel:+2348025666772" class="hidden md:flex items-center gap-1 hover:text-white/80 transition-colors text-xs font-semibold tracking-wide">
                            +234 802 566 6772
                        </a>

                        <!-- Divider before language -->
                        <span class="text-white/30 text-xs select-none">|</span>

                        <!-- Language Selector -->
                        <LanguageSelector />
                    </div>
                </div>
            </div>
        </div>

        <Navbar />
        <!-- pt-[88px] on mobile (topbar ~36px + navbar ~52px), md:pt-[104px] -->
        <main class="pt-[88px] md:pt-[104px]">
            <slot />
            <WhatsAppButton v-if="$page.props.auth.user" />
        </main>
        <Footer />
        <FlashMessages/>
    </div>
</template>
