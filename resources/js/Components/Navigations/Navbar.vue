<script setup>
import { ref, onMounted } from 'vue';
import Logo from '../../../images/logo.png';
import NavLink from '@/Components/Navigations/NavLink.vue';
import { Link } from '@inertiajs/vue3';

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
  
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    if (!localStorage.getItem('theme')) {
        currentTheme.value = e.matches ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', currentTheme.value);
    }
  });
});
</script>

<template>
  <nav class="fixed top-0 md:top-[40px] left-0 w-full z-50 bg-white dark:bg-gray-900 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
      <!-- Logo -->
      <Link href="/" class="flex items-center space-x-3">
        <img :src="Logo" width="45" height="35" alt="Makkah Specialist Eye Hospital Logo" />
        <div>
          <h1 class="text-primary font-bold text-lg leading-tight">MAKKAH SPECIALIST</h1>
          <span class="text-xs text-gray-500 dark:text-gray-400 tracking-wide">Eye Hospital</span>
        </div>
      </Link>

      <!-- Desktop Nav -->
      <div class="hidden md:flex items-center space-x-6">
        <NavLink :href="route('home')" :active="$page.component === 'Home'">Home</NavLink>
        <NavLink :href="route('about')" :active="$page.component === 'About'">About</NavLink>
        <NavLink :href="route('services')" :active="$page.component === 'Services'">Services</NavLink>
        <NavLink :href="route('contact')" :active="$page.component === 'Contact'">Contact</NavLink>
        
        <!-- Theme Toggle -->
        <button @click="toggleTheme" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle Theme">
          <svg v-if="currentTheme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <!-- Book Appointment CTA -->
        <Link :href="route('contact')" class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-full transition-colors duration-300 shadow-md hover:shadow-lg">
          Book Appointment
        </Link>
      </div>

      <!-- Mobile: Theme Toggle + Hamburger -->
      <div class="flex items-center space-x-2 md:hidden">
        <button @click="toggleTheme" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle Theme">
          <svg v-if="currentTheme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>
        <button @click="toggle" class="focus:outline-none">
          <svg v-if="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <transition name="slide">
      <div v-if="isOpen" class="md:hidden bg-white dark:bg-gray-900 shadow-lg border-t border-gray-100 dark:border-gray-800 p-4">
        <ul class="space-y-3 text-center">
          <li><Link :href="route('home')" @click="toggle" class="block py-2 hover:text-primary transition-colors">Home</Link></li>
          <li><Link :href="route('about')" @click="toggle" class="block py-2 hover:text-primary transition-colors">About Us</Link></li>
          <li><Link :href="route('services')" @click="toggle" class="block py-2 hover:text-primary transition-colors">Services</Link></li>
          <li><Link :href="route('contact')" @click="toggle" class="block py-2 hover:text-primary transition-colors">Contact</Link></li>
        </ul>
        <div class="mt-4 text-center">
          <Link :href="route('contact')" @click="toggle" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-full transition-colors duration-300">
            Book Appointment
          </Link>
        </div>
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
