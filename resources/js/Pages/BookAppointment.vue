<script setup>
import { useForm, usePage, Head, Link } from '@inertiajs/vue3'
import TextInput from '@/Components/Forms/TextInput.vue'
import { useToast } from 'vue-toastification'

const toast = useToast()

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    dob: '',
    appointment_date: '',
    appointment_time: '',
    service_needed: 'Routine Eye Exam',
    is_existing_patient: false,
    file_number: '',
    notes: ''
})

const submitAppointment = () => {
    form.post(route('appointments.store'), {
        preserveScroll: true,
        onSuccess: () => {
            // We do NOT reset form here so we can show the details in the success screen if needed
            // The template handles switching state via checking if the flash has `success_tracking`
        },
        onError: () => {
            toast.error('Please check the form for errors.')
        }
    })
}
</script>

<template>
    <Head title="Book Appointment" />

    <!-- Disabled State -->
    <div v-if="!$page.props.settings?.enable_appointments" class="min-h-screen py-16 px-4 bg-slate-50/70 mt-8 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white rounded-3xl shadow-xl p-8 sm:p-12 text-center border border-gray-100" data-aos="fade-up" data-aos-duration="800">
            <div class="w-20 h-20 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xs">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-black text-slate-900 mb-3 font-['Outfit',sans-serif]">Online Booking Paused</h2>
            <p class="text-slate-600 mb-6 max-w-md mx-auto leading-relaxed">
                We are currently restructuring our scheduling system. Online appointment requests are temporarily unavailable.
            </p>
            <div class="bg-slate-50 rounded-2xl p-5 mb-8 border border-gray-100 text-left space-y-3">
                <h4 class="font-bold text-slate-900 text-sm">How to schedule your visit:</h4>
                <p class="text-sm text-slate-600 flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call us directly at: <span class="font-bold text-slate-900">{{ $page.props.support?.phone_formatted || '(+234) 916 666 1264' }}</span>
                </p>
                <p class="text-sm text-slate-600 flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Email us at: <span class="font-bold text-slate-900">{{ $page.props.support?.email || 'makkah.ibadan@albasar.com' }}</span>
                </p>
            </div>
            <Link :href="route('contact')" class="inline-flex items-center gap-2 bg-primary hover:bg-[#0880cc] text-white font-extrabold px-8 py-3.5 rounded-full shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                Go to Contact Page
            </Link>
        </div>
    </div>

    <!-- Active State -->
    <div v-else class="min-h-screen py-16 px-4 bg-slate-50/70 mt-8">
        <div class="max-w-3xl md:max-w-4xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-shadow duration-300" data-aos="fade-up" data-aos-duration="800">
            <div class="bg-gradient-to-r from-primary to-[#06465C] text-white p-8 md:p-10 text-center" v-show="!$page.props.flash.success_tracking">
                <div class="inline-flex items-center space-x-2 bg-white/10 text-white font-extrabold text-xs px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-3 border border-white/20">
                    <span>{{ $t('hero.bookAppointment') || 'Appointment Booking' }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-black font-['Outfit',sans-serif]">Request an Appointment</h1>
                <p class="mt-2 text-white/90 text-sm sm:text-base">Schedule your visit with our world-class ophthalmic specialists.</p>
            </div>
            
            <div class="p-6 md:p-10" v-if="$page.props.flash.success_tracking">
                <div class="text-center py-8">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6 shadow-sm animate-bounce">
                        <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 font-['Outfit',sans-serif]">Appointment Request Received!</h3>
                    <p class="text-slate-600 mt-2 max-w-md mx-auto">
                        Thank you for booking with us. Your tracking code is:
                    </p>
                    <div class="mt-4 p-4 bg-sky-50 rounded-2xl border border-sky-200 inline-block font-mono text-2xl font-bold text-primary shadow-xs tracking-wider">
                        {{ $page.props.flash.success_tracking }}
                    </div>
                    <p class="text-xs text-slate-500 mt-4 max-w-sm mx-auto">
                        Please save this tracking code to check your appointment status anytime.
                    </p>
                    <div class="mt-8 flex justify-center gap-4">
                        <Link :href="route('home')" class="bg-primary hover:bg-[#0880cc] text-white font-extrabold py-3 px-8 rounded-full shadow-md hover:shadow-lg transition-all duration-300">
                            Return to Home
                        </Link>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-10" v-else>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <TextInput name="first_name" label="First Name" v-model="form.first_name" type="text" placeholder="Ali" :message="form.errors.first_name" required />
                        <TextInput name="last_name" label="Last Name" v-model="form.last_name" type="text" placeholder="Ahmed" :message="form.errors.last_name" required />
                        <TextInput name="email" label="Email Address" v-model="form.email" type="email" placeholder="ali@email.com" :message="form.errors.email" required />
                        <TextInput name="phone" label="Phone Number" v-model="form.phone" type="text" placeholder="+234 800 123 456" :message="form.errors.phone" required />
                        
                        <!-- Details -->
                        <TextInput name="dob" label="Date of Birth" v-model="form.dob" type="date" :message="form.errors.dob" required />
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Service Needed</label>
                            <select v-model="form.service_needed" class="w-full border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/45 rounded-xl shadow-xs py-3 px-4">
                                <option>Routine Eye Exam</option>
                                <option>Cataract Consultation</option>
                                <option>Glaucoma Management</option>
                                <option>Pediatric Eye Care</option>
                                <option>Retinal Consultation</option>
                                <option>Diabetic Retinopathy Screening</option>
                            </select>
                            <div v-if="form.errors.service_needed" class="text-red-500 text-xs mt-1">{{ form.errors.service_needed }}</div>
                        </div>

                        <!-- Date and Time -->
                        <TextInput name="appointment_date" label="Preferred Date" v-model="form.appointment_date" type="date" :message="form.errors.appointment_date" required />
                        <TextInput name="appointment_time" label="Preferred Time" v-model="form.appointment_time" type="time" :message="form.errors.appointment_time" required />
                    </div>

                    <!-- Additional Details -->
                    <div class="mt-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" v-model="form.is_existing_patient" class="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4" />
                            <span class="text-sm text-slate-700 font-semibold">I am an existing patient</span>
                        </label>
                    </div>

                    <!-- File Number Field if existing patient -->
                    <div class="mt-4" v-if="form.is_existing_patient">
                        <TextInput name="file_number" label="File Number" v-model="form.file_number" type="text" placeholder="Enter your hospital file number" :message="form.errors.file_number" required />
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-bold text-slate-700 mb-1">Any symptoms or notes?</label>
                        <textarea v-model="form.notes" rows="4" class="w-full border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/45 rounded-xl shadow-xs p-4" placeholder="Please briefly describe your reason for visit..."></textarea>
                        <div v-if="form.errors.notes" class="text-red-500 text-xs mt-1">{{ form.errors.notes }}</div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-[#0880cc] text-white font-extrabold py-3.5 px-10 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer" :disabled="form.processing">
                            <span v-if="form.processing">Submitting...</span>
                            <span v-else>Confirm Request</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
