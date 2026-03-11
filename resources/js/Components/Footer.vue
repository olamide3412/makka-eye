<script setup>
import Logo from '../../images/logo.png'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <footer class="bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        
        <!-- About Column -->
        <div>
          <div class="flex items-center space-x-3 mb-6">
            <img :src="Logo" alt="Makkah Specialist Eye Hospital Logo" class="h-12 brightness-0 invert" />
            <div>
              <h3 class="font-bold text-lg leading-tight">MAKKAH SPECIALIST</h3>
              <span class="text-xs text-blue-200 tracking-wide">Eye Hospital</span>
            </div>
          </div>
          <p class="text-blue-100 text-sm leading-relaxed">
            A leading eye care facility dedicated to providing world-class ophthalmology services. Combining advanced technology with experienced medical professionals for exceptional patient care.
          </p>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="font-bold text-lg mb-6">Quick Links</h4>
          <ul class="space-y-3 text-sm">
            <li><Link :href="route('home')" class="text-blue-100 hover:text-white transition-colors">Home</Link></li>
            <li><Link :href="route('about')" class="text-blue-100 hover:text-white transition-colors">About Us</Link></li>
            <li><Link :href="route('services')" class="text-blue-100 hover:text-white transition-colors">Services</Link></li>
            <li><Link :href="route('faq')" class="text-blue-100 hover:text-white transition-colors">FAQ</Link></li>
            <li><Link :href="route('contact')" class="text-blue-100 hover:text-white transition-colors">Contact</Link></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div>
          <h4 class="font-bold text-lg mb-6">Contact Us</h4>
          <div class="space-y-4 text-sm">
            <div class="flex items-start space-x-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span class="text-blue-100">Makkah, Saudi Arabia</span>
            </div>
            <div class="flex items-center space-x-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              <span class="text-blue-100">24/7 Emergency Services</span>
            </div>
            <div class="flex items-center space-x-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              <a href="mailto:patient.services@makkaheye.com" class="text-blue-100 hover:text-white transition-colors">patient.services@makkaheye.com</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="border-t border-blue-400/30 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-blue-200">
        <span>© {{ new Date().getFullYear() }} Makkah Specialist Eye Hospital. All rights reserved.</span>
        <div class="flex space-x-4 mt-4 md:mt-0">
          <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
          <a href="#" class="hover:text-white transition-colors">Terms of Use</a>
        </div>
      </div>
    </div>
  </footer>
</template>
