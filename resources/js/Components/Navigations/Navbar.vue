<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Logo from '../../../images/logo.png';
import { Link, usePage } from '@inertiajs/vue3';
import LanguageSelector from '@/Components/LanguageSelector.vue';

const page = usePage();

// ── Mobile menu ────────────────────────────────────────────
const isOpen = ref(false);
const toggle = () => (isOpen.value = !isOpen.value);

// ── Dropdowns ──────────────────────────────────────────────
const servicesDropdownOpen = ref(false);
const servicesRef = ref(null);
const mobileServicesOpen = ref(false);

const deptDropdownOpen = ref(false);
const deptRef = ref(null);
const mobileDeptOpen = ref(false);

const closeServices = () => { servicesDropdownOpen.value = false; };
const closeDept = () => { deptDropdownOpen.value = false; };

// ── Sticky header on scroll ────────────────────────────────
const isSticky = ref(false);

const handleScroll = () => {
  isSticky.value = window.scrollY > 10;
};

// ── Click-outside close ────────────────────────────────────
const handleClickOutside = (e) => {
  if (servicesRef.value && !servicesRef.value.contains(e.target)) {
    servicesDropdownOpen.value = false;
  }
  if (deptRef.value && !deptRef.value.contains(e.target)) {
    deptDropdownOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
  window.addEventListener('scroll', handleScroll, { passive: true });
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
  window.removeEventListener('scroll', handleScroll);
});

// ── Data ───────────────────────────────────────────────────
const servicesList = [
  { key: 'glaucoma' },
  { key: 'squint' },
  { key: 'cataracts' },
  { key: 'prosthetic' },
  { key: 'examination' },
  { key: 'retina' },
  { key: 'cornea' },
  { key: 'diabetic' },
  { key: 'emergency' },
];

const departmentsList = [
  { slug: 'diagnostic',       title: 'Diagnostic' },
  { slug: 'pharmacy',         title: 'Pharmacy' },
  { slug: 'optical-shop',     title: 'Optical Shop' },
  { slug: 'optical-workshop', title: 'Optical Workshop' },
];
</script>

<template>
  <!-- ═══════════════════════════════════════════════════════
       HEADER WRAPPER — sticky shrink on scroll
  ════════════════════════════════════════════════════════ -->
  <header
    :class="[
      'moorfield-header fixed left-0 w-full z-[999] bg-white transition-shadow duration-300',
      isSticky ? 'shadow-md' : 'shadow-none'
    ]"
    style="top: 0;"
  >

    <!-- ── TOP BAR (contact / social / language) ──────────── -->
    <div
      :class="[
        'top-bar border-b transition-all duration-300 ease-in-out overflow-hidden',
        isSticky
          ? 'max-h-0 opacity-0 -translate-y-2 pointer-events-none border-transparent'
          : 'max-h-16 opacity-100 translate-y-0 border-gray-200/80'
      ]"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between" style="min-height: 52px;">

          <!-- Left: Phone hotlines -->
          <div class="flex items-center gap-5 text-sm">
            <a href="tel:+2349166661264"
               class="contact-link flex items-center gap-2 py-1 group transition-all duration-300 hover:-translate-y-0.5">
              <span class="p-1.5 rounded-full bg-sky-50 text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-md group-hover:scale-110">
                <font-awesome-icon :icon="['fas', 'phone']"
                                   class="text-[12px] transition-transform duration-300 group-hover:rotate-12" />
              </span>
              <span class="font-semibold text-[#303030] transition-colors duration-300 group-hover:text-primary">Ibadan</span>
              <span class="text-[#303030] hidden sm:inline transition-colors duration-300 group-hover:text-primary">&nbsp;(+234) 916 666 1264</span>
            </a>

            <span class="hidden md:inline text-gray-300 select-none">|</span>

            <a href="tel:+2348025666772"
               class="contact-link hidden md:flex items-center gap-2 py-1 group transition-all duration-300 hover:-translate-y-0.5">
              <span class="p-1.5 rounded-full bg-sky-50 text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-md group-hover:scale-110">
                <font-awesome-icon :icon="['fas', 'phone']"
                                   class="text-[12px] transition-transform duration-300 group-hover:rotate-12" />
              </span>
              <span class="font-semibold text-[#303030] transition-colors duration-300 group-hover:text-primary">Emergency</span>
              <span class="text-[#303030] transition-colors duration-300 group-hover:text-primary">&nbsp;(+234) 802 566 6772</span>
            </a>
          </div>

          <!-- Right: Socials + Language -->
          <div class="flex items-center gap-4">
            <div class="hidden lg:flex items-center gap-3.5 text-base">
              <a href="https://www.instagram.com/mseh_ibdan" target="_blank" rel="noopener noreferrer"
                 class="social-icon p-1.5 rounded-full hover:bg-sky-50 transition-all duration-300 hover:-translate-y-1 hover:scale-110 hover:text-primary" aria-label="Instagram">
                <font-awesome-icon :icon="['fab', 'instagram']" />
              </a>
              <a href="https://www.facebook.com/p/Makkah-specialist-eye-hospital-Ibadan-61578301984579/" target="_blank" rel="noopener noreferrer"
                 class="social-icon p-1.5 rounded-full hover:bg-sky-50 transition-all duration-300 hover:-translate-y-1 hover:scale-110 hover:text-primary" aria-label="Facebook">
                <font-awesome-icon :icon="['fab', 'facebook']" />
              </a>
              <a href="https://www.tiktok.com/@mseh_ibadan" target="_blank" rel="noopener noreferrer"
                 class="social-icon p-1.5 rounded-full hover:bg-sky-50 transition-all duration-300 hover:-translate-y-1 hover:scale-110 hover:text-primary" aria-label="TikTok">
                <font-awesome-icon :icon="['fab', 'tiktok']" />
              </a>
              <a href="https://x.com/MakkahIbadan" target="_blank" rel="noopener noreferrer"
                 class="social-icon p-1.5 rounded-full hover:bg-sky-50 transition-all duration-300 hover:-translate-y-1 hover:scale-110 hover:text-primary" aria-label="X / Twitter">
                <font-awesome-icon :icon="['fab', 'x-twitter']" />
              </a>
            </div>
            <LanguageSelector />
          </div>

        </div>
      </div>
    </div>

    <!-- ── MAIN NAV BAR ────────────────────────────────────── -->
    <nav
      :class="[
        'site-header border-b transition-all duration-300',
        isSticky ? 'py-[15px]' : 'py-[22px]'
      ]"
      style="border-bottom: 1px solid rgba(48,48,48,0.1);"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">

        <!-- Logo -->
        <Link href="/" class="site-branding flex items-center gap-3 flex-shrink-0 group">
          <img
            :src="Logo"
            alt="Makkah Specialist Eye Hospital Logo"
            :class="[
              'object-contain transition-all duration-300',
              isSticky ? 'max-h-[70px]' : 'max-h-[100px]'
            ]"
          />
          <div class="flex flex-col font-['Poppins',sans-serif]">
            <span class="font-bold leading-tight text-[#06465C]" style="font-size: 26px;">Makkah Specialist</span>
            <span class="font-bold leading-tight text-[#06465C]" style="font-size: 26px;">Eye Hospital</span>
            <span class="text-sm text-slate-500 font-normal mt-0.5">A branch of Al-Basar International Foundation</span>
          </div>
        </Link>

        <!-- Desktop Nav Links -->
        <div class="hidden lg:flex items-center h-full menu-wrapper list-none">

          <!-- About -->
          <Link :href="route('about')"
                :class="['nav-link', $page.component === 'About' ? 'nav-link--active' : '']">
            {{ $t('nav.about') }}
          </Link>

          <!-- Services Mega-Menu -->
          <div class="relative h-full flex items-center"
               ref="servicesRef"
               @mouseenter="servicesDropdownOpen = true"
               @mouseleave="servicesDropdownOpen = false">
            <button
              @click="servicesDropdownOpen = !servicesDropdownOpen"
              :class="['nav-link flex items-center gap-1 focus:outline-none',
                       $page.component.startsWith('Services') ? 'nav-link--active' : '']"
            >
              <span>{{ $t('nav.services') }}</span>
              <svg :class="['w-3.5 h-3.5 transition-transform duration-200',
                            servicesDropdownOpen ? 'rotate-180' : '']"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            <!-- Mega Menu -->
            <transition name="dropdown">
              <div v-if="servicesDropdownOpen"
                   class="mega-menu absolute top-full left-1/2 -translate-x-1/2 w-[820px] bg-white z-50 p-6">
                <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                  <h3 class="font-semibold text-[#06465C] text-base">Our Specialized Eye Services</h3>
                  <Link href="/services" @click="closeServices"
                        class="text-xs font-semibold text-primary hover:text-[#0A96EB] transition-colors uppercase tracking-wider">
                    View All →
                  </Link>
                </div>
                <div class="grid grid-cols-3 gap-x-6 gap-y-1">
                  <Link
                    v-for="service in servicesList"
                    :key="service.key"
                    :href="route('services.show', service.key)"
                    @click="closeServices"
                    class="mega-menu-item block py-2 px-3 rounded hover:bg-sky-50 transition-colors duration-150"
                  >
                    <span class="text-[15px] font-medium text-[#303030] hover:text-[#0A96EB] transition-colors">
                      {{ $t('serviceList.list.' + service.key + '.title') }}
                    </span>
                  </Link>
                </div>
              </div>
            </transition>
          </div>

          <!-- Departments Dropdown -->
          <div class="relative h-full flex items-center"
               ref="deptRef"
               @mouseenter="deptDropdownOpen = true"
               @mouseleave="deptDropdownOpen = false">
            <button
              @click="deptDropdownOpen = !deptDropdownOpen"
              :class="['nav-link flex items-center gap-1 focus:outline-none',
                       $page.component.startsWith('Departments') ? 'nav-link--active' : '']"
            >
              <span>{{ $t('departments.navTitle') }}</span>
              <svg :class="['w-3.5 h-3.5 transition-transform duration-200',
                            deptDropdownOpen ? 'rotate-180' : '']"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            <transition name="dropdown">
              <div v-if="deptDropdownOpen"
                   class="sub-menu absolute top-full left-0 w-56 bg-white z-50">
                <Link
                  v-for="dept in departmentsList"
                  :key="dept.slug"
                  :href="route('departments.show', dept.slug)"
                  @click="closeDept"
                  class="sub-menu-item block py-2.5 px-4 text-[15px] font-medium text-[#303030] hover:text-[#0A96EB] transition-colors"
                >
                  {{ $t('departments.list.' + dept.slug + '.title') }}
                </Link>
              </div>
            </transition>
          </div>

          <!-- Standard nav links -->
          <Link :href="route('blog.index')"
                :class="['nav-link', $page.component.startsWith('Blog') ? 'nav-link--active' : '']">
            {{ $t('nav.blog') }}
          </Link>

          <Link :href="route('news.index')"
                :class="['nav-link', $page.component.startsWith('News') ? 'nav-link--active' : '']">
            {{ $t('nav.news') }}
          </Link>

          <Link :href="route('testimonials.index')"
                :class="['nav-link', $page.component === 'Testimonials' ? 'nav-link--active' : '']">
            {{ $t('nav.reviews') }}
          </Link>

          <Link :href="route('contact')"
                :class="['nav-link', $page.component === 'Contact' ? 'nav-link--active' : '']">
            {{ $t('nav.contact') }}
          </Link>

          <Link v-if="!$page.props.auth.user" :href="route('login')" class="nav-link">
            {{ $t('nav.login') }}
          </Link>
          <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="nav-link">
            {{ $t('nav.dashboard') }}
          </Link>

          <!-- Gold CTA Button — Book Appointment -->
          <Link
            v-if="$page.props.settings?.enable_appointments"
            :href="route('appointments.book')"
            class="cta-btn ml-4"
          >
            Book Appointment
          </Link>
        </div>

        <!-- Mobile hamburger -->
        <button @click="toggle"
                class="lg:hidden focus:outline-none flex flex-col justify-center items-center gap-1.5 w-9 h-9 rounded"
                aria-label="Menu">
          <span class="w-6 h-0.5 bg-[#0A96EB] rounded-full transition-all duration-300"
                :class="{ 'rotate-45 translate-y-[7px]': isOpen }"></span>
          <span class="w-6 h-0.5 bg-[#0A96EB] rounded-full transition-all duration-300"
                :class="{ 'opacity-0': isOpen }"></span>
          <span class="w-6 h-0.5 bg-[#0A96EB] rounded-full transition-all duration-300"
                :class="{ '-rotate-45 -translate-y-[7px]': isOpen }"></span>
        </button>

      </div>
    </nav>

    <!-- ── MOBILE MENU ─────────────────────────────────────── -->
    <transition name="slide">
      <div v-if="isOpen" class="lg:hidden bg-white border-t border-gray-100 shadow-xl">
        <ul class="space-y-0 py-4 px-6 font-medium text-[#303030]">
          <li>
            <Link :href="route('about')" @click="toggle"
                  class="block py-3 border-b border-gray-100 hover:text-[#0A96EB] transition-colors">
              {{ $t('nav.aboutUs') }}
            </Link>
          </li>

          <!-- Mobile Services Accordion -->
          <li>
            <div class="flex items-center justify-between py-3 border-b border-gray-100 cursor-pointer"
                 @click="mobileServicesOpen = !mobileServicesOpen">
              <Link :href="route('services')" @click.stop="toggle"
                    class="hover:text-[#0A96EB] transition-colors">
                {{ $t('nav.services') }}
              </Link>
              <svg :class="['w-4 h-4 transition-transform', mobileServicesOpen ? 'rotate-180 text-[#0A96EB]' : 'text-gray-400']"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
            <transition name="slide">
              <div v-if="mobileServicesOpen" class="pl-4 pb-2 space-y-1 mt-1">
                <Link v-for="service in servicesList" :key="service.key"
                      :href="route('services.show', service.key)"
                      @click="toggle"
                      class="block py-1.5 text-sm text-[#303030] hover:text-[#0A96EB] transition-colors">
                  {{ $t('serviceList.list.' + service.key + '.title') }}
                </Link>
              </div>
            </transition>
          </li>

          <!-- Mobile Departments Accordion -->
          <li>
            <div class="flex items-center justify-between py-3 border-b border-gray-100 cursor-pointer"
                 @click="mobileDeptOpen = !mobileDeptOpen">
              <Link :href="route('departments.index')" @click.stop="toggle"
                    class="hover:text-[#0A96EB] transition-colors">
                {{ $t('departments.navTitle') }}
              </Link>
              <svg :class="['w-4 h-4 transition-transform', mobileDeptOpen ? 'rotate-180 text-[#0A96EB]' : 'text-gray-400']"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
            <transition name="slide">
              <div v-if="mobileDeptOpen" class="pl-4 pb-2 space-y-1 mt-1">
                <Link v-for="dept in departmentsList" :key="dept.slug"
                      :href="route('departments.show', dept.slug)"
                      @click="toggle"
                      class="block py-1.5 text-sm text-[#303030] hover:text-[#0A96EB] transition-colors">
                  {{ $t('departments.list.' + dept.slug + '.title') }}
                </Link>
              </div>
            </transition>
          </li>

          <li>
            <Link :href="route('blog.index')" @click="toggle"
                  class="block py-3 border-b border-gray-100 hover:text-[#0A96EB] transition-colors">
              {{ $t('nav.blog') }}
            </Link>
          </li>
          <li>
            <Link :href="route('news.index')" @click="toggle"
                  class="block py-3 border-b border-gray-100 hover:text-[#0A96EB] transition-colors">
              {{ $t('nav.newsMedia') }}
            </Link>
          </li>
          <li>
            <Link :href="route('testimonials.index')" @click="toggle"
                  class="block py-3 border-b border-gray-100 hover:text-[#0A96EB] transition-colors">
              {{ $t('nav.testimonials') }}
            </Link>
          </li>
          <li>
            <Link :href="route('contact')" @click="toggle"
                  class="block py-3 border-b border-gray-100 hover:text-[#0A96EB] transition-colors">
              {{ $t('nav.contact') }}
            </Link>
          </li>
          <li v-if="!$page.props.auth.user">
            <Link :href="route('login')" @click="toggle"
                  class="block py-3 hover:text-[#0A96EB] transition-colors">
              {{ $t('nav.login') }}
            </Link>
          </li>
          <li v-if="$page.props.auth.user">
            <Link :href="route('dashboard')" @click="toggle"
                  class="block py-3 hover:text-[#0A96EB] transition-colors">
              {{ $t('nav.dashboard') }}
            </Link>
          </li>
          <li v-if="$page.props.settings?.enable_appointments" class="pt-2">
            <Link :href="route('appointments.book')"
                  class="cta-btn block text-center">
              Book Appointment
            </Link>
          </li>
        </ul>
      </div>
    </transition>

  </header>
</template>

<style scoped>
/* ── Poppins nav link base (moorfields.ae values) ─────── */
.nav-link {
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 400;
  color: #303030;
  text-decoration: none;
  text-transform: capitalize;
  padding: 30px 10px;
  display: inline-flex;
  align-items: center;
  position: relative;
  white-space: nowrap;
  transition: color 0.25s ease;
}

/* Gold animated underline sweep */
.nav-link::after {
  content: '';
  position: absolute;
  width: 90%;
  height: 2px;
  bottom: 22px;
  left: 5%;
  background-color: #0A96EB;
  transform: scaleX(0);
  transform-origin: bottom right;
  transition: transform 0.5s ease-out;
}

.nav-link:hover {
  color: #0A96EB;
}

.nav-link:hover::after {
  transform: scaleX(1);
  transform-origin: bottom left;
}

/* Active / current page state */
.nav-link--active {
  color: #06465C;
  font-weight: 600;
}

.nav-link--active::after {
  transform: scaleX(1);
  transform-origin: bottom left;
}

/* ── Gold CTA button ──────────────────────────────────── */
.cta-btn {
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  font-weight: 600;
  background-color: #0A96EB;
  color: #000;
  border: 1px solid #0A96EB;
  border-radius: 6px;
  padding: 9px 18px;
  text-decoration: none;
  transition: background-color 0.2s ease, color 0.2s ease;
  white-space: nowrap;
}
.cta-btn:hover {
  background-color: #0880cc;
  border-color: #0880cc;
  color: #000;
}

/* ── Contact link (top bar) ───────────────────────────── */
.contact-link {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: #303030;
  text-decoration: none;
  transition: color 0.2s ease;
}
.contact-link:hover { color: #0A96EB; }

/* ── Social icon ──────────────────────────────────────── */
.social-icon {
  color: #0A96EB;
  font-size: 15px;
  transition: color 0.2s ease, transform 0.2s ease;
}
.social-icon:hover {
  color: #0A96EB;
  transform: scale(1.15);
}

/* ── Mega Menu panel ──────────────────────────────────── */
.mega-menu {
  border-top: 2px solid #06465C;
  border-radius: 0 0 6px 6px;
  box-shadow: 0 4px 64px 0 rgba(0, 0, 0, 0.12);
}

/* ── Sub-menu / Dept dropdown ─────────────────────────── */
.sub-menu {
  border-top: 2px solid #06465C;
  border-radius: 0 0 6px 6px;
  box-shadow: 0 4.4px 35px 0 rgba(0, 0, 0, 0.08);
  padding: 10px 0;
}
.sub-menu-item:hover { background-color: #fffbef; }

/* ── Dropdown transition (0.35s ease-in-out) ─────────── */
.dropdown-enter-active,
.dropdown-leave-active {
  transition: opacity 0.35s ease-in-out, transform 0.35s ease-in-out;
}
.dropdown-enter-from,
.dropdown-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
.dropdown-enter-to,
.dropdown-leave-from {
  opacity: 1;
  transform: translateY(0);
}

/* ── Mobile slide transition ──────────────────────────── */
.slide-enter-active,
.slide-leave-active {
  transition: all 0.28s ease;
}
.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
</style>
