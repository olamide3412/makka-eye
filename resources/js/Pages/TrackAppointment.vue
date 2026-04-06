<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import TextInput from '@/Components/Forms/TextInput.vue'

defineProps({
    appointment: Object,
    searched: Boolean,
    flash: Object
})

const form = useForm({
    tracking_number: ''
})

const track = () => {
    form.get(route('track-appointment'), {
        preserveState: true
    })
}

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString(undefined, {
        year: 'numeric', month: 'long', day: 'numeric'
    });
}
</script>

<template>
    <Head title="Track Appointment" />

    <div class="min-h-screen py-16 px-4 bg-gray-50 dark:bg-gray-900 mt-8">
        <div class="max-w-xl mx-auto" data-aos="fade-up">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Track Your Appointment</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Enter your tracking number below to check the status of your booking.</p>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 md:p-8">
                <form @submit.prevent="track">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <TextInput 
                                name="tracking_number" 
                                v-model="form.tracking_number" 
                                type="text" 
                                placeholder="e.g. MEH-A8X9-2026" 
                                required
                            />
                        </div>
                        <button 
                            type="submit" 
                            class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-6 rounded-md shadow transition-colors"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Searching...</span>
                            <span v-else>Track</span>
                        </button>
                    </div>
                </form>

                <!-- Error Message -->
                <div v-if="flash?.error" class="mt-4 p-4 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg text-sm font-medium text-center">
                    {{ flash.error }}
                </div>

                <!-- Results Area -->
                <div v-if="searched && appointment" class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-6 animate-fade-in-up">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Appointment Details</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                              :class="{
                                  'bg-yellow-100 text-yellow-800': appointment.status === 'pending',
                                  'bg-green-100 text-green-800': appointment.status === 'confirmed',
                                  'bg-blue-100 text-blue-800': appointment.status === 'completed',
                                  'bg-red-100 text-red-800': appointment.status === 'cancelled'
                              }">
                            {{ appointment.status }}
                        </span>
                    </div>

                    <div class="space-y-4 text-sm">
                        <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg">
                            <p class="text-gray-500 dark:text-gray-400">Patient Name</p>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ appointment.first_name }} {{ appointment.last_name }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg">
                            <p class="text-gray-500 dark:text-gray-400">Scheduled Service</p>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ appointment.service_needed }}</p>
                        </div>

                        <div class="flex gap-4">
                            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg flex-1">
                                <p class="text-gray-500 dark:text-gray-400">Date</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ formatDate(appointment.appointment_date) }}</p>
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg flex-1">
                                <p class="text-gray-500 dark:text-gray-400">Time</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ appointment.appointment_time }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-fade-in-up {
    animation: fadeInUp 0.5s ease-out;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
