<template>
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 dark:text-white" style="font-family: Georgia, serif;">
                    {{ $t('whyChoose.title') }}
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-lg text-gray-500 dark:text-gray-400 leading-relaxed">
                    {{ $t('whyChoose.subtitle') }}
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div v-for="item in features" :key="item.key"
                     class="bg-white dark:bg-gray-900 rounded-xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="text-4xl mb-5">{{ item.icon }}</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3" style="font-family: Georgia, serif;">{{ $t(`whyChoose.features.${item.key}.title`) }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">{{ $t(`whyChoose.features.${item.key}.description`) }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const features = [
    { icon: '👨‍⚕️', key: 'staff' },
    { icon: '👁️', key: 'family' },
    { icon: '🔬', key: 'technology' },
    { icon: '📍', key: 'location' },
];
</script>
