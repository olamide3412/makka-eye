<script setup>
import { ref, computed } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'
import PageHeroBanner from '@/Components/Common/PageHeroBanner.vue'

const { locale, tm, t } = useI18n()

// Search query for filtering FAQs
const searchQuery = ref('')

// Track active accordion indices
const openIndex = ref(null)

const toggleAccordion = (index) => {
  openIndex.value = openIndex.value === index ? null : index
}

// Get active FAQs list based on dynamic i18n locale
const activeFaqs = computed(() => {
  const items = tm('faq.items')
  if (Array.isArray(items) && items.length > 0) {
    return items
  }
  return []
})

// Search filtered FAQs list
const filteredFaqs = computed(() => {
  if (!searchQuery.value.trim()) return activeFaqs.value
  
  const query = searchQuery.value.toLowerCase()
  return activeFaqs.value.filter(item => 
    (item.q && item.q.toLowerCase().includes(query)) || 
    (item.a && item.a.toLowerCase().includes(query))
  )
})
</script>

<template>
  <Head :title="($t('faq.title') || 'Frequently Asked Questions') + ' | Makkah Specialist Eye Hospital'" />
  
  <div class="bg-slate-50 min-h-screen">
    <!-- Page Hero Banner (Moorfields Style) -->
    <PageHeroBanner 
        :title="$t('faq.title') || 'Frequently Asked Questions'"
        :badge="$t('faq.badge') || 'Help & FAQs'"
        :breadcrumbs="[
            { label: $t('nav.home') || 'Home', href: route('home') },
            { label: $t('faq.title') || 'FAQs' }
        ]"
    />

    <!-- FAQ Body -->
    <div class="py-12 md:py-16">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Input -->
        <div class="mb-10 max-w-lg mx-auto relative group" data-aos="fade-up" data-aos-duration="800">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          <input 
            type="text" 
            v-model="searchQuery" 
            :placeholder="$t('faq.searchPlaceholder') || 'Search questions...'" 
            class="w-full pl-11 pr-4 py-3.5 rounded-2xl border border-gray-200 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/45 hover:border-primary/30 transition-all shadow-sm font-medium"
          />
        </div>

        <!-- Accordion Cards -->
        <div v-if="filteredFaqs.length > 0" class="space-y-4">
          <div 
            v-for="(item, idx) in filteredFaqs" 
            :key="idx" 
            data-aos="fade-up"
            :data-aos-delay="idx * 80"
            data-aos-duration="800"
            :class="[
              'bg-white rounded-2xl border shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5',
              openIndex === idx ? 'border-primary/40 shadow-md ring-1 ring-primary/15' : 'border-gray-100/90 hover:border-primary/25'
            ]"
          >
            <!-- Question Trigger -->
            <button 
              @click="toggleAccordion(idx)"
              class="w-full px-6 py-4.5 flex items-center justify-between text-left font-bold text-gray-800 hover:text-primary transition-colors cursor-pointer"
            >
              <span class="pr-4 leading-snug font-['Outfit',sans-serif] text-base sm:text-lg">{{ item.q }}</span>
              <span 
                class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300"
                :class="openIndex === idx ? 'bg-primary text-white rotate-180 shadow-xs' : 'bg-sky-50 text-primary'"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </button>

            <!-- Answer Block -->
            <transition
              enter-active-class="transition-all duration-300 ease-out"
              leave-active-class="transition-all duration-200 ease-in"
              enter-from-class="max-h-0 opacity-0"
              enter-to-class="max-h-[300px] opacity-100"
              leave-from-class="max-h-[300px] opacity-100"
              leave-to-class="max-h-0 opacity-0"
            >
              <div v-show="openIndex === idx" class="overflow-hidden">
                <div class="px-6 pb-5 pt-2 text-sm sm:text-base text-slate-600 leading-relaxed border-t border-gray-100/80 bg-slate-50/40">
                  {{ item.a }}
                </div>
              </div>
            </transition>
          </div>
        </div>

        <!-- No Results Empty State -->
        <div v-else class="text-center py-12">
          <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="text-lg font-bold text-gray-700">{{ $t('faq.noResults') || 'No matching questions found' }}</h3>
          <p class="text-sm text-gray-400 mt-1">{{ $t('faq.noResultsDesc') || 'Try searching for other keywords.' }}</p>
        </div>

      </div>
    </div>
  </div>
</template>
