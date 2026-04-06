<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    stats: Object
})
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Dashboard Overview" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Welcome to Makkah Eye Hospital Panel</h1>
            <p class="text-sm text-gray-500 mt-1 dark:text-gray-400">Here is a quick overview of your patient appointments.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <!-- Total -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Total Appointments</h3>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ stats?.total || 0 }}</p>
            </div>
            
            <!-- Pending -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Pending</h3>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ stats?.pending || 0 }}</p>
            </div>

            <!-- Confirmed -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Confirmed</h3>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ stats?.confirmed || 0 }}</p>
            </div>

            <!-- Cancelled -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border-l-4 border-red-500">
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Cancelled</h3>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ stats?.cancelled || 0 }}</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
