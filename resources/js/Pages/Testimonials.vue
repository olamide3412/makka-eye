<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

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
    <div>
        <Head title="Patient Testimonials | Makkah Specialist Eye Hospital">
            <meta name="description" content="Read what our patients say about their experience at Makkah Specialist Eye Hospital. Share your own story with us." />
        </Head>

        <!-- Hero -->
        <section class="bg-gradient-to-br from-primary/10 via-blue-50 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-20 pt-36 md:pt-44">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <span class="inline-block bg-primary/10 text-primary text-sm font-semibold px-4 py-1 rounded-full mb-4">Patient Stories</span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4" style="font-family: Georgia, serif;">What Our Patients Say</h1>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-8">Trusted by thousands of families across the region for compassionate eye care.</p>

                <!-- CTA to share testimony -->
                <button v-if="!showForm && !submitted" @click="showForm = true"
                    class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold px-8 py-3 rounded-full shadow-md hover:shadow-lg transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Share Your Experience
                </button>
            </div>
        </section>

        <!-- Submission Success -->
        <div v-if="submitted" class="max-w-2xl mx-auto px-4 py-6">
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-6 text-center">
                <svg class="w-12 h-12 text-green-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <h3 class="text-xl font-bold text-green-700 dark:text-green-400 mb-1">Thank You!</h3>
                <p class="text-green-600 dark:text-green-500">Your testimony has been submitted and is awaiting review. It will appear here once approved.</p>
            </div>
        </div>

        <!-- Submission Form -->
        <section v-if="showForm" class="py-12 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
            <div class="max-w-2xl mx-auto px-4">
                <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Share Your Story</h2>
                        <button @click="showForm = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <form @submit.prevent="submit" class="space-y-5">
                        <!-- Name & Occupation -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Your Name *</label>
                                <input v-model="form.name" type="text" placeholder="Ahmed Al-Rashid" required
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary/40 focus:outline-none text-sm" />
                                <span v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</span>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Occupation <span class="font-normal text-gray-400">(optional)</span></label>
                                <input v-model="form.occupation" type="text" placeholder="e.g. Teacher, Engineer..."
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary/40 focus:outline-none text-sm" />
                            </div>
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Your Rating *</label>
                            <div class="flex items-center gap-1">
                                <button v-for="n in 5" :key="n" type="button"
                                    @click="form.rating = n"
                                    @mouseenter="hoverRating = n"
                                    @mouseleave="hoverRating = 0"
                                    class="transition-transform hover:scale-110">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                        :class="n <= (hoverRating || form.rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </button>
                                <span class="ml-3 text-sm font-medium text-gray-600 dark:text-gray-400">{{ starLabel(hoverRating || form.rating) }}</span>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Your Experience *</label>
                            <textarea v-model="form.message" rows="5" required placeholder="Tell us about your experience at Makkah Specialist Eye Hospital..." class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary/40 focus:outline-none text-sm resize-none"></textarea>
                            <div class="flex justify-between mt-1">
                                <span v-if="form.errors.message" class="text-red-500 text-xs">{{ form.errors.message }}</span>
                                <span class="text-xs text-gray-400 ml-auto">{{ form.message.length }}/1000</span>
                            </div>
                        </div>

                        <p class="text-xs text-gray-400 dark:text-gray-500 bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 border border-blue-100 dark:border-blue-800">
                            <svg class="w-4 h-4 inline mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Your testimonial will be reviewed before being published. We may lightly edit for clarity.
                        </p>

                        <button type="submit" :disabled="form.processing"
                            class="w-full bg-primary hover:bg-primary/90 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg disabled:opacity-60 flex items-center justify-center gap-2">
                            <svg v-if="form.processing" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            {{ form.processing ? 'Submitting...' : 'Submit Testimonial' }}
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Testimonials Grid -->
        <section class="py-16 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4">
                <!-- Empty state -->
                <div v-if="!testimonials?.data?.length" class="flex flex-col items-center justify-center py-24 gap-4">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <p class="text-xl font-semibold text-gray-500 dark:text-gray-400">No testimonials yet</p>
                    <p class="text-gray-400">Be the first to share your experience!</p>
                </div>

                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="t in testimonials.data" :key="t.id"
                        class="bg-white dark:bg-gray-900 rounded-2xl p-7 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow relative flex flex-col">
                        <!-- Quote mark -->
                        <span class="absolute top-4 right-5 text-5xl text-primary/10 font-serif select-none leading-none">"</span>

                        <!-- Stars -->
                        <div class="flex gap-0.5 mb-4">
                            <svg v-for="n in 5" :key="n" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                :class="n <= t.rating ? 'text-yellow-400' : 'text-gray-200 dark:text-gray-700'">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>

                        <!-- Message -->
                        <p class="text-gray-600 dark:text-gray-300 italic text-sm leading-relaxed flex-1 mb-4">"{{ t.message }}"</p>

                        <!-- Author -->
                        <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-blue-400 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                {{ t.name[0].toUpperCase() }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm">{{ t.name }}</p>
                                <p v-if="t.occupation" class="text-xs text-gray-400">{{ t.occupation }}</p>
                                <p class="text-xs text-gray-400">{{ formatDate(t.created_at) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="testimonials?.links?.length > 3" class="flex justify-center mt-12 gap-2">
                    <template v-for="link in testimonials.links" :key="link.label">
                        <Link v-if="link.url" :href="link.url" preserve-scroll
                            :class="['px-4 py-2 rounded-lg text-sm font-medium transition-colors border', link.active ? 'bg-primary text-white border-primary' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-primary hover:text-primary']"
                            v-html="link.label" />
                    </template>
                </div>
            </div>
        </section>
    </div>
</template>
