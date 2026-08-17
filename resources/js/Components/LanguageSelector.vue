<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { languages, setLocale } from '@/i18n.js';

const { locale } = useI18n();
const dropdownOpen = ref(false);
const dropdownRef = ref(null);

const currentLang = () => languages.find(l => l.code === locale.value) || languages[0];

const selectLanguage = (code) => {
    setLocale(code);
    dropdownOpen.value = false;
};

const handleClickOutside = (e) => {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        dropdownOpen.value = false;
    }
};

onMounted(() => document.addEventListener('click', handleClickOutside));
onUnmounted(() => document.removeEventListener('click', handleClickOutside));
</script>

<template>
    <div ref="dropdownRef" class="relative flex items-center gap-1.5 select-none">
        <!-- Globe Icon -->
        <svg class="w-4 h-4 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
        </svg>

        <!-- Language Selector Inline -->
        <div class="flex items-center gap-1.5 text-xs sm:text-sm font-semibold">
            <template v-for="(lang, idx) in languages" :key="lang.code">
                <button
                    @click="selectLanguage(lang.code)"
                    :class="[
                        'transition-all duration-200 px-1 py-0.5 rounded leading-none',
                        locale === lang.code
                            ? 'text-primary font-bold underline underline-offset-4'
                            : 'text-gray-700 hover:text-primary'
                    ]"
                    :lang="lang.code"
                >
                    {{ lang.label }}
                </button>
                <span v-if="idx < languages.length - 1" class="text-gray-300 text-xs select-none">|</span>
            </template>
        </div>
    </div>
</template>
