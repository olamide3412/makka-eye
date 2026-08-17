<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section v-if="$page.props.settings?.enable_appointments" class="bg-primary overflow-hidden">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between" data-aos="fade-up" data-aos-duration="800">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">{{ $t('cta.heading') }}</span>
                <span class="block text-sky-100 mt-1 font-normal text-xl sm:text-2xl">{{ $t('cta.subheading') }}</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-full shadow-lg">
                    <Link :href="route('contact')" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-bold rounded-full text-primary bg-white hover:bg-sky-50 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        {{ $t('cta.button') }}
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

