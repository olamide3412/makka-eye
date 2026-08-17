<script setup>
import { ref } from 'vue';
import { ServiceLink } from '@/Components/Cards';

const services = [
    { key: 'glaucoma', iconType: 'glaucoma' },
    { key: 'squint', iconType: 'squint' },
    { key: 'cataracts', iconType: 'cataracts' },
    { key: 'prosthetic', iconType: 'prosthetic' },
    { key: 'examination', iconType: 'examination' },
    { key: 'retina', iconType: 'retina' },
    { key: 'cornea', iconType: 'cornea' },
    { key: 'diabetic', iconType: 'diabetic' },
    { key: 'emergency', iconType: 'emergency' }
];
</script>

<template>
    <div class="py-12 bg-white transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Services Grid: Each Card Links to Dynamic Detail Page using ServiceLink -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <ServiceLink 
                    v-for="(service, index) in services" 
                    :key="index"
                    :href="route('services.show', service.key)"
                    :title="$t('serviceList.list.' + service.key + '.title')"
                    :description="$t('serviceList.list.' + service.key + '.description')"
                    :icon-type="service.iconType"
                    :badge="service.key === 'retina' ? $t('serviceList.retinaNotice.badge') : (service.key === 'cornea' ? $t('serviceList.corneaNotice.badge') : '')"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.fade-enter-from {
    opacity: 0;
    transform: translateY(10px);
}
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
