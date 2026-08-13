<script setup>
import { usePage } from '@inertiajs/vue3';
import { generateWhatappLink } from '../Utils/whatsappLinkGen';
import { computed } from 'vue';

const page = usePage();

const whatsappLink = computed(() => {
    const phone = page.props.support?.phone_whatsapp || '2349166661264';
    const cleanPhone = String(phone).replace(/[^0-9]/g, '');
    return generateWhatappLink(cleanPhone, 'Hello, I’d like to make an enquiry about your eye care services.');
});
</script>

<template>
    <a
      :href="whatsappLink"
      target="_blank"
      rel="noopener noreferrer"
      class="fixed right-6 bottom-6 z-50 flex items-center justify-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-3 rounded-full shadow-xl transition-all duration-300 transform hover:scale-105 group"
      aria-label="Chat on WhatsApp"
    >
      <font-awesome-icon :icon="['fab', 'whatsapp']" class="text-2xl" />
      <span class="opacity-0 w-0 overflow-hidden group-hover:opacity-100 group-hover:w-auto transition-all duration-300 whitespace-nowrap font-bold text-sm">
        Chat with Us
      </span>
    </a>
</template>
