<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue';
import { ReviewCard } from '@/Components/Cards';

const props = defineProps({
    testimonials: Object,
});

const showForm = ref(false);
const submitted = ref(false);
const hoverRating = ref(0);

const form = useForm({
    name: '',
    occupation: '',
    rating: 5,
    message: '',
});

const submit = () => {
    form.post(route('testimonials.store'), {
        onSuccess: () => {
            form.reset();
            showForm.value = false;
            submitted.value = true;
        },
    });
};

const starLabel = (n) => ['Terrible', 'Poor', 'Average', 'Good', 'Excellent'][n - 1];

const formatDate = (d) => d ? new Date(d).toLocaleDateString('en-GB', { month: 'short', year: 'numeric' }) : '';
</script>

<template>
    <div class="bg-slate-50 min-h-screen">
        <Head :title="($t('testimonials.title') || 'Testimonials') + ' | Makkah Specialist Eye Hospital'">
            <meta name="description" content="Read what our patients say about their experience at Makkah Specialist Eye Hospital. Share your own story with us." />
        </Head>

        <!-- Page Hero Banner (Moorfields Style) -->
        <PageHeroBanner 
            :title="$t('testimonials.title') || 'Patient Stories'"
            :badge="$t('testimonials.badge')"
            :breadcrumbs="[
                { label: $t('nav.home') || 'Home', href: route('home') },
                { label: $t('testimonials.title') || 'Testimonials' }
            ]"
        />

        <!-- Action Bar / Subtitle -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 bg-white p-6 sm:p-8 rounded-3xl border border-gray-100 shadow-sm" data-aos="fade-up" data-aos-duration="800">
                <div>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 font-['Outfit',sans-serif]">{{ $t('testimonials.title') }}</h3>
                    <p class="text-slate-600 mt-1 text-sm sm:text-base leading-relaxed max-w-2xl">{{ $t('testimonials.subtitle') }}</p>
                </div>

                <!-- CTA to share testimony -->
                <button v-if="!showForm && !submitted" @click="showForm = true"
                    class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-[#0880cc] text-white font-extrabold px-8 py-3.5 rounded-full shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 cursor-pointer shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    {{ $t('testimonials.writeReview') }}
                </button>
            </div>
        </div>

        <!-- Submission Success -->
        <div v-if="submitted" class="max-w-2xl mx-auto px-4 py-6" data-aos="fade-up">
            <div class="bg-green-50 border border-green-200 rounded-3xl p-8 text-center shadow-sm">
                <svg class="w-12 h-12 text-green-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <h3 class="text-xl font-bold text-green-800 mb-1">{{ $t('testimonials.submittedTitle') }}</h3>
                <p class="text-green-700">{{ $t('testimonials.submittedMessage') }}</p>
            </div>
        </div>

        <!-- Submission Form -->
        <section v-if="showForm" class="py-12 bg-white border-b border-gray-100" data-aos="fade-up" data-aos-duration="800">
            <div class="max-w-2xl mx-auto px-4">
                <div class="bg-slate-50/80 rounded-3xl p-8 sm:p-10 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-black text-slate-900 font-['Outfit',sans-serif]">{{ $t('testimonials.formTitle') }}</h2>
                        <button @click="showForm = false" class="text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-full hover:bg-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
 
                    <form @submit.prevent="submit" class="space-y-5">
                        <!-- Name & Occupation -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('testimonials.yourName') }} *</label>
                                <input v-model="form.name" type="text" placeholder="Ahmed Al-Rashid" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-primary/40 focus:border-primary border-gray-200 transition-all text-sm" />
                                <span v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</span>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('testimonials.yourOccupation') }}</label>
                                <input v-model="form.occupation" type="text" placeholder="e.g. Teacher, Engineer..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-primary/40 focus:border-primary border-gray-200 transition-all text-sm" />
                            </div>
                        </div>
 
                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">{{ $t('testimonials.yourRating') }} *</label>
                            <div class="flex items-center gap-1.5">
                                <button v-for="n in 5" :key="n" type="button"
                                    @click="form.rating = n"
                                    @mouseenter="hoverRating = n"
                                    @mouseleave="hoverRating = 0"
                                    class="transition-transform hover:scale-125 cursor-pointer">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                        :class="n <= (hoverRating || form.rating) ? 'text-amber-400' : 'text-gray-200'">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </button>
                                <span class="ml-3 text-sm font-bold text-slate-600">{{ $t('testimonials.ratings.' + (hoverRating || form.rating)) }}</span>
                            </div>
                        </div>
 
                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('testimonials.yourTestimony') }} *</label>
                            <textarea v-model="form.message" rows="5" required :placeholder="$t('testimonials.formPlaceholder')" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-primary/40 focus:border-primary border-gray-200 transition-all text-sm resize-none"></textarea>
                            <div class="flex justify-between mt-1">
                                <span v-if="form.errors.message" class="text-red-500 text-xs">{{ form.errors.message }}</span>
                                <span class="text-xs text-gray-400 ml-auto">{{ form.message.length }}/1000</span>
                            </div>
                        </div>
 
                        <p class="text-xs text-slate-500 bg-sky-50 rounded-xl p-3.5 border border-sky-100 leading-relaxed">
                            <svg class="w-4 h-4 inline mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $t('testimonials.formNotice') }}
                        </p>
 
                        <button type="submit" :disabled="form.processing"
                            class="w-full bg-primary hover:bg-[#0880cc] text-white font-extrabold px-6 py-3.5 rounded-full transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 disabled:opacity-60 flex items-center justify-center gap-2 cursor-pointer">
                            <svg v-if="form.processing" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            {{ form.processing ? $t('testimonials.submitting') : $t('testimonials.submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Testimonials Grid -->
        <section class="py-16 bg-slate-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Empty state -->
                <div v-if="!testimonials?.data?.length" class="flex flex-col items-center justify-center py-24 gap-4" data-aos="fade-up">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <p class="text-xl font-semibold text-gray-500">{{ $t('testimonials.noTestimonials') }}</p>
                    <p class="text-gray-400">{{ $t('testimonials.firstShare') }}</p>
                </div>

                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-duration="800">
                    <ReviewCard
                        v-for="(t, idx) in testimonials.data"
                        :key="t.id"
                        :name="t.name"
                        :text="t.message"
                        :rating="t.rating || 5"
                        :role="t.occupation || 'Patient'"
                        :date="formatDate(t.created_at)"
                        color-hover="#06465C"
                    />
                </div>

                <!-- Pagination -->
                <div v-if="testimonials?.links?.length > 3" class="flex justify-center mt-12 gap-2">
                    <template v-for="link in testimonials.links" :key="link.label">
                        <Link v-if="link.url" :href="link.url" preserve-scroll
                            :class="['px-4 py-2 rounded-lg text-sm font-medium transition-colors border', link.active ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary']"
                            v-html="link.label" />
                    </template>
                </div>
            </div>
        </section>
    </div>
</template>
