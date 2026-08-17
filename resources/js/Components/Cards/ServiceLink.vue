<script setup>
import { Link } from '@inertiajs/vue3';
import EyeIcon from '@/Components/Services/EyeIcon.vue';

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    href: {
        type: String,
        default: '#',
    },
    iconType: {
        type: String,
        default: '',
    },
    description: {
        type: String,
        default: '',
    },
    badge: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <Link
        :href="href"
        class="service-item-wrap group block bg-white rounded-2xl p-5 sm:p-6 border border-gray-100/90 shadow-sm hover:shadow-xl hover:border-primary/20 hover:-translate-y-1.5 transition-all duration-300 ease-out cursor-pointer relative overflow-hidden"
    >
        <!-- Subtle top accent line on hover -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-sky-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        <div class="flex items-start gap-4">
            <!-- Rounded icon box with interactive lift & color switch -->
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-primary group-hover:bg-primary group-hover:text-white flex items-center justify-center shrink-0 p-2.5 transition-all duration-300 group-hover:scale-105 group-hover:shadow-md">
                <slot name="icon">
                    <EyeIcon v-if="iconType" :type="iconType" class="w-full h-full transition-transform duration-300 group-hover:scale-110" />
                    <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </slot>
            </div>

            <!-- Content column -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="service-item-txt text-base sm:text-lg font-bold leading-tight font-['Outfit',sans-serif] group-hover:text-primary transition-colors duration-300">
                        {{ title }}
                    </h4>
                    <span v-if="badge" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-sky-50 text-primary border border-sky-100 shrink-0">
                        {{ badge }}
                    </span>
                </div>

                <p v-if="description" class="mt-1.5 text-xs sm:text-sm text-slate-500 line-clamp-2 leading-relaxed group-hover:text-slate-600 transition-colors duration-200">
                    {{ description }}
                </p>

                <div class="mt-3 text-xs font-bold text-primary/80 group-hover:text-primary flex items-center gap-1.5 transition-all duration-300">
                    <span>{{ $t('services.learnMore') || 'Learn more' }}</span>
                    <span class="inline-block transition-transform duration-300 group-hover:translate-x-1.5">→</span>
                </div>
            </div>
        </div>
    </Link>
</template>

<style scoped>
.service-item-wrap {
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease;
}
</style>
