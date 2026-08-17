<script setup>
import Logo from '../../images/logo.png';
import { Link } from '@inertiajs/vue3';

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

<template>
  <footer class="bg-[#051c28] text-slate-200 border-t-4 border-primary relative overflow-hidden font-['Poppins',sans-serif]">
    <!-- Subtle architectural background glow -->
    <div class="absolute -top-40 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 left-0 w-96 h-96 bg-sky-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12 relative z-10">
      
      <!-- Top Grid: 4 Columns -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-14 border-b border-slate-800">

        <!-- Col 1: Brand & Foundation (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
          <Link href="/" class="flex items-center gap-3 group">
            <div class="p-2 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15 group-hover:border-primary/50 transition-colors">
              <img :src="Logo" alt="Makkah Specialist Eye Hospital Logo" class="h-12 w-12 object-contain brightness-0 invert" />
            </div>
            <div>
              <span class="block font-bold text-lg leading-tight text-white tracking-wide">MAKKAH SPECIALIST</span>
              <span class="block text-xs font-semibold text-sky-400 tracking-wider">EYE HOSPITAL • IBADAN</span>
              <span class="block text-[10px] text-slate-400 mt-0.5">A branch of Al-Basar International Foundation</span>
            </div>
          </Link>

          <p class="text-slate-300 text-sm leading-relaxed pr-2">
            A premier non-profit ophthalmic center dedicated to eradicating preventable blindness and providing world-class eye care services across Nigeria.
          </p>

          <!-- Social media links -->
          <div class="flex items-center gap-3 pt-1">
            <a
              href="https://www.instagram.com/mseh_ibdan"
              target="_blank"
              rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-primary hover:border-primary hover:-translate-y-1 transition-all duration-300 shadow-sm"
              aria-label="Instagram"
            >
              <font-awesome-icon :icon="['fab', 'instagram']" />
            </a>
            <a
              href="https://www.facebook.com/p/Makkah-specialist-eye-hospital-Ibadan-61578301984579/"
              target="_blank"
              rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-primary hover:border-primary hover:-translate-y-1 transition-all duration-300 shadow-sm"
              aria-label="Facebook"
            >
              <font-awesome-icon :icon="['fab', 'facebook']" />
            </a>
            <a
              href="https://www.tiktok.com/@mseh_ibadan"
              target="_blank"
              rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-primary hover:border-primary hover:-translate-y-1 transition-all duration-300 shadow-sm"
              aria-label="TikTok"
            >
              <font-awesome-icon :icon="['fab', 'tiktok']" />
            </a>
            <a
              href="https://x.com/MakkahIbadan"
              target="_blank"
              rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-primary hover:border-primary hover:-translate-y-1 transition-all duration-300 shadow-sm"
              aria-label="X / Twitter"
            >
              <font-awesome-icon :icon="['fab', 'x-twitter']" />
            </a>
            <a
              href="https://wa.me/2349166661264"
              target="_blank"
              rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-emerald-600 hover:border-emerald-600 hover:-translate-y-1 transition-all duration-300 shadow-sm"
              aria-label="WhatsApp"
            >
              <font-awesome-icon :icon="['fab', 'whatsapp']" />
            </a>
          </div>
        </div>

        <!-- Col 2: Clinical Services (3 cols) -->
        <div class="lg:col-span-3 space-y-4">
          <div class="flex items-center gap-2">
            <div class="w-1.5 h-4 bg-primary rounded-full"></div>
            <h4 class="font-bold text-white text-base tracking-wide uppercase text-xs">Specialized Eye Care</h4>
          </div>
          <ul class="space-y-2.5 text-sm">
            <li>
              <Link :href="route('services.show', 'cataracts')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Cataract Surgery & Lens Implant
              </Link>
            </li>
            <li>
              <Link :href="route('services.show', 'glaucoma')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Glaucoma Treatment & Laser
              </Link>
            </li>
            <li>
              <Link :href="route('services.show', 'retina')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Vitreoretinal & Diabetic Eye
              </Link>
            </li>
            <li>
              <Link :href="route('services.show', 'squint')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Pediatric Ophthalmology & Squint
              </Link>
            </li>
            <li>
              <Link :href="route('services.show', 'cornea')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Corneal Care & Transplantation
              </Link>
            </li>
            <li>
              <Link :href="route('services')" class="text-sky-400 hover:text-white font-semibold text-xs inline-flex items-center gap-1 mt-1 transition-colors">
                Explore All Services →
              </Link>
            </li>
          </ul>
        </div>

        <!-- Col 3: Quick Navigation & Departments (2 cols) -->
        <div class="lg:col-span-2 space-y-4">
          <div class="flex items-center gap-2">
            <div class="w-1.5 h-4 bg-primary rounded-full"></div>
            <h4 class="font-bold text-white text-base tracking-wide uppercase text-xs">Hospital Info</h4>
          </div>
          <ul class="space-y-2.5 text-sm">
            <li>
              <Link :href="route('about')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> About Our Hospital
              </Link>
            </li>
            <li>
              <Link :href="route('departments.index')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Departments
              </Link>
            </li>
            <li>
              <Link :href="route('blog.index')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Eye Care Blog
              </Link>
            </li>
            <li>
              <Link :href="route('news.index')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Media Center & News
              </Link>
            </li>
            <li>
              <Link :href="route('testimonials.index')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Patient Reviews
              </Link>
            </li>
            <li>
              <Link :href="route('faq')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Patient FAQs
              </Link>
            </li>
            <li>
              <Link :href="route('contact')" class="text-slate-300 hover:text-sky-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                <span class="text-primary text-xs">›</span> Contact & Directions
              </Link>
            </li>
          </ul>
        </div>

        <!-- Col 4: Contact & Emergency (3 cols) -->
        <div class="lg:col-span-3 space-y-4">
          <div class="flex items-center gap-2">
            <div class="w-1.5 h-4 bg-emerald-500 rounded-full"></div>
            <h4 class="font-bold text-white text-base tracking-wide uppercase text-xs">Emergency & Location</h4>
          </div>

          <!-- Location -->
          <div class="flex items-start gap-3 text-xs leading-relaxed text-slate-300 bg-white/5 p-3.5 rounded-2xl border border-white/10">
            <svg class="h-5 w-5 text-sky-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>
              <strong class="text-white block font-semibold mb-0.5">Ibadan Center:</strong>
              Ark07 Elebu Junction, Alao-Akala Express, Ibadan, Oyo State
            </span>
          </div>

          <!-- Emergency Hotline Card -->
          <div class="bg-gradient-to-r from-primary/20 to-sky-500/10 p-3.5 rounded-2xl border border-primary/30 space-y-2">
            <div class="flex items-center justify-between text-xs font-semibold">
              <span class="text-sky-300">24/7 Hotline:</span>
              <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-extrabold uppercase">Open 24 Hours</span>
            </div>
            <a href="tel:+2349166661264" class="text-white hover:text-sky-300 font-bold text-sm block transition-colors">
              📞 (+234) 916 666 1264
            </a>
            <a href="tel:+2348025666772" class="text-slate-300 hover:text-sky-300 text-xs block transition-colors">
              🚨 Emergency: (+234) 802 566 6772
            </a>
          </div>

          <!-- Email -->
          <a
            href="mailto:makkah.ibadan@albasar.com"
            class="text-xs text-slate-400 hover:text-sky-300 flex items-center gap-2 transition-colors pt-1"
          >
            <svg class="h-4 w-4 text-sky-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span>makkah.ibadan@albasar.com</span>
          </a>
        </div>

      </div>

      <!-- Bottom Bar -->
      <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-400 gap-4">
        <div class="flex items-center gap-2 text-center md:text-left">
          <span>© {{ new Date().getFullYear() }} Makkah Specialist Eye Hospital Ibadan. All rights reserved.</span>
        </div>

        <div class="flex items-center gap-6">
          <Link :href="route('contact')" class="hover:text-white transition-colors">Patient Privacy Policy</Link>
          <span class="text-slate-700">•</span>
          <Link :href="route('contact')" class="hover:text-white transition-colors">Terms of Service</Link>
          <span class="text-slate-700">•</span>
          <button
            @click="scrollToTop"
            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-white/5 hover:bg-primary hover:text-white border border-white/10 transition-all text-xs text-slate-300"
            aria-label="Back to top"
          >
            <span>Back to Top</span>
            <span>↑</span>
          </button>
        </div>
      </div>

    </div>
  </footer>
</template>
