<template>
    <section class="py-20 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900" style="font-family: Georgia, serif;">
                    {{ $t('whyChoose.title') }}
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-lg text-gray-500 leading-relaxed">
                    {{ $t('whyChoose.subtitle') }}
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div v-for="(item, index) in features" :key="item.key"
                     data-aos="fade-up"
                     :data-aos-delay="index * 100 + 100"
                     data-aos-duration="800"
                     class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-primary/40 transition-all duration-300 border border-gray-100 group cursor-pointer">
                    <div class="text-4xl mb-5 transform group-hover:scale-125 group-hover:rotate-6 transition-transform duration-300 inline-block">{{ item.icon }}</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors" style="font-family: Georgia, serif;">{{ $t(`whyChoose.features.${item.key}.title`) }}</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">{{ $t(`whyChoose.features.${item.key}.description`) }}</p>
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
