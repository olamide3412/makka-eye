<script setup>
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const isSidebarOpen = ref(true)

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value
}
</script>

<template>
    <div class="flex h-screen bg-gray-100 dark:bg-slate-900 font-sans">
        
        <!-- Sidebar -->
        <aside 
            :class="[
                'bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 shadow-xl transition-all duration-300 ease-in-out z-20 flex flex-col',
                isSidebarOpen ? 'w-64' : 'w-20'
            ]"
        >
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 border-b border-gray-100 dark:border-gray-700 px-4">
                <div class="flex items-center" v-if="isSidebarOpen">
                    <span class="text-lg font-bold text-primary dark:text-gray-100 truncate">Administration</span>
                </div>
                <div v-else class="mx-auto">
                    <span class="text-xl font-bold text-primary dark:text-white">A</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-2">
                    
                    <!-- Dashboard Link -->
                    <li>
                        <Link 
                            :href="route('dashboard')" 
                            class="flex items-center px-4 py-3 mx-2 rounded-lg transition-colors"
                            :class="{'bg-primary text-white': $page.url === '/dashboard', 'hover:bg-gray-100 dark:hover:bg-slate-700': $page.url !== '/dashboard'}"
                            title="Dashboard"
                        >
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span class="ml-3 font-medium transition-opacity duration-300" v-show="isSidebarOpen">Dashboard</span>
                        </Link>
                    </li>

                    <!-- Appointments Link -->
                    <li>
                        <Link 
                            :href="route('appointments.index')" 
                            class="flex items-center px-4 py-3 mx-2 rounded-lg transition-colors"
                            :class="{'bg-primary text-white': $page.url.startsWith('/appointments'), 'hover:bg-gray-100 dark:hover:bg-slate-700': !$page.url.startsWith('/appointments')}"
                            title="Appointments"
                        >
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="ml-3 font-medium transition-opacity duration-300" v-show="isSidebarOpen">Appointments</span>
                        </Link>
                    </li>

                </ul>
            </div>

            <!-- Profile & Logout (Bottom pinned) -->
            <div class="border-t border-gray-100 dark:border-gray-700 p-4">
                <Link 
                    :href="route('logout')" 
                    method="post" 
                    as="button"
                    class="flex items-center w-full px-2 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                    title="Logout"
                >
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="ml-3 font-medium transition-opacity duration-300 text-left" v-show="isSidebarOpen">Logout</span>
                </Link>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Topbar Content Header -->
            <header class="h-16 bg-white dark:bg-slate-800 shadow-sm flex items-center px-4 justify-between border-b border-gray-100 dark:border-gray-700">
                <button 
                    @click="toggleSidebar" 
                    class="p-2 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-slate-700 focus:outline-none focus:ring transition-colors"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>

                <!-- Currently logged in User display -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $page.props.auth?.user?.name || $page.props.auth?.user?.email }}</span>
                    <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-white font-bold">
                        {{ ($page.props.auth?.user?.name || $page.props.auth?.user?.email || 'A')[0].toUpperCase() }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-slate-900 p-4 md:p-6">
                <slot />
            </main>
        </div>
        
    </div>
</template>
