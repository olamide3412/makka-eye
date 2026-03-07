<script setup>
import { Link } from '@inertiajs/vue3';

const services = [
    {
        title: 'Comprehensive Eye Exams',
        description: 'Complete general eye checkups for all ages.',
        icon: 'fas fa-eye',
    },
    {
        title: 'Cataract Surgery',
        description: 'Advanced procedures to restore clear vision.',
        icon: 'fas fa-procedures',
    },
    {
        title: 'LASIK & Refractive Surgery',
        description: 'Laser eye surgery for vision correction.',
        icon: 'fas fa-glasses',
    },
    {
        title: 'Glaucoma Management',
        description: 'Diagnosis and treatment to preserve your sight.',
        icon: 'fas fa-eye-dropper',
    },
    {
        title: 'Pediatric Ophthalmology',
        description: 'Specialized eye care for infants and children.',
        icon: 'fas fa-child',
    },
    {
        title: 'Emergency Eye Care',
        description: 'Available 24/7 for all eye emergencies.',
        icon: 'fas fa-ambulance',
    },
];
</script>

<template>
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Our Core Services</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Specialized Eye Care
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-300 lg:mx-auto">
                    Dedicated to providing world-class ophthalmology services with advanced technology.
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div v-for="service in services" :key="service.title" class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                                <!-- Icon placeholder using FontAwesome classes if available, or simple text -->
                                <i :class="service.icon"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900 dark:text-white">{{ service.title }}</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-300">
                            {{ service.description }}
                        </dd>
                    </div>
                </dl>
            </div>
             <div class="mt-10 text-center">
                 <Link :href="route('services')" class="text-primary font-medium hover:text-primary-dark">
                    View All Services <span aria-hidden="true">&rarr;</span>
                 </Link>
            </div>
        </div>
    </section>
</template>
