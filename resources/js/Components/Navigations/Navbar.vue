<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Logo from '../../../images/logo.png';
import NavLink from '@/Components/Navigations/NavLink.vue';
import EyeIcon from '@/Components/Services/EyeIcon.vue';
import { Link } from '@inertiajs/vue3';

const isOpen = ref(false);
const toggle = () => (isOpen.value = !isOpen.value);

const servicesDropdownOpen = ref(false);
const servicesRef = ref(null);
const mobileServicesOpen = ref(false);

const deptDropdownOpen = ref(false);
const deptRef = ref(null);
const mobileDeptOpen = ref(false);

const toggleServices = () => {
  servicesDropdownOpen.value = !servicesDropdownOpen.value;
};

const closeServices = () => {
  servicesDropdownOpen.value = false;
};

const toggleDept = () => {
  deptDropdownOpen.value = !deptDropdownOpen.value;
};

const closeDept = () => {
  deptDropdownOpen.value = false;
};

const servicesList = [
  { key: 'glaucoma', iconType: 'glaucoma' },
  { key: 'squint', iconType: 'squint' },
  { key: 'cataracts', iconType: 'cataracts' },
  { key: 'prosthetic', iconType: 'prosthetic' },
  { key: 'examination', iconType: 'examination' },
  { key: 'lasik', iconType: 'lasik' },
  { key: 'retina', iconType: 'retina' },
  { key: 'cornea', iconType: 'cornea' },
  { key: 'diabetic', iconType: 'diabetic' },
  { key: 'emergency', iconType: 'emergency' }
];

const departmentsList = [
  { slug: 'diagnostic', title: 'Diagnostic' },
  { slug: 'pharmacy', title: 'Pharmacy' },
  { slug: 'optical-shop', title: 'Optical Shop' },
  { slug: 'optical-workshop', title: 'Optical Workshop' }
];

const currentTheme = ref('light');

const toggleTheme = () => {
  currentTheme.value = currentTheme.value === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-theme', currentTheme.value);
  localStorage.setItem('theme', currentTheme.value);
};

const handleClickOutside = (e) => {
  if (servicesRef.value && !servicesRef.value.contains(e.target)) {
    servicesDropdownOpen.value = false;
  }
  if (deptRef.value && !deptRef.value.contains(e.target)) {
    deptDropdownOpen.value = false;
  }
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
  <nav class="fixed top-[44px] left-0 w-full z-50 bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-20 md:h-22 lg:h-24">
      
      <!-- Logo Branding (Moorfields Exact Styling) -->
      <Link href="/" class="flex items-center space-x-2.5 md:space-x-3.5 flex-shrink-0 group py-1">
        <img :src="Logo" class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16 lg:w-18 lg:h-18 object-contain max-h-16 transition-transform duration-300 group-hover:scale-105" alt="Makkah Specialist Eye Hospital Logo" />
        <div class="flex flex-col justify-center font-['Outfit',sans-serif]">
          <h1 class="text-slate-950 dark:text-white font-medium text-base sm:text-lg md:text-xl lg:text-[22px] xl:text-2xl leading-tight tracking-tight">Makkah Specialist</h1>
          <span class="text-slate-950 dark:text-white font-medium text-base sm:text-lg md:text-xl lg:text-[22px] xl:text-2xl leading-tight tracking-tight">Eye Hospital</span>
          <span class="text-[10px] sm:text-xs text-slate-800 dark:text-slate-300 font-normal tracking-tight mt-0.5">A branch of Al-Basar International Foundation</span>
        </div>
      </Link>

      <!-- Desktop Nav -->
      <div class="hidden lg:flex items-center space-x-0.5 xl:space-x-1.5 2xl:space-x-2.5 list-none h-full">
        <NavLink :href="route('about')" :active="$page.component === 'About'">
          {{ $t('nav.about') }}
          <svg class="w-3.5 h-3.5 opacity-70 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
        </NavLink>
        
        <!-- Services with Mega-Menu Dropdown -->
        <li class="relative h-full flex items-center" ref="servicesRef" @mouseenter="servicesDropdownOpen = true" @mouseleave="servicesDropdownOpen = false">
          <button 
            @click="toggleServices"
            :class="[
              'h-full px-2 xl:px-3.5 2xl:px-4 py-5 flex items-center justify-center border-b-2 transition-all duration-200 text-xs xl:text-sm 2xl:text-[15px] font-bold tracking-tight whitespace-nowrap gap-1 focus:outline-none',
              $page.component.startsWith('Services') 
                ? 'border-primary text-primary font-extrabold' 
                : 'border-transparent text-slate-800 dark:text-slate-100 hover:text-primary'
            ]"
          >
            <span>{{ $t('nav.services') }}</span>
            <svg :class="['w-4 h-4 transition-transform duration-200', servicesDropdownOpen ? 'rotate-180 text-primary' : 'text-slate-500']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <!-- Mega Menu Popover Dropdown Panel (Pure Text Executive Styling) -->
          <transition name="dropdown">
            <div 
              v-if="servicesDropdownOpen" 
              class="absolute top-full left-1/2 -translate-x-1/2 w-[880px] bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-3xl shadow-2xl p-7 z-50 transition-all duration-200"
            >
              <div class="flex items-center justify-between pb-4 mb-5 border-b border-gray-100 dark:border-slate-800">
                <div class="flex items-center space-x-2.5">
                  <div class="w-2 h-5 bg-primary rounded-full"></div>
                  <h3 class="text-base font-extrabold text-slate-900 dark:text-white font-['Outfit',sans-serif] tracking-tight">Our Specialized Eye Services</h3>
                </div>
                <Link href="/services" @click="closeServices" class="text-xs font-extrabold text-primary hover:text-primary-dark transition-colors uppercase tracking-wider">
                  View All Services →
                </Link>
              </div>

              <!-- Pure Plain Text 3-Column Grid -->
              <div class="grid grid-cols-3 gap-x-8 gap-y-2.5 font-['Plus_Jakarta_Sans',sans-serif]">
                <Link 
                  v-for="service in servicesList" 
                  :key="service.key"
                  :href="route('services.show', service.key)"
                  @click="closeServices"
                  class="group block py-2.5 px-3.5 rounded-xl hover:bg-sky-50/80 dark:hover:bg-slate-800/80 transition-all duration-150"
                >
                  <span class="text-[15px] font-semibold text-slate-800 dark:text-slate-200 group-hover:text-primary transition-colors block leading-snug">
                    {{ $t('serviceList.list.' + service.key + '.title') }}
                  </span>
                </Link>
              </div>
            </div>
          </transition>
        </li>

        <!-- Departments Dropdown -->
        <li class="relative h-full flex items-center" ref="deptRef" @mouseenter="deptDropdownOpen = true" @mouseleave="deptDropdownOpen = false">
          <button 
            @click="toggleDept"
            :class="[
              'h-full px-2 xl:px-3.5 2xl:px-4 py-5 flex items-center justify-center border-b-2 transition-all duration-200 text-xs xl:text-sm 2xl:text-[15px] font-bold tracking-tight whitespace-nowrap gap-1 focus:outline-none',
              $page.component.startsWith('Departments') 
                ? 'border-primary text-primary font-extrabold' 
                : 'border-transparent text-slate-800 dark:text-slate-100 hover:text-primary'
            ]"
          >
            <span>{{ $t('departments.navTitle') }}</span>
            <svg :class="['w-4 h-4 transition-transform duration-200', deptDropdownOpen ? 'rotate-180 text-primary' : 'text-slate-500']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <!-- Departments Popover Dropdown Panel (Pure Plain Text) -->
          <transition name="dropdown">
            <div 
              v-if="deptDropdownOpen" 
              class="absolute top-full left-1/2 -translate-x-1/2 w-64 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-2xl shadow-2xl p-4 z-50 transition-all duration-200"
            >
              <div class="space-y-1 font-['Plus_Jakarta_Sans',sans-serif]">
                <Link 
                  v-for="dept in departmentsList" 
                  :key="dept.slug"
                  :href="route('departments.show', dept.slug)"
                  @click="closeDept"
                  class="group block py-2.5 px-3.5 rounded-xl hover:bg-sky-50/80 dark:hover:bg-slate-800/80 transition-all duration-150"
                >
                  <span class="text-[15px] font-semibold text-slate-800 dark:text-slate-200 group-hover:text-primary transition-colors block leading-snug">
                    {{ $t('departments.list.' + dept.slug + '.title') }}
                  </span>
                </Link>
              </div>
            </div>
          </transition>
        </li>
        

        <NavLink :href="route('news.index')" :active="$page.component.startsWith('News')">
          {{ $t('nav.news') }}
        </NavLink>
        
        <NavLink :href="route('testimonials.index')" :active="$page.component === 'Testimonials'">
          {{ $t('nav.reviews') }}
        </NavLink>
        
        <NavLink :href="route('contact')" :active="$page.component === 'Contact'">
          {{ $t('nav.contact') }}
        </NavLink>

        <NavLink :href="route('login')" v-if="!$page.props.auth.user">{{ $t('nav.login') }}</NavLink>
        <NavLink :href="route('dashboard')" v-if="$page.props.auth.user">{{ $t('nav.dashboard') }}</NavLink>

        <!-- Theme Toggle -->
        <button @click="toggleTheme" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors shrink-0" aria-label="Toggle Theme">
          <svg v-if="currentTheme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>
      </div>

      <!-- Mobile Controls: Theme Toggle + Moorfields Yellow Hamburger -->
      <div class="flex items-center space-x-3 lg:hidden">
        <button @click="toggleTheme" class="p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors" aria-label="Toggle Theme">
          <svg v-if="currentTheme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <!-- Moorfields Signature Yellow Hamburger Menu Button -->
        <button @click="toggle" class="focus:outline-none p-1 flex flex-col justify-center items-center gap-1 w-8 h-8 rounded" aria-label="Menu">
          <span class="w-6 h-0.5 bg-[#FFB800] rounded-full transition-all duration-300" :class="{ 'rotate-45 translate-y-1.5': isOpen }"></span>
          <span class="w-6 h-0.5 bg-[#FFB800] rounded-full transition-all duration-300" :class="{ 'opacity-0': isOpen }"></span>
          <span class="w-6 h-0.5 bg-[#FFB800] rounded-full transition-all duration-300" :class="{ '-rotate-45 -translate-y-1.5': isOpen }"></span>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <transition name="slide">
      <div v-if="isOpen" class="lg:hidden bg-white dark:bg-slate-900 shadow-xl border-t border-gray-100 dark:border-slate-800 p-5">
        <ul class="space-y-3.5 text-center font-bold text-slate-800 dark:text-slate-100 text-base">
          <li><Link :href="route('about')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.aboutUs') }}</Link></li>
          
          <!-- Mobile Services Accordion -->
          <li>
            <div class="flex items-center justify-center gap-2 py-2 cursor-pointer" @click="mobileServicesOpen = !mobileServicesOpen">
              <Link :href="route('services')" @click="toggle" class="hover:text-primary transition-colors">{{ $t('nav.services') }}</Link>
              <svg :class="['w-4 h-4 transition-transform text-primary', mobileServicesOpen ? 'rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
            <transition name="slide">
              <div v-if="mobileServicesOpen" class="py-2 space-y-2 text-sm bg-slate-50 dark:bg-slate-800/60 rounded-2xl my-2 p-3 text-center">
                <Link 
                  v-for="service in servicesList" 
                  :key="service.key"
                  :href="route('services.show', service.key)"
                  @click="toggle"
                  class="block py-1.5 font-semibold text-slate-700 dark:text-slate-300 hover:text-primary transition-colors"
                >
                  {{ $t('serviceList.list.' + service.key + '.title') }}
                </Link>
              </div>
            </transition>
          </li>

          <!-- Mobile Departments Accordion -->
          <li>
            <div class="flex items-center justify-center gap-2 py-2 cursor-pointer" @click="mobileDeptOpen = !mobileDeptOpen">
              <Link :href="route('departments.index')" @click="toggle" class="hover:text-primary transition-colors">{{ $t('departments.navTitle') }}</Link>
              <svg :class="['w-4 h-4 transition-transform text-primary', mobileDeptOpen ? 'rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
            <transition name="slide">
              <div v-if="mobileDeptOpen" class="py-2 space-y-2 text-sm bg-slate-50 dark:bg-slate-800/60 rounded-2xl my-2 p-3 text-center">
                <Link 
                  v-for="dept in departmentsList" 
                  :key="dept.slug"
                  :href="route('departments.show', dept.slug)"
                  @click="toggle"
                  class="block py-1.5 font-semibold text-slate-700 dark:text-slate-300 hover:text-primary transition-colors"
                >
                  {{ $t('departments.list.' + dept.slug + '.title') }}
                </Link>
              </div>
            </transition>
          </li>
          
          <li><Link :href="route('news.index')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.newsMedia') }}</Link></li>
          <li><Link :href="route('testimonials.index')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.testimonials') }}</Link></li>
          <li><Link :href="route('contact')" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.contact') }}</Link></li>
          <li><Link :href="route('login')" v-if="!$page.props.auth.user" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.login') }}</Link></li>
          <li><Link :href="route('dashboard')" v-if="$page.props.auth.user" @click="toggle" class="block py-2 hover:text-primary transition-colors">{{ $t('nav.dashboard') }}</Link></li>
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
