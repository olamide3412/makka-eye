<script setup>
import { ref, onMounted } from 'vue';
import Logo from '../../../images/logo.png'; // Replace with your farming brand logo
import NavLink from '@/Components/Navigations/NavLink.vue';

const isOpen = ref(false);
const toggle = () => (isOpen.value = !isOpen.value);

const currentTheme = ref('light');

const toggleTheme = () => {
  currentTheme.value = currentTheme.value === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-theme', currentTheme.value);
  localStorage.setItem('theme', currentTheme.value);
};

onMounted(() => {
  currentTheme.value = document.documentElement.getAttribute('data-theme') || 'light';
  
  // Listen for system theme changes if no local override
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    if (!localStorage.getItem('theme')) {
        currentTheme.value = e.matches ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', currentTheme.value);
    }
  });
});
</script>

<template>
  <nav class="fixed top-0 left-0 w-full z-50 shadow bg-light text-black dark:bg-dark dark:text-white">
    <div class="container flex items-center justify-between p-2">
      <Link href="/" class="flex items-center space-x-2">
        <img :src="Logo" width="50" height="35" alt="logo" />
        <div>
          <h1 class="text-primary dark:text-secondary-200 font-bold text-lg">
            MAKKAH SPECIALIST
            <span class=" hidden text-xs text-gray-600 dark:text-gray-400">Eye Hospital</span>
          </h1>
        </div>
      </Link>

      <div class="flex items-center space-x-4">
        <!-- Theme Toggle Button -->
        <button @click="toggleTheme" class="p-2 rounded-full focus:outline-none dark:hover:bg-gray-800 hover:bg-gray-200 transition-colors" aria-label="Toggle Theme">
          <!-- Sun Icon for Light Mode (shown when dark mode is active to suggest switching to light) -->
          <svg v-if="currentTheme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <!-- Moon Icon for Dark Mode (shown when light mode is active to suggest switching to dark) -->
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <ul class="hidden md:flex space-x-4">
          <NavLink :href="route('home')" :active="$page.component === 'Home'">Home</NavLink>
          <NavLink :href="route('about')" :active="$page.component === 'About'">About</NavLink>
          <NavLink :href="route('services')" :active="$page.component === 'Services'">Services</NavLink>
          <NavLink :href="route('contact')" :active="$page.component === 'Contact'">Contact</NavLink>
        </ul>
      </div>

      <button @click="toggle" class="md:hidden focus:outline-none">
        <svg
          v-if="!isOpen"
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          stroke-width="3"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg
          v-else
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          stroke-width="3"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <transition name="slide">
      <div v-if="isOpen" class="md:hidden shadow-md p-4">
        <ul class="space-y-3 text-center">
          <li><Link :href="route('home')" @click="toggle">Home</Link></li>
          <li><Link :href="route('about')" @click="toggle">About Us</Link></li>
          <li><Link :href="route('services')" @click="toggle">Services</Link></li>
          <li><Link :href="route('contact')" @click="toggle">Contact</Link></li>
        </ul>
      </div>
    </transition>
  </nav>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: all 0.3s ease;
}
.slide-enter-from,
.slide-leave-to {
  transform: translateY(-10px);
  opacity: 0;
}
</style>
