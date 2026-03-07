<script setup>
const services = [
    {
        title: 'Comprehensive Eye Examinations',
        description: 'Complete visual health assessments to detect and prevent eye conditions early.',
        features: [
            'Visual acuity testing',
            'Refractive error checking',
            'Eye pressure measurement',
            'Retinal examination',
            'Consultation and prescription check',
        ],
    },
    {
        title: 'Cataract Surgery',
        description: 'Safe and advanced procedures to remove cataracts and restore clear vision.',
        features: [
            'Pre-operative evaluation',
            'Phacoemulsification technique',
            'Premium intraocular lens (IOL) options',
            'Same-day discharge',
            'Comprehensive post-operative care',
        ],
    },
    {
        title: 'LASIK and Refractive Surgery',
        description: 'Permanent vision correction solutions to reduce or eliminate the need for glasses.',
        features: [
            'Detailed pre-surgical screening',
            'Custom wavefront LASIK',
            'PRK and LASEK options',
            'Astigmatism correction',
            'Quick recovery times',
        ],
    },
    {
        title: 'Glaucoma Treatment and Management',
        description: 'Expert care to monitor and control eye pressure, preserving your optic nerve health.',
        features: [
            'Advanced diagnostic imaging',
            'Medical therapy (eye drops)',
            'Laser trabeculoplasty',
            'Minimally invasive glaucoma surgery (MIGS)',
            'Long-term pressure monitoring',
        ],
    },
    {
        title: 'Retinal Disorders Treatment',
        description: 'Specialized care for conditions affecting the back of the eye, including the macula.',
        features: [
            'Diabetic retinopathy management',
            'Macular degeneration treatment',
            'Retinal detachment surgery',
            'Intravitreal injections',
            'Laser photocoagulation',
        ],
    },
    {
        title: 'Pediatric Ophthalmology',
        description: 'Gentle, specialized eye care tailored for infants, children, and adolescents.',
        features: [
            'Strabismus (crossed eyes) treatment',
            'Amblyopia (lazy eye) therapy',
            'Pediatric cataract surgery',
            'Refractive error management in kids',
            'School vision screenings',
        ],
    },
    {
        title: 'Corneal Transplantation',
        description: 'Advanced surgical procedures to replace cloudy or diseased corneal tissue.',
        features: [
            'Full-thickness transplants (PKP)',
            'Partial-thickness transplants (DSEK/DMEK)',
            'Keratoconus management',
            'Corneal cross-linking',
            'Post-transplant rehabilitation',
        ],
    },
    {
        title: 'Diabetic Eye Care',
        description: 'Preventative and therapeutic care specifically for patients with diabetes.',
        features: [
            'Annual diabetic eye exams',
            'Early detection of retinopathy',
            'Laser therapy for bleeding vessels',
            'Coordination with endocrinologists',
            'Vision rehabilitation',
        ],
    },
    {
        title: 'Emergency Eye Care',
        description: 'Immediate, 24/7 medical attention for sudden eye injuries, infections, or vision loss.',
        features: [
            'Available 24 hours a day, 7 days a week',
            'Treatment for corneal abrasions and foreign bodies',
            'Management of acute eye infections',
            'Rapid response for sudden vision changes',
            'Chemical burn irrigation and care',
        ],
    },
];
</script>

<template>
    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-12">
                <div v-for="(service, index) in services" :key="index" class="lg:grid lg:grid-cols-3 lg:gap-8 items-start">
                    <div class="lg:col-span-1">
                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white sm:text-3xl">
                            {{ service.title }}
                        </h3>
                    </div>
                    <div class="mt-8 lg:mt-0 lg:col-span-2">
                        <p class="text-lg text-gray-500 dark:text-gray-300">
                            {{ service.description }}
                        </p>
                        <ul class="mt-6 space-y-4">
                            <li v-for="feature in service.features" :key="feature" class="flex">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500 dark:text-gray-300">{{ feature }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
