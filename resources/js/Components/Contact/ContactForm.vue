<script setup>
import { useForm } from '@inertiajs/vue3';

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
    alert('Thank you for contacting us! We will get back to you shortly.');
};
</script>

<template>
    <div class="bg-white dark:bg-gray-800 py-16 px-4 overflow-hidden sm:px-6 lg:px-8 lg:py-24">
        <div class="relative max-w-xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Get in Touch
                </h2>
                <p class="mt-4 text-lg leading-6 text-gray-500 dark:text-gray-300">
                    Need to schedule an appointment or have a general medical inquiry? Our team is ready to assist you.
                </p>
            </div>
            <div class="mt-12">
                <form @submit.prevent="submit" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full name</label>
                        <div class="mt-1">
                            <input v-model="form.name" type="text" name="name" id="name" autocomplete="name" class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email address</label>
                        <div class="mt-1">
                            <input v-model="form.email" type="email" name="email" id="email" autocomplete="email" class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone number</label>
                        <div class="mt-1">
                            <input v-model="form.phone" type="text" name="phone" id="phone" autocomplete="tel" class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="service" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service needed</label>
                        <div class="mt-1">
                            <select v-model="form.service" id="service" name="service" class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option disabled value="">Select an inquiry type</option>
                                <option>Schedule Appointment</option>
                                <option>General Inquiry</option>
                                <option>Billing & Insurance</option>
                                <option>Emergency Service Info</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                        <div class="mt-1">
                            <textarea v-model="form.message" id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
             <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2">
                 <div class="text-center">
                     <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Emergency & Appointments</h3>
                     <p class="mt-2 text-base text-gray-500 dark:text-gray-300">+234 916 666 1264</p>
                 </div>
                 <div class="text-center">
                     <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">General Inquiries</h3>
                     <p class="mt-2 text-base text-gray-500 dark:text-gray-300">makkah.ibadan@albasar.com</p>
                 </div>
                 
             </div>
        </div>
    </div>
</template>
