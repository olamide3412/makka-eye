<script setup>
import { ref } from 'vue'
import FaqItem from './FaqItem.vue'

// FAQ Data for Makkah Specialist Eye Hospital
const faqs = [
  {
    question: "Do you accept health insurance?",
    answer: "Yes, we accept most major insurance providers. Please bring your insurance card and a valid ID to your appointment so our billing department can verify your coverage."
  },
  {
    question: "What are your outpatient visiting hours?",
    answer: "Our Outpatient Department is open from 8:00 AM to 8:00 PM, Saturday through Thursday."
  },
  {
    question: "What should I bring for my eye examination?",
    answer: "Please bring your current eyeglasses or contact lenses, a list of all your current medications, and a companion/driver if you are scheduled to have your pupils dilated."
  },
  {
    question: "Do you offer emergency eye care services?",
    answer: "Yes, our Emergency Services are available 24/7 for all immediate ocular needs."
  },
  {
    question: "What are the inpatient visiting hours?",
    answer: "For patients admitted to the hospital, visiting hours are strictly from 4:00 PM to 8:00 PM."
  }
]
</script>

<template>
  <section class="bg-white py-16" data-aos="fade-up" data-aos-duration="800">
    <div class="container mx-auto px-4">
      <!-- Section Title -->
      <div class="text-center mb-12">
        <h3 class="text-3xl font-bold text-gray-800">Frequently Asked Questions</h3>
        <div class="w-20 h-1 bg-primary mx-auto my-3"></div>
      </div>

      <div class="flex flex-col lg:flex-row gap-12">
        <!-- FAQ Accordion -->
        <div class="lg:w-1/2 space-y-4">
          <FaqItem
            v-for="(faq, index) in faqs"
            :key="index"
            :question="faq.question"
            :answer="faq.answer"
          />
        </div>

        <!-- Call to Action -->
        <div class="lg:w-1/2 bg-gray-50 text-gray-700 p-8 rounded-lg shadow-md">
          <h4 class="text-2xl font-semibold mb-4">Still have questions?</h4>
          <p class="mb-2">Our patient services desk is ready to assist you regarding appointments, insurance, and available treatments.</p>
          <p class="font-bold text-lg mb-6">
            Email:
            <a href="mailto:patient.services@makkaheye.com" class="text-primary underline">
              patient.services@makkaheye.com
            </a>
          </p>
          <a
            href="/contact"
            class="inline-block bg-primary hover:bg-primary-dark text-white py-2 px-6 rounded transition-transform transform hover:scale-105"
          >
            Contact Us
          </a>
        </div>
      </div>
    </div>
  </section>
</template>
