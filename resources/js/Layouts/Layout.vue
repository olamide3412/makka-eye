<script setup>
import Navbar from '@/Components/Navigations/Navbar.vue'
import WhatsAppButton from '@/Components/WhatsAppButton.vue'
import Footer from '@/Components/Footer.vue'
import LanguageSelector from '@/Components/LanguageSelector.vue'
import { Link, usePage } from '@inertiajs/vue3';
import FlashMessages from '../Components/FlashMessages.vue';
</script>

<template>
    <div class="bg-light text-black dark:bg-dark dark:text-white font-sans">
        <!-- Top Contact Bar — Moorfields UAE Inspired Light/White Design -->
        <div class="bg-white dark:bg-slate-900 border-b border-gray-200/80 dark:border-slate-800 text-slate-800 dark:text-slate-200 fixed top-0 left-0 w-full z-[60]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between min-h-[44px]">

                    <!-- Left: Location Phone Hotlines -->
                    <div class="flex items-center space-x-4 sm:space-x-6 text-xs sm:text-sm">
                        <!-- Location 1: Ibadan -->
                        <a href="tel:+2349166661264" class="flex items-center gap-1.5 hover:text-primary transition-colors group py-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="font-extrabold text-slate-900 dark:text-white">Ibadan</span>
                            <span class="font-bold text-slate-600 dark:text-slate-300 hidden sm:inline">(+234) 916 666 1264</span>
                        </a>

                        <span class="hidden md:inline text-gray-300 dark:text-slate-700 text-xs select-none">|</span>

                        <!-- Location 2: Hotline / Emergency -->
                        <a href="tel:+2348025666772" class="hidden md:flex items-center gap-1.5 hover:text-primary transition-colors group py-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="font-extrabold text-slate-900 dark:text-white">Emergency</span>
                            <span class="font-bold text-slate-600 dark:text-slate-300">(+234) 802 566 6772</span>
                        </a>
                    </div>

                    <!-- Right: Social Media + Language Selector + Yellow CTA Button -->
                    <div class="flex items-center space-x-3 sm:space-x-5">
                        
                        <!-- Social Media Icons (Primary Colored) -->
                        <div class="hidden lg:flex items-center space-x-3 text-primary text-base">
                            <a href="https://www.instagram.com/mseh_ibdan" target="_blank" rel="noopener noreferrer" class="hover:text-primary-dark transition-transform hover:scale-110" aria-label="Instagram">
                                <font-awesome-icon :icon="['fab', 'instagram']" />
                            </a>
                            <a href="https://www.facebook.com/p/Makkah-specialist-eye-hospital-Ibadan-61578301984579/" target="_blank" rel="noopener noreferrer" class="hover:text-primary-dark transition-transform hover:scale-110" aria-label="Facebook">
                                <font-awesome-icon :icon="['fab', 'facebook']" />
                            </a>
                            <a href="https://www.tiktok.com/@mseh_ibadan" target="_blank" rel="noopener noreferrer" class="hover:text-primary-dark transition-transform hover:scale-110" aria-label="TikTok">
                                <font-awesome-icon :icon="['fab', 'tiktok']" />
                            </a>
                            <a href="https://x.com/MakkahIbadan" target="_blank" rel="noopener noreferrer" class="hover:text-primary-dark transition-transform hover:scale-110" aria-label="X">
                                <font-awesome-icon :icon="['fab', 'x-twitter']" />
                            </a>
                        </div>

                        <!-- Language Selector -->
                        <LanguageSelector />
                    </div>

                </div>
            </div>
        </div>

        <Navbar />
        <!-- Top bar is 44px, Navbar is ~80px-88px total fixed header offset ~128px -->
        <main class="pt-[118px] md:pt-[132px]">
            <slot />
            <WhatsAppButton v-if="$page.props.auth.user" />
        </main>
        <Footer />
        <FlashMessages/>
    </div>
</template>
