<script setup>
import { useForm } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const form = useForm({
    name: '',
    email: '',
    phone: '',
    service: '',
    message: '',
});

const submit = () => {
    // In a real application, submit to a backend route
    console.log('Form submitted:', form);
    form.reset();
    alert(t('contactForm.successAlert'));
};
</script>

<template>
    <div class="bg-gradient-to-b from-slate-50/70 via-white to-slate-50/50 py-16 px-4 sm:px-6 lg:px-8 lg:py-24">
        <div class="relative max-w-2xl mx-auto">
            <!-- Heading -->
            <div class="text-center" data-aos="fade-up" data-aos-duration="800">
                <div class="inline-flex items-center space-x-2 bg-sky-50 text-primary font-extrabold text-xs px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-4 border border-sky-100 shadow-xs">
                    <span>{{ $t('hero.contactUs') || 'Contact Us' }}</span>
                </div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl font-['Outfit',sans-serif]">
                    {{ $t('contactForm.title') }}
                </h2>
                <p class="mt-4 text-base sm:text-lg leading-relaxed text-slate-600 max-w-xl mx-auto">
                    {{ $t('contactForm.subtitle') }}
                </p>
            </div>

            <!-- Form Card -->
            <div class="mt-12 bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300" data-aos="fade-up" data-aos-duration="900" data-aos-delay="100">
                <form @submit.prevent="submit" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('contactForm.labels.name') }}</label>
                        <div>
                            <input v-model="form.name" type="text" name="name" id="name" autocomplete="name" class="py-3 px-4 block w-full shadow-xs focus:ring-2 focus:ring-primary/45 focus:border-primary border-gray-200 rounded-xl transition-all" required>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('contactForm.labels.email') }}</label>
                        <div>
                            <input v-model="form.email" type="email" name="email" id="email" autocomplete="email" class="py-3 px-4 block w-full shadow-xs focus:ring-2 focus:ring-primary/45 focus:border-primary border-gray-200 rounded-xl transition-all" required>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone" class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('contactForm.labels.phone') }}</label>
                        <div>
                            <input v-model="form.phone" type="text" name="phone" id="phone" autocomplete="tel" class="py-3 px-4 block w-full shadow-xs focus:ring-2 focus:ring-primary/45 focus:border-primary border-gray-200 rounded-xl transition-all">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="service" class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('contactForm.labels.service') }}</label>
                        <div>
                            <select v-model="form.service" id="service" name="service" class="py-3 px-4 block w-full shadow-xs focus:ring-2 focus:ring-primary/45 focus:border-primary border-gray-200 rounded-xl transition-all">
                                <option disabled value="">{{ $t('contactForm.selectInquiry') }}</option>
                                <option>{{ $t('contactForm.inquiries.appointment') }}</option>
                                <option>{{ $t('contactForm.inquiries.general') }}</option>
                                <option>{{ $t('contactForm.inquiries.billing') }}</option>
                                <option>{{ $t('contactForm.inquiries.emergency') }}</option>
                                <option>{{ $t('contactForm.inquiries.other') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-bold text-slate-700 mb-1.5">{{ $t('contactForm.labels.message') }}</label>
                        <div>
                            <textarea v-model="form.message" id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-xs focus:ring-2 focus:ring-primary/45 focus:border-primary border-gray-200 rounded-xl transition-all" required></textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-2 mt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-3.5 border border-transparent rounded-full shadow-md text-base font-extrabold text-white bg-primary hover:bg-[#0880cc] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                            {{ $t('contactForm.labels.send') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Hotline & Email Interactive Cards -->
            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <a href="tel:+2349166661264" class="group p-6 rounded-3xl bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:border-primary/30 hover:-translate-y-1 transition-all duration-300 text-center block">
                    <div class="w-12 h-12 rounded-2xl bg-sky-50 text-primary group-hover:bg-primary group-hover:text-white flex items-center justify-center mx-auto mb-3 transition-all duration-300 group-hover:scale-110 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-primary transition-colors font-['Outfit',sans-serif]">{{ $t('contactForm.emergencyTitle') }}</h3>
                    <p class="mt-1.5 text-sm font-semibold text-slate-600 group-hover:text-slate-800">(+234) 916 666 1264</p>
                </a>

                <a href="mailto:makkah.ibadan@albasar.com" class="group p-6 rounded-3xl bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:border-primary/30 hover:-translate-y-1 transition-all duration-300 text-center block">
                    <div class="w-12 h-12 rounded-2xl bg-sky-50 text-primary group-hover:bg-primary group-hover:text-white flex items-center justify-center mx-auto mb-3 transition-all duration-300 group-hover:scale-110 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-primary transition-colors font-['Outfit',sans-serif]">{{ $t('contactForm.generalTitle') }}</h3>
                    <p class="mt-1.5 text-sm font-semibold text-slate-600 group-hover:text-slate-800">makkah.ibadan@albasar.com</p>
                </a>
            </div>
        </div>
    </div>
</template>
