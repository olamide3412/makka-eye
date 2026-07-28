<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Logo from '../../../images/logo.png';
import NavLink from '@/Components/Navigations/NavLink.vue';
import { Link } from '@inertiajs/vue3';

const isOpen = ref(false);
const toggle = () => (isOpen.value = !isOpen.value);

const moreOpen = ref(false);
const moreRef = ref(null);

const toggleMore = () => (moreOpen.value = !moreOpen.value);

const handleClickOutside = (e) => {
  if (moreRef.value && !moreRef.value.contains(e.target)) {
    moreOpen.value = false;
  }
};

const currentTheme = ref('light');

const toggleTheme = () => {
  currentTheme.value = currentTheme.value === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-theme', currentTheme.value);
  localStorage.setItem('theme', currentTheme.value);
};

onMounted(() => {
  currentTheme.value = document.documentElement.getAttribute('data-theme') || 'light';
  document.addEventListener('click', handleClickOutside);
  
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    if (!localStorage.getItem('theme')) {
        currentTheme.value = e.matches ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', currentTheme.value);
    }
  });
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
  <nav class="fixed top-[36px] md:top-[40px] left-0 w-full z-50 bg-white dark:bg-gray-900 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
      <!-- Logo -->
      <Link href="/" class="flex items-center space-x-2 md:space-x-3 flex-shrink-0">
        <img :src="Logo" class="w-9 h-7 md:w-11 md:h-9 object-contain" alt="Makkah Specialist Eye Hospital Logo" />
        <div class="flex flex-col justify-center">
          <h1 class="text-primary font-bold text-xs sm:text-sm md:text-base leading-tight uppercase tracking-wide whitespace-nowrap">MAKKAH SPECIALIST</h1>
          <span class="text-primary font-bold text-xs sm:text-sm md:text-base leading-tight uppercase tracking-wide whitespace-nowrap">Eye Hospital</span>
        </div>
      </Link>

      <!-- Desktop Nav -->
      <div class="hidden lg:flex items-center space-x-3 xl:space-x-4 list-none">
        <NavLink :href="route('home')" :active="$page.component === 'Home'">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          {{ $t('nav.home') }}
        </NavLink>
        <NavLink :href="route('about')" :active="$page.component === 'About'">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          {{ $t('nav.about') }}
        </NavLink>
        <NavLink :href="route('services')" :active="$page.component === 'Services'">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          {{ $t('nav.services') }}
        </NavLink>
        <NavLink :href="route('blog.index')" :active="$page.component.startsWith('Blog')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
          {{ $t('nav.blog') }}
        </NavLink>
        <NavLink :href="route('news.index')" :active="$page.component.startsWith('News')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
          {{ $t('nav.news') }}
        </NavLink>
        <NavLink :href="route('testimonials.index')" :active="$page.component === 'Testimonials'">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
          {{ $t('nav.reviews') }}
        </NavLink>
        <NavLink :href="route('contact')" :active="$page.component === 'Contact'">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          {{ $t('nav.contact') }}
        </NavLink>

        <NavLink :href="route('login')" v-if="!$page.props.auth.user">{{ $t('nav.login') }}</NavLink>
        <NavLink :href="route('dashboard')" v-if="$page.props.auth.user">{{ $t('nav.dashboard') }}</NavLink>

        <!-- Theme Toggle -->
        <button @click="toggleTheme" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle Theme">
          <svg v-if="currentTheme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <!-- CTA Buttons -->
        <div class="flex items-center space-x-3">
            <Link v-if="$page.props.settings?.enable_appointments" :href="route('track-appointment')" class="text-primary hover:text-primary-dark font-medium transition-colors duration-300">
              {{ $t('nav.track') }}
            </Link>
            <Link v-if="$page.props.settings?.enable_appointments" :href="route('book-appointment')" class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-full transition-colors duration-300 shadow-md hover:shadow-lg">
              {{ $t('nav.book') }}
            </Link>
        </div>
      </div>

      <!-- Mobile: Theme Toggle + Hamburger -->
      <div class="flex items-center space-x-2 lg:hidden">
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
      <div v-if="isOpen" class="lg:hidden bg-white dark:bg-gray-900 shadow-lg border-t border-gray-100 dark:border-gray-800 p-4">
        <ul class="space-y-3 text-center">
          <li><Link :href="route('home')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.home') }}</Link></li>
          <li><Link :href="route('about')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.aboutUs') }}</Link></li>
          <li><Link :href="route('services')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.services') }}</Link></li>
          <li><Link :href="route('blog.index')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.blog') }}</Link></li>
          <li><Link :href="route('news.index')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.newsMedia') }}</Link></li>
          <li><Link :href="route('testimonials.index')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.testimonials') }}</Link></li>
          <li><Link :href="route('contact')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.contact') }}</Link></li>
          <li><Link :href="route('login')" v-if="!$page.props.auth.user" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.login') }}</Link></li>
          <li><Link :href="route('dashboard')" v-if="$page.props.auth.user" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.dashboard') }}</Link></li>
        </ul>
        <div v-if="$page.props.settings?.enable_appointments" class="mt-4 text-center space-y-3">
          <Link :href="route('track-appointment')" @click="toggle" class="block text-primary hover:text-primary-dark font-medium transition-colors">
            {{ $t('nav.trackAppointment') }}
          </Link>
          <Link :href="route('book-appointment')" @click="toggle" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-full transition-colors duration-300">
            {{ $t('nav.bookAppointment') }}
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
.dropdown-enter-active,
.dropdown-leave-active {
  transition: all 0.2s ease;
}
.dropdown-enter-from,
.dropdown-leave-to {
  transform: translateY(-6px);
  opacity: 0;
}
</style>
