<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CallToAction from '@/Components/Home/CallToAction.vue';
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue';
import HistoryTimeline from '@/Components/About/HistoryTimeline.vue';
import OurMission from '@/Components/About/OurMission.vue';
import CoreValues from '@/Components/About/CoreValues.vue';
import AboutHospitalImg from '../../images/about_hospital.jpg';
import { StatCard, TeamCard } from '@/Components/Cards';

defineOptions({ layout: Layout });

const props = defineProps({
    about_mission: {
        type: String,
        default: '<p>To eradicate preventable blindness and provide accessible, world-class ophthalmic care across Africa and Asia through clinical excellence, advanced diagnostics, and compassionate service.</p>'
    },
    about_vision: {
        type: String,
        default: '<p>To create a world where quality eye care is accessible to every individual, ensuring a future free of preventable visual impairment and blindness.</p>'
    },
    about_founder_name: {
        type: String,
        default: 'His Highness Prince Abdul-Aziz bin Ahmed Al-Saud'
    },
    about_founder_title: {
        type: String,
        default: 'Founder & Chairman, Al-Basar International Foundation'
    },
    about_founder_bio: {
        type: String,
        default: '<p>Founded in 1989, Al-Basar International Foundation has established specialized eye hospitals and mobile eye clinics across Africa and Asia, treating millions of patients and preventing avoidable blindness.</p>'
    },
    about_founder_image: {
        type: String,
        default: ''
    }
});

const milestones = [
    {
        year: '1989',
        title: 'Foundation Established',
        points: [
            'Founded by HRH Prince Abdul-Aziz bin Ahmed Al-Saud',
            'Launched mobile ophthalmic camps to fight preventable blindness'
        ],
        image: 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=600&auto=format&fit=crop',
        imageAlt: 'Foundation Established 1989'
    },
    {
        year: '1994',
        title: 'Global Hospital Network',
        points: [
            'Opened permanent specialized eye hospitals across Asia and Africa',
            'Established clinical training institutes for ophthalmologists'
        ],
        image: 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?q=80&w=600&auto=format&fit=crop',
        imageAlt: 'Hospital Network Expansion'
    },
    {
        year: '2005',
        title: 'Nigeria Expansion',
        points: [
            'Commenced large-scale tertiary eye care operations in Nigeria',
            'Over 500,000 free sight-saving screenings conducted'
        ],
        image: 'https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=600&auto=format&fit=crop',
        imageAlt: 'Nigeria Eye Care Outreach'
    },
    {
        year: '2018',
        title: 'Advanced Surgical Centers',
        points: [
            'Introduced laser vitrectomy and micro-incision phaco cataract surgery',
            'Expanded sub-specialty clinics in pediatric strabismus and glaucoma'
        ],
        image: 'https://images.unsplash.com/photo-1551076805-e1869033e561?q=80&w=600&auto=format&fit=crop',
        imageAlt: 'Advanced Surgical Equipment'
    },
    {
        year: '2024+',
        title: 'Makkah Eye Hospital Ibadan',
        points: [
            'Full-service tertiary center at Alao-Akala Express, Ibadan',
            'State-of-the-art diagnostics, optical workshop, and 24/7 emergency'
        ],
        image: AboutHospitalImg,
        imageAlt: 'Makkah Specialist Eye Hospital Ibadan'
    }
];
</script>

<template>
    <Head title="About Us | Makkah Specialist Eye Hospital" />

    <div class="bg-slate-50 transition-colors duration-300 min-h-screen">
        
        <!-- 1. Page Hero Banner (Moorfields Style) -->
        <PageHeroBanner 
            :title="$t('aboutPage.heroTitle')"
            :breadcrumbs="[
                { label: $t('nav.home') || 'Home', href: route('home') },
                { label: $t('aboutPage.heroTitle') || 'About Us' }
            ]"
        />

        <!-- 2. Intro Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 relative z-10">
            <div class="max-w-3xl" data-aos="fade-up" data-aos-duration="800">
                <span class="inline-block px-3.5 py-1.5 bg-sky-50 text-primary font-extrabold text-xs rounded-full uppercase tracking-wider mb-3 border border-sky-100 shadow-xs">
                    {{ $t('aboutPage.heroTag') }}
                </span>
                <p class="text-lg sm:text-xl text-slate-700 leading-relaxed font-medium">
                    {{ $t('aboutPage.subtitle') }}
                </p>
            </div>
        </div>

        <!-- 3. History Timeline Section (Dark Horizontal / Stacked Mobile) -->
        <HistoryTimeline :milestones="milestones" />

        <!-- 4. Our Mission & Vision Section (Two-Column with Striped Accent) -->
        <OurMission :image="AboutHospitalImg" />

        <!-- 5. Core Values Section (2-Column x 3-Row Grid with Expanding Hover) -->
        <CoreValues />

        <!-- Key Heritage & Impact Metrics (Pattern 1 Stat Cards) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
                <span class="text-xs font-extrabold text-primary uppercase tracking-widest bg-sky-50 px-3.5 py-1.5 rounded-full border border-sky-100">
                    {{ $t('aboutPage.heritageImpactBadge') || 'Heritage & Global Impact' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight font-['Outfit',sans-serif]">
                    {{ $t('aboutPage.heritageImpactTitle') || 'Leading Eye Care Across Continents' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <StatCard
                    value="35+"
                    label="Years of Heritage"
                    description="Established in 1989 by Al-Basar International Foundation."
                    color-a="#06465C"
                    color-b="#0A96EB"
                    data-aos="fade-up"
                    data-aos-delay="100"
                />
                <StatCard
                    value="16+"
                    label="Specialized Hospitals"
                    description="Modern ophthalmic hospitals and training centers worldwide."
                    color-a="#0A96EB"
                    color-b="#06465C"
                    data-aos="fade-up"
                    data-aos-delay="200"
                />
                <StatCard
                    value="1M+"
                    label="Surgeries Completed"
                    description="Sight-restoring surgeries and treatments performed."
                    color-a="#007377"
                    color-b="#0A96EB"
                    data-aos="fade-up"
                    data-aos-delay="300"
                />
                <StatCard
                    value="100%"
                    label="Commitment to Care"
                    description="Dedicated to eradicating preventable blindness for all."
                    color-a="#1e293b"
                    color-b="#06465C"
                    data-aos="fade-up"
                    data-aos-delay="400"
                />
            </div>
        </div>

        <!-- Founder Showcase Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="bg-white rounded-3xl border border-gray-100 p-8 sm:p-12 md:p-16 shadow-lg overflow-hidden" data-aos="fade-up">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    
                    <!-- Founder Portrait Column -->
                    <div class="lg:col-span-5 flex justify-center">
                        <div class="relative w-full max-w-sm rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-100">
                            <img 
                                v-if="props.about_founder_image" 
                                :src="props.about_founder_image" 
                                :alt="props.about_founder_name"
                                class="w-full h-[420px] object-cover object-top"
                            />
                            <!-- Placeholder portrait avatar if no custom photo uploaded -->
                            <div v-else class="w-full h-[420px] bg-gradient-to-br from-slate-800 to-slate-950 flex flex-col items-center justify-center p-8 text-center text-white">
                                <div class="w-24 h-24 rounded-full bg-primary/20 text-primary border-2 border-primary flex items-center justify-center mb-4 text-3xl font-black">
                                    {{ (props.about_founder_name || 'A')[0] }}
                                </div>
                                <h4 class="text-xl font-bold font-['Outfit',sans-serif]">{{ props.about_founder_name }}</h4>
                                <span class="text-xs text-slate-400 mt-1">{{ props.about_founder_title }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Founder Details & Bio Column -->
                    <div class="lg:col-span-7 space-y-6">
                        <span class="inline-block px-3.5 py-1 bg-amber-50 text-amber-700 font-extrabold text-xs rounded-full uppercase tracking-wider border border-amber-200/60">
                            {{ $t('aboutPage.founderTag') }}
                        </span>
                        
                        <div>
                            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight font-['Outfit',sans-serif] leading-snug">
                                {{ props.about_founder_name }}
                            </h2>
                            <p class="text-base font-bold text-primary mt-1">
                                {{ props.about_founder_title }}
                            </p>
                        </div>

                        <!-- Bio / Quote Container -->
                        <div class="relative bg-slate-50 p-6 sm:p-8 rounded-2xl border-l-4 border-primary">
                            <div 
                                class="prose prose-slate text-base leading-relaxed text-slate-700 font-['Plus_Jakarta_Sans',sans-serif]" 
                                v-html="props.about_founder_bio"
                            ></div>
                        </div>

                        <div class="pt-2 flex flex-wrap gap-4 items-center">
                            <Link 
                                :href="route('contact')" 
                                class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white font-extrabold text-sm px-6 py-3 rounded-full transition-all shadow-md hover:shadow-lg"
                            >
                                {{ $t('aboutPage.contactTeam') || 'Contact Our Team' }}
                            </Link>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Clinical Specialists Section (Pattern 2 Team Cards) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="text-xs font-extrabold text-primary uppercase tracking-widest bg-sky-50 px-3.5 py-1.5 rounded-full border border-sky-100">
                    {{ $t('aboutPage.clinicalLeadershipBadge') || 'Clinical Leadership' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight font-['Outfit',sans-serif]">
                    {{ $t('aboutPage.clinicalLeadershipTitle') || 'World-Class Ophthalmologists & Surgeons' }}
                </h2>
                <p class="mt-3 text-slate-600 text-sm sm:text-base">
                    {{ $t('aboutPage.clinicalLeadershipSubtitle') || 'Our team of internationally trained consultants and ophthalmology specialists provide expert diagnostics and surgical care.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <TeamCard
                    name="Dr. Senior Consultant"
                    title="Vitreoretinal & Cataract Specialist"
                    specialty="Retina & Cataract"
                    qualifications="MBBS, FWACS, FICO, FRCOphth"
                    bio="Leading complex vitreoretinal surgeries, macular degeneration management, and micro-incision cataract procedures."
                    :appointment-url="route('contact')"
                    data-aos="fade-up"
                    data-aos-delay="100"
                />
                <TeamCard
                    name="Dr. Pediatric Ophthalmologist"
                    title="Pediatric Ophthalmology & Strabismus"
                    specialty="Pediatrics & Squint"
                    qualifications="MBBS, FMCOph, Fellowship Pediatric Ophthalmology"
                    bio="Specializing in pediatric eye diseases, childhood squint corrections, amblyopia management, and visual development."
                    :appointment-url="route('contact')"
                    data-aos="fade-up"
                    data-aos-delay="200"
                />
                <TeamCard
                    name="Dr. Glaucoma & Cornea Specialist"
                    title="Glaucoma & Anterior Segment Consultant"
                    specialty="Glaucoma & Cornea"
                    qualifications="MBBS, FWACS, Fellowship Glaucoma Surgery"
                    bio="Expertise in advanced glaucoma laser therapies, trabeculectomy, corneal collagen cross-linking, and refractive evaluations."
                    :appointment-url="route('contact')"
                    data-aos="fade-up"
                    data-aos-delay="300"
                />
            </div>
        </div>

        <!-- Hospital Info & visiting Hours -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 md:pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Hospital Image Card -->
                <div class="relative rounded-3xl overflow-hidden shadow-xl h-96 border border-gray-100">
                    <img :src="AboutHospitalImg" alt="Makkah Specialist Eye Hospital Facility" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-sky-300">Ibadan Centre</span>
                        <h3 class="text-2xl font-bold font-['Outfit',sans-serif]">State-of-the-Art Ophthalmic Facility</h3>
                    </div>
                </div>

                <!-- Visiting Hours & Patient Information -->
                <div class="space-y-6">
                    <h2 class="text-3xl font-extrabold text-slate-900 font-['Outfit',sans-serif]">
                        {{ $t('aboutPage.visitingTitle') }}
                    </h2>
                    <div class="text-slate-600 space-y-4 font-['Plus_Jakarta_Sans',sans-serif]">
                        <p class="text-base bg-white p-4 rounded-2xl border border-gray-100">
                            <strong class="text-slate-900">{{ $t('aboutPage.visitingHours') }}:</strong> <br>
                            • {{ $t('aboutPage.monFri') }}<br>
                            • {{ $t('aboutPage.sat') }}<br>
                            • {{ $t('aboutPage.sun') }}<br>
                            • <span class="text-primary font-bold">{{ $t('aboutPage.emergency') }}</span>
                        </p>
                        <p class="text-sm bg-white p-4 rounded-2xl border border-gray-100">
                            <strong class="text-slate-900">{{ $t('aboutPage.insuranceTitle') }}:</strong> {{ $t('aboutPage.insuranceDesc') }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <CallToAction />
    </div>
</template>
