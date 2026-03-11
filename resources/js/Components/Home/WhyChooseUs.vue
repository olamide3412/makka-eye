<template>
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 dark:text-white" style="font-family: Georgia, serif;">
                    Why Choose Makkah Specialist Eye Hospital
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-lg text-gray-500 dark:text-gray-400 leading-relaxed">
                    From comprehensive eye examinations to specialized ocular diagnostics, our team leverages modern innovations and clinical expertise to deliver precise, reliable, and results-driven care.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div v-for="item in features" :key="item.title" 
                     class="bg-white dark:bg-gray-900 rounded-xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="text-4xl mb-5">{{ item.icon }}</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3" style="font-family: Georgia, serif;">{{ item.title }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">{{ item.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const features = [
    {
        icon: '👨‍⚕️',
        title: 'Experienced Staff',
        description: 'Our highly trained, compassionate team make the difference between a good and great visit. Board-certified ophthalmologists with decades of experience.'
    },
    {
        icon: '👁️',
        title: 'Family Eye Care',
        description: 'Our practice serves the entire family — generations of great vision, stunning eyewear, and full service eye care from pediatric to geriatric.'
    },
    {
        icon: '🔬',
        title: 'Advanced Technology',
        description: 'We invest in the latest diagnostic and surgical equipment to ensure precise, reliable, and comfortable care for every patient.'
    },
    {
        icon: '📍',
        title: 'Convenient Location',
        description: 'Centrally located in Makkah with easy access and ample parking. Walk-ins are welcome for emergencies, 24 hours a day, 7 days a week.'
    }
];
</script>
