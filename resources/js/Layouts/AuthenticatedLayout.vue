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

                    <!-- Blog Link -->
                    <li>
                        <Link 
                            :href="route('admin.blog.index')" 
                            class="flex items-center px-4 py-3 mx-2 rounded-lg transition-colors"
                            :class="{'bg-primary text-white': $page.url.startsWith('/admin/blog'), 'hover:bg-gray-100 dark:hover:bg-slate-700': !$page.url.startsWith('/admin/blog')}"
                            title="Blog"
                        >
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            <span class="ml-3 font-medium transition-opacity duration-300" v-show="isSidebarOpen">Blog</span>
                        </Link>
                    </li>

                    <!-- Testimonials Link -->
                    <li>
                        <Link 
                            :href="route('admin.testimonials.index')" 
                            class="flex items-center px-4 py-3 mx-2 rounded-lg transition-colors"
                            :class="{'bg-primary text-white': $page.url.startsWith('/admin/testimonials'), 'hover:bg-gray-100 dark:hover:bg-slate-700': !$page.url.startsWith('/admin/testimonials')}"
                            title="Testimonials"
                        >
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                            <span class="ml-3 font-medium transition-opacity duration-300" v-show="isSidebarOpen">Testimonials</span>
                        </Link>
                    </li>

                    <!-- News & Media Link -->
                    <li>
                        <Link 
                            :href="route('admin.news.index')" 
                            class="flex items-center px-4 py-3 mx-2 rounded-lg transition-colors"
                            :class="{'bg-primary text-white': $page.url.startsWith('/admin/news'), 'hover:bg-gray-100 dark:hover:bg-slate-700': !$page.url.startsWith('/admin/news')}"
                            title="News & Media"
                        >
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <span class="ml-3 font-medium transition-opacity duration-300" v-show="isSidebarOpen">News & Media</span>
                        </Link>
                    </li>

                    <!-- Settings Link -->
                    <li>
                        <Link 
                            :href="route('admin.settings.index')" 
                            class="flex items-center px-4 py-3 mx-2 rounded-lg transition-colors"
                            :class="{'bg-primary text-white': $page.url.startsWith('/admin/settings'), 'hover:bg-gray-100 dark:hover:bg-slate-700': !$page.url.startsWith('/admin/settings')}"
                            title="Settings"
                        >
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="ml-3 font-medium transition-opacity duration-300" v-show="isSidebarOpen">Settings</span>
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
