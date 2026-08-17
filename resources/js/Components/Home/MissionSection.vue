<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <section class="py-16 md:py-24 bg-gray-50/50 border-y border-gray-100 transition-colors duration-300 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Grid Container -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        
        <!-- Left Side: Title & Description -->
        <div class="lg:col-span-5 space-y-6" data-aos="fade-up" data-aos-duration="800">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary/10 text-primary font-bold text-xs uppercase tracking-wider shadow-sm">
            <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            {{ $t('mission.title') }}
          </div>
          
          <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight" style="font-family: Georgia, serif;">
            {{ $t('mission.title') }}
          </h2>
          
          <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-medium">
            {{ $t('mission.subtitle') }}
          </p>

          <div class="hidden lg:block pt-4">
            <Link :href="route('contact')" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 rounded-full text-sm transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-1 hover:scale-102 group">
              <span>{{ $t('hero.contactUs') }}</span>
              <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </Link>
          </div>
        </div>

        <!-- Right Side: 4 Pillars of Striving -->
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
          
          <!-- Pillar 1: Prevent Blindness -->
          <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-4 group hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5 cursor-pointer">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all duration-300 group-hover:scale-110 group-hover:rotate-3 shadow-sm">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-base group-hover:text-primary transition-colors">
                {{ $t('mission.items.prevent.title') }}
              </h4>
              <p class="text-xs sm:text-sm text-gray-500 mt-1.5 leading-relaxed">
                {{ $t('mission.items.prevent.description') }}
              </p>
            </div>
          </div>

          <!-- Pillar 2: Improve Access -->
          <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-4 group hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5 cursor-pointer">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all duration-300 group-hover:scale-110 group-hover:rotate-3 shadow-sm">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-base group-hover:text-primary transition-colors">
                {{ $t('mission.items.access.title') }}
              </h4>
              <p class="text-xs sm:text-sm text-gray-500 mt-1.5 leading-relaxed">
                {{ $t('mission.items.access.description') }}
              </p>
            </div>
          </div>

          <!-- Pillar 3: Empower Individuals -->
          <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-4 group hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5 cursor-pointer">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all duration-300 group-hover:scale-110 group-hover:rotate-3 shadow-sm">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.532.477 5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-5 1.253" />
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-base group-hover:text-primary transition-colors">
                {{ $t('mission.items.empower.title') }}
              </h4>
              <p class="text-xs sm:text-sm text-gray-500 mt-1.5 leading-relaxed">
                {{ $t('mission.items.empower.description') }}
              </p>
            </div>
          </div>

          <!-- Pillar 4: Foster Sustainability -->
          <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-4 group hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5 cursor-pointer">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all duration-300 group-hover:scale-110 group-hover:rotate-3 shadow-sm">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-base group-hover:text-primary transition-colors">
                {{ $t('mission.items.partnerships.title') }}
              </h4>
              <p class="text-xs sm:text-sm text-gray-500 mt-1.5 leading-relaxed">
                {{ $t('mission.items.partnerships.description') }}
              </p>
            </div>
          </div>

        </div>
      </div>

      <!-- Concluding Banner -->
      <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="300" class="mt-10 sm:mt-12 p-6 rounded-2xl bg-primary/5 border border-primary/15 flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div class="text-primary mt-0.5 flex-shrink-0">
          <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
        </div>
        <p class="text-sm text-gray-600 leading-relaxed font-medium">
          {{ $t('mission.footer') }}
        </p>
      </div>

      <div class="lg:hidden mt-8 text-center" data-aos="fade-up">
        <Link :href="route('contact')" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 rounded-full text-sm transition-all shadow">
          {{ $t('hero.contactUs') }}
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </Link>
      </div>

    </div>
  </section>
</template>
