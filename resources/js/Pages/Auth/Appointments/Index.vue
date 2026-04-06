<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { watch } from 'vue'

const props = defineProps({
    appointments: Array,
    filters: Object
})

const search = ref(props.filters?.search || '')

// Watch for search input to trigger backend search
let searchTimer = null
watch(search, (value) => {
    clearTimeout(searchTimer)
    searchTimer = setTimeout(() => {
        router.get(route('appointments.index'), { search: value }, { preserveState: true, preserveScroll: true, replace: true })
    }, 300)
})

// Quick helper to format date
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString();
}

const updateStatus = (appointment, status) => {
    router.put(route('appointments.update', appointment.id), { status }, { preserveScroll: true });
}

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Manage Appointments" />

    <div class="container mx-auto p-4 md:p-8 mt-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Patient Appointments</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Review and manage booking statuses below.</p>
            </div>
            <div class="w-full md:w-64">
                <input 
                    type="text" 
                    v-model="search" 
                    placeholder="Search name or tracking id..."
                    class="w-full px-4 py-2 bg-white dark:bg-slate-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-primary focus:border-primary text-gray-900 dark:text-white text-sm"
                />
            </div>
        </div>

        <!-- Desktop View Table -->
        <div class="bg-white dark:bg-slate-800 shadow rounded-lg overflow-hidden hidden md:block">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-slate-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Patient Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Schedule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr v-for="appointment in appointments" :key="appointment.id" class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ appointment.first_name }} {{ appointment.last_name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ appointment.email }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ appointment.phone }}</div>
                                    <div class="text-xs font-mono bg-gray-100 dark:bg-gray-700 inline-block px-1 mt-1 rounded">{{ appointment.tracking_number }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-white">{{ appointment.service_needed }}</div>
                            <div v-if="appointment.is_existing_patient" class="text-xs text-indigo-600 dark:text-indigo-400">
                                Existing Patient <span v-if="appointment.file_number">(#{{ appointment.file_number }})</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ formatDate(appointment.appointment_date) }}</div>
                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ appointment.appointment_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                  :class="{
                                      'bg-yellow-100 text-yellow-800': appointment.status === 'pending',
                                      'bg-green-100 text-green-800': appointment.status === 'confirmed',
                                      'bg-blue-100 text-blue-800': appointment.status === 'completed',
                                      'bg-red-100 text-red-800': appointment.status === 'cancelled'
                                  }">
                                {{ appointment.status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center gap-2">
                            <Link :href="route('appointments.show', appointment.id)" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 dark:bg-indigo-900/40 dark:text-indigo-300 dark:hover:bg-indigo-900/60 transition-colors rounded-md font-semibold text-xs border border-indigo-200 dark:border-indigo-800">
                                View
                            </Link>
                            <select @change="updateStatus(appointment, $event.target.value)" :value="appointment.status"
                                    class="text-sm border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-primary focus:ring-primary inline-block py-1">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirm</option>
                                <option value="completed">Complete</option>
                                <option value="cancelled">Cancel</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr v-if="appointments.length === 0">
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            No appointments found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Mobile View Cards -->
        <div class="md:hidden space-y-4">
            <div v-for="appointment in appointments" :key="appointment.id" class="bg-white dark:bg-slate-800 shadow rounded-lg p-4 border-l-4"
                 :class="{
                     'border-yellow-400': appointment.status === 'pending',
                     'border-green-400': appointment.status === 'confirmed',
                     'border-blue-400': appointment.status === 'completed',
                     'border-red-400': appointment.status === 'cancelled'
                 }">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="font-bold text-gray-900 dark:text-white">{{ appointment.first_name }} {{ appointment.last_name }}</div>
                        <div class="text-xs text-gray-500">{{ appointment.phone }}</div>
                    </div>
                    <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 uppercase font-semibold tracking-wider">
                        {{ appointment.status }}
                    </span>
                </div>
                <div class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    <strong>Service:</strong> {{ appointment.service_needed }}<br/>
                    <strong>Date & Time:</strong> {{ formatDate(appointment.appointment_date) }} at {{ appointment.appointment_time }}
                </div>
                <div class="pt-2 border-t border-gray-200 dark:border-gray-700 flex items-center gap-2 mt-3">
                     <Link :href="route('appointments.show', appointment.id)" class="flex-1 text-center py-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 dark:bg-indigo-900/40 dark:text-indigo-300 transition-colors rounded-md font-semibold text-xs border border-indigo-200 dark:border-indigo-800">
                        View Full Details
                     </Link>
                     <select @change="updateStatus(appointment, $event.target.value)" :value="appointment.status"
                            class="flex-1 text-sm border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 rounded-md py-1.5 focus:ring-primary">
                        <option value="pending">Mark Pending</option>
                        <option value="confirmed">Mark Confirmed</option>
                        <option value="completed">Mark Completed</option>
                        <option value="cancelled">Cancel</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
