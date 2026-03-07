<script setup>
const projects = [
    {
        title: 'Network Infrastructure Upgrade',
        industry: 'Education',
        service: 'Computer Networking',
        description: 'Designed and deployed a campus-wide secure Wi-Fi network for a university, improving connectivity for 5,000+ students.',
        image: 'https://images.unsplash.com/photo-1558494949-ef2cb3cc428d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', // Placeholder
    },
    {
        title: 'E-commerce Platform',
        industry: 'Retail',
        service: 'Product Development',
        description: 'Built a custom multi-vendor e-commerce platform with integrated payment gateways and logistics management.',
        image: 'https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', // Placeholder
    },
    {
        title: 'Corporate Brand Identity',
        industry: 'Finance',
        service: 'Graphic Design',
        description: 'Developed a complete brand identity including logo, stationery, and brand guidelines for a fintech startup.',
        image: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', // Placeholder
    },
];
</script>

<template>
    <div class="relative bg-gray-50 dark:bg-gray-800 pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="absolute inset-0">
            <div class="bg-white dark:bg-gray-900 h-1/3 sm:h-2/3"></div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Our Work
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-300 sm:mt-4">
                    Here are some of the projects and systems we have successfully delivered for our clients across different industries.
                </p>
            </div>
            <div class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none">
                <div v-for="project in projects" :key="project.title" class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" :src="project.image" alt="">
                    </div>
                    <div class="flex-1 bg-white dark:bg-gray-700 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-primary">
                                <a href="#" class="hover:underline">
                                    {{ project.service }}
                                </a>
                            </p>
                            <a href="#" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ project.title }}
                                </p>
                                <p class="mt-3 text-base text-gray-500 dark:text-gray-300">
                                    {{ project.description }}
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                             <div class="flex-shrink-0">
                                <span class="sr-only">{{ project.industry }}</span>
                             </div>
                             <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    Industry: {{ project.industry }}
                                </p>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
