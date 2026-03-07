<script setup>
import CompanyCover from '../../../images/tricycle.jpg'; // Replace with your actual image path
const laptopImagePath = '/images/products/laptop.png'
</script>

<template>
  <section class="py-12 md:py-20 bg-white">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-10">

      <!-- Left Column: Image -->
      <div
        class="md:w-1/2"
        data-aos="fade-right"
        data-aos-duration="800"
        data-aos-delay="200"
      >
        <img
          :src="laptopImagePath"
          alt="Makkah Specialist Eye Hospital - Reliable Eye Care Services"
          width="1024"
          height="879"
          class="w-full h-auto rounded-lg shadow-md object-cover"
        />
      </div>

      <!-- Right Column: Content -->
      <div
        class="md:w-1/2"
        data-aos="fade-left"
        data-aos-duration="800"
        data-aos-delay="200"
      >
        <h5 class="text-blue-600 font-semibold text-sm uppercase mb-2">
          Welcome to Makkah Specialist Eye Hospital
        </h5>

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6 leading-tight">
          Exceptional Eye Care – Trusted Solutions for Your Vision
        </h2>

        <div class="space-y-4 text-gray-600 mb-8">
          <p>
            Makkah Specialist Eye Hospital offers a comprehensive range of ophthalmology services — from advanced cataract surgery to routine eye exams — all backed by state-of-the-art technology.
          </p>
          <p class="font-bold text-gray-700">
            Shop with confidence. Own today, pay smart tomorrow.
          </p>
        </div>

        <!-- CTA Button -->
        <a
          href="/products"
          class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded transition-transform duration-300 transform hover:scale-105"
        >
          Browse Products
        </a>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Optional: Ensure image maintains aspect ratio */
img {
  aspect-ratio: 4 / 3;
  object-fit: cover;
}
</style>
