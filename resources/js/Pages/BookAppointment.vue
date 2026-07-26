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
    <div v-if="!$page.props.settings?.enable_appointments" class="min-h-screen py-12 px-4 bg-gray-50 dark:bg-gray-900 mt-8 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 text-center border border-gray-100 dark:border-gray-700" data-aos="fade-up">
            <div class="w-20 h-20 bg-amber-50 dark:bg-amber-950/20 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3" style="font-family: Georgia, serif;">Online Booking Paused</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">
                We are currently restructuring our scheduling system. Online appointment requests are temporarily unavailable.
            </p>
            <div class="bg-gray-50 dark:bg-slate-900/50 rounded-xl p-5 mb-8 border border-gray-100 dark:border-gray-800 text-left space-y-3">
                <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm">How to schedule your visit:</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call us directly at: <span class="font-semibold text-gray-900 dark:text-white">{{ $page.props.support?.phone_formatted || '+234 806695 0049' }}</span>
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Email us at: <span class="font-semibold text-gray-900 dark:text-white">{{ $page.props.support?.email || 'support@texasloan.ng' }}</span>
                </p>
            </div>
            <Link :href="route('contact')" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-full shadow-md hover:shadow-lg transition-all duration-300">
                Go to Contact Page
            </Link>
        </div>
    </div>

    <!-- Active State -->
    <div v-else class="min-h-screen py-12 px-4 bg-gray-50 dark:bg-gray-900 mt-8">
        <div class="max-w-3xl md:max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-xl shadow-xl overflow-hidden" data-aos="fade-up">
            <div class="bg-primary text-white p-6 md:p-8 text-center" v-show="!$page.props.flash.success_tracking">
                <h1 class="text-3xl font-bold">Request an Appointment</h1>
                <p class="mt-2 opacity-90">Schedule your visit with our world-class specialists.</p>
            </div>
            
            <div class="p-6 md:p-8" v-if="$page.props.flash.success_tracking">
                <div class="text-center py-8">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
                        <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Appointment Requested!</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">We have received your appointment request and will review it shortly. Please save your tracking number below.</p>
                    
                    <div class="bg-gray-100 dark:bg-slate-700 rounded-xl p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 inline-block">
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-1">Your Tracking Number</p>
                        <p class="text-4xl font-black text-primary dark:text-primary-light select-all">{{ $page.props.flash.success_tracking }}</p>
                    </div>

                    <div class="mt-8">
                        <p class="text-sm text-gray-500 mb-4">You must securely copy or take a screenshot of your tracking number.</p>
                        <a :href="route('track-appointment')" class="inline-block bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full shadow transition-colors">
                            Track My Appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8" v-else>
                <form @submit.prevent="submitAppointment" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Info -->
                        <TextInput name="first_name" label="First Name" v-model="form.first_name" type="text" placeholder="Ali" :message="form.errors.first_name" required autofocus />
                        <TextInput name="last_name" label="Last Name" v-model="form.last_name" type="text" placeholder="Ahmed" :message="form.errors.last_name" required />
                        <TextInput name="email" label="Email Address" v-model="form.email" type="email" placeholder="ali@email.com" :message="form.errors.email" required />
                        <TextInput name="phone" label="Phone Number" v-model="form.phone" type="text" placeholder="+234 800 123 456" :message="form.errors.phone" required />
                        
                        <!-- Details -->
                        <TextInput name="dob" label="Date of Birth" v-model="form.dob" type="date" :message="form.errors.dob" required />
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Service Needed</label>
                            <select v-model="form.service_needed" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm">
                                <option>Routine Eye Exam</option>
                                <option>Cataract Consultation</option>
                                <option>LASIK Assessment</option>
                                <option>Glaucoma Management</option>
                                <option>Pediatric Eye Care</option>
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
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" v-model="form.is_existing_patient" class="rounded border-gray-300 text-primary focus:ring-primary" />
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">I am an existing patient</span>
                        </label>
                    </div>

                    <!-- File Number Field if existing patient -->
                    <div class="mt-4" v-if="form.is_existing_patient">
                        <TextInput name="file_number" label="File Number" v-model="form.file_number" type="text" placeholder="Enter your hospital file number" :message="form.errors.file_number" required />
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Any symptoms or notes?</label>
                        <textarea v-model="form.notes" rows="4" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" placeholder="Please briefly describe your reason for visit..."></textarea>
                        <div v-if="form.errors.notes" class="text-red-500 text-xs mt-1">{{ form.errors.notes }}</div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full shadow-lg transition-transform transform hover:scale-105" :disabled="form.processing">
                            <span v-if="form.processing">Submitting...</span>
                            <span v-else>Confirm Request</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
