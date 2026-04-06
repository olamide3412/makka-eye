<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    appointment: Object
})

const updateStatus = (status) => {
    router.put(route('appointments.update', props.appointment.id), { status }, { preserveScroll: true });
}

// Quick helper to format date
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString(undefined, {
        year: 'numeric', month: 'long', day: 'numeric'
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="`Appointment: ${appointment.tracking_number}`" />

        <div class="container mx-auto p-4 md:p-8 mt-4 max-w-4xl">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <Link :href="route('appointments.index')" class="text-gray-500 hover:text-primary transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </Link>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Appointment Details</h2>
                </div>

                <span class="px-4 py-1.5 rounded-full text-sm font-bold uppercase tracking-wider"
                      :class="{
                          'bg-yellow-100 text-yellow-800': appointment.status === 'pending',
                          'bg-green-100 text-green-800': appointment.status === 'confirmed',
                          'bg-blue-100 text-blue-800': appointment.status === 'completed',
                          'bg-red-100 text-red-800': appointment.status === 'cancelled'
                      }">
                    {{ appointment.status }}
                </span>
            </div>

            <div class="bg-white dark:bg-slate-800 shadow-xl rounded-xl overflow-hidden">
                <!-- Status Actions Bar -->
                <div class="bg-gray-50 dark:bg-slate-700/50 p-4 border-b border-gray-100 dark:border-gray-700 flex flex-wrap items-center gap-4 justify-between">
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        <span class="font-medium">Tracking #:</span> <span class="font-mono text-primary">{{ appointment.tracking_number }}</span>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Change Status:</span>
                        <div class="flex border border-gray-200 dark:border-gray-600 rounded-lg overflow-hidden">
                            <button @click="updateStatus('pending')" :class="appointment.status === 'pending' ? 'bg-yellow-100 text-yellow-800 font-bold' : 'bg-white dark:bg-slate-800 hover:bg-gray-50 text-gray-600 dark:text-gray-300'" class="px-3 py-1.5 text-xs transition-colors border-r border-gray-200 dark:border-gray-600">Pending</button>
                            <button @click="updateStatus('confirmed')" :class="appointment.status === 'confirmed' ? 'bg-green-100 text-green-800 font-bold' : 'bg-white dark:bg-slate-800 hover:bg-gray-50 text-gray-600 dark:text-gray-300'" class="px-3 py-1.5 text-xs transition-colors border-r border-gray-200 dark:border-gray-600">Confirm</button>
                            <button @click="updateStatus('completed')" :class="appointment.status === 'completed' ? 'bg-blue-100 text-blue-800 font-bold' : 'bg-white dark:bg-slate-800 hover:bg-gray-50 text-gray-600 dark:text-gray-300'" class="px-3 py-1.5 text-xs transition-colors border-r border-gray-200 dark:border-gray-600">Complete</button>
                            <button @click="updateStatus('cancelled')" :class="appointment.status === 'cancelled' ? 'bg-red-100 text-red-800 font-bold' : 'bg-white dark:bg-slate-800 hover:bg-gray-50 text-gray-600 dark:text-gray-300'" class="px-3 py-1.5 text-xs transition-colors">Cancel</button>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 line-height-relaxed">
                        
                        <!-- Client Contact info -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-100 dark:border-gray-700">Patient Profile</h3>
                            
                            <dl class="space-y-3 text-sm">
                                <div class="grid grid-cols-3">
                                    <dt class="text-gray-500 font-medium">Full Name:</dt>
                                    <dd class="col-span-2 text-gray-900 dark:text-gray-100">{{ appointment.first_name }} {{ appointment.last_name }}</dd>
                                </div>
                                <div class="grid grid-cols-3">
                                    <dt class="text-gray-500 font-medium">Date of Birth:</dt>
                                    <dd class="col-span-2 text-gray-900 dark:text-gray-100">{{ formatDate(appointment.dob) }}</dd>
                                </div>
                                <div class="grid grid-cols-3">
                                    <dt class="text-gray-500 font-medium">Email:</dt>
                                    <dd class="col-span-2 text-gray-900 dark:text-gray-100"><a :href="`mailto:${appointment.email}`" class="text-primary hover:underline">{{ appointment.email }}</a></dd>
                                </div>
                                <div class="grid grid-cols-3">
                                    <dt class="text-gray-500 font-medium">Phone:</dt>
                                    <dd class="col-span-2 text-gray-900 dark:text-gray-100">{{ appointment.phone }}</dd>
                                </div>
                                
                                <div v-if="appointment.is_existing_patient" class="pt-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400 text-xs font-semibold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Existing Patient
                                    </span>
                                    <div class="mt-2 text-indigo-800 dark:text-indigo-300 text-sm font-medium border-l-2 border-indigo-500 pl-3">
                                        Hospital File Number: {{ appointment.file_number }}
                                    </div>
                                </div>
                            </dl>
                        </div>

                        <!-- Appointment Info -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-100 dark:border-gray-700">Service Info</h3>
                            
                            <dl class="space-y-3 text-sm">
                                <div class="grid grid-cols-3">
                                    <dt class="text-gray-500 font-medium">Service:</dt>
                                    <dd class="col-span-2 text-gray-900 dark:text-gray-100 font-semibold">{{ appointment.service_needed }}</dd>
                                </div>
                                <div class="grid grid-cols-3">
                                    <dt class="text-gray-500 font-medium">Scheduled:</dt>
                                    <dd class="col-span-2 text-gray-900 dark:text-gray-100">{{ formatDate(appointment.appointment_date) }} at {{ appointment.appointment_time }}</dd>
                                </div>
                                <div class="grid grid-cols-3">
                                    <dt class="text-gray-500 font-medium">Booked On:</dt>
                                    <dd class="col-span-2 text-gray-900 dark:text-gray-100">{{ formatDate(appointment.created_at) }}</dd>
                                </div>
                            </dl>
                            
                            <div class="mt-6 bg-gray-50 dark:bg-slate-700 rounded-lg p-4">
                                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">Patient Notes & Symptoms</h4>
                                <p v-if="appointment.notes" class="text-sm text-gray-600 dark:text-gray-400 italic">"{{ appointment.notes }}"</p>
                                <p v-else class="text-sm text-gray-400 dark:text-gray-500 italic">No additional notes provided.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </AuthenticatedLayout>
</template>
