<script setup>
import { ref, computed } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'
import Breadcrumb from '@/Components/Navigations/Breadcrumb.vue'

// Current language code from i18n/locale settings
const { locale } = usePage().props

// Search query for filtering FAQs
const searchQuery = ref('')

// Track active accordion indices
const openIndex = ref(null)

const toggleAccordion = (index) => {
  openIndex.value = openIndex.value === index ? null : index
}

// Translated FAQs data
const faqs = {
  en: [
    {
      q: "What are the hospital's opening hours?",
      a: "We are open 24 hours a day, 7 days a week for emergency eye care. Standard consultation hours are Monday through Saturday, from 8:00 AM to 5:00 PM."
    },
    {
      q: "How can I book an appointment online?",
      a: "You can easily book an appointment by clicking the 'Book Appointment' button on the navigation bar, selecting your preferred date and time, and filling in your details."
    },
    {
      q: "Which specialized treatments do you offer?",
      a: "We specialize in Cataract Surgery (Phacoemulsification), Retinal & Vitreous Management, Glaucoma Treatment, Pediatric Eye Care, and Comprehensive Ocular Diagnostics."
    },
    {
      q: "Do you accept national and private health insurance?",
      a: "Yes, we partner with major Health Maintenance Organizations (HMOs) and private insurers. Please contact our administrative desk to check if your provider is on our list."
    },
    {
      q: "What should I bring on my first consultation visit?",
      a: "Please bring a valid photo identification card, any current optical prescription glasses or contact lenses, a list of active medications, and previous medical history files if available."
    }
  ],
  yo: [
    {
      q: "Kí ni àwọn wákàtí ìṣiṣẹ́ ti ilé-ìwòsàn?",
      a: "A wà ní ṣíṣi fún wákàtí 24, ọjọ́ 7 lọ́sẹ̀ fún ìtọ́jú ojú pàjáwìrì. Àwọn wákàtí ìfọ̀rọ̀wánilẹ́nu-wò pápá jẹ́ Látì Ọjọ́ Ajé sí Ọjọ́ Àbámẹ́ta, láti aago 8:00 àárọ̀ sí 5:00 alẹ́."
    },
    {
      q: "Báwo ni mo ṣe lè ṣètò ìbẹ̀wò lórí intanẹ́ẹ̀tì?",
      a: "O lè rọrun láti ṣètò ìbẹ̀wò nípa títẹ bọtini 'Ṣèlérí Pàdé' lórí igbi ìyàn, yíyàn ọjọ́ àti àkókò tí o fẹ́, àti kíkún àwọn kúlẹ̀kúlẹ̀ rẹ."
    },
    {
      q: "Àwọn ìtọ́jú pàtàkì wo ni ẹ pèsè?",
      a: "A ṣe àkànṣe ní Ìtọ́jú Cataract, Ìtọ́jú Retina, Ìtọ́jú Glaucoma, Ìtọ́jú Ojú Àwọn Ọmọdé, àti Àwọn Àyẹ̀wò Ojú."
    },
    {
      q: "Ṣé ẹ gba àwọn ètò ìbáradára (HMO) ti orílẹ̀-èdè tàbí ti ara ẹni?",
      a: "Bẹ́ẹ̀ ni, a ń ṣiṣẹ́ pẹ̀lú ọ̀pọ̀lọpọ̀ àwọn àjọ HMO tó ṣe pàtàkì àti àwọn ilé-iṣẹ́ ìbáradára ti ara ẹni. Kàn sí aago àbójútó wa láti rii daju."
    },
    {
      q: "Kí ni mo yẹ kí n mú wá fún ìbẹ̀wò àkọ́kọ́ mi?",
      a: "Jọ̀wọ́ mú káàdì ìdánimọ̀ tó ní àwòrán, àwọn jígí ojú tàbí contact lenses tí o ń lò lọ́wọ́lọ́wọ́, àwọn orúkọ oògùn rẹ, àti àwọn àkọsílẹ̀ ìlera rẹ tẹ́lẹ̀ wá."
    }
  ],
  ha: [
    {
      q: "Mene ne lokutan aiki na asibitin?",
      a: "Muna buɗe sa'o'i 24 a rana, kwana 7 a mako don gaggawa. Lokutan duba marasa lafiya na yau da kullun sune Litinin zuwa Asabar, daga 8:00 na safe zuwa 5:00 na yamma."
    },
    {
      q: "Yaya zan iya yin alƙawarin ganin likita ta intanet?",
      a: "Kuna iya yin alƙawari cikin sauƙi ta latsa maɓallin 'Yi Alƙawali' a jikin allon sarrafawa, sannan ku zaɓi rana da lokaci da kuke so tare da cika bayananku."
    },
    {
      q: "Wadanne ayyuka na musamman kuke bayarwa?",
      a: "Muna ba da sabis na musamman don tiyatar Cataract, maganin Retina, maganin Glaucoma, kulawar ido na yara, da gwaje-gwajen ido."
    },
    {
      q: "Kuna karɓar inshorar lafiya ta ƙasa ko ta kuɗi?",
      a: "Haka ne, muna aiki tare da manyan kamfanonin inshorar lafiya (HMOs) da inshora mai zaman kansa. Tuntuɓi sashen gudanarwarmu don tabbatarwa."
    },
    {
      q: "Me ya kamata in zo da shi lokacin ziyarar farko?",
      a: "Da fatan za a zo da katin shaida mai hoto, gilashin ido da kuke amfani da su yanzu, jerin magungunan da kuke sha, da rahotannin likita na baya idan akwai."
    }
  ],
  ar: [
    {
      q: "ما هي ساعات عمل المستشفى؟",
      a: "نحن متواجدون على مدار 24 ساعة طوال أيام الأسبوع لحالات طوارئ العيون. أما ساعات العيادات الخارجية والاستشارات العامة فهي من الاثنين إلى السبت، من الساعة 8:00 صباحاً حتى 5:00 مساءً."
    },
    {
      q: "كيف يمكنني حجز موعد عبر الإنترنت؟",
      a: "يمكنك حجز موعد بسهولة بالضغط على زر 'حجز موعد' في شريط التنقل، واختيار التاريخ والوقت المناسبين لك، ثم ملء بياناتك الشخصية."
    },
    {
      q: "ما هي العلاجات المتخصصة التي تقدمونها؟",
      a: "نحن متخصصون في جراحة المياه البيضاء (الكاتاركت)، تصحيح النظر بالليزك، علاج المياه الزرقاء (الجلوكوما)، رعاية عيون الأطفال، وفحوصات العين التشخيصية المتقدمة."
    },
    {
      q: "هل تقبلون التأمين الصحي الحكومي والخاص؟",
      a: "نعم، نحن نقبل معظم شركات التأمين الصحي الكبرى وإدارات الرعاية الصحية (HMOs). يرجى التواصل مع مكتب الاستقبال للتحقق من توافق شركتك."
    },
    {
      q: "ما الذي يجب علي إحضاره في زيارتي الأولى؟",
      a: "يرجى إحضار بطاقة هوية سارية المفعول تحتوي على صورة شخصية، وأي نظارات طبية أو عدسات لاصقة تستخدمها حالياً، وقائمة بالأدوية التي تتناولها، بالإضافة إلى تقاريرك الطبية السابقة إن وجدت."
    }
  ]
}

// Get active FAQs list based on current locale fallback
const activeFaqs = computed(() => {
  const currentLang = locale || 'en'
  return faqs[currentLang] || faqs.en
})

// Search filtered FAQs list
const filteredFaqs = computed(() => {
  if (!searchQuery.value.trim()) return activeFaqs.value
  
  const query = searchQuery.value.toLowerCase()
  return activeFaqs.value.filter(item => 
    item.q.toLowerCase().includes(query) || 
    item.a.toLowerCase().includes(query)
  )
})
</script>

<template>
  <Head title="Frequently Asked Questions" />
  
  <div>
    <!-- Page Header/Breadcrumb -->
    <Breadcrumb title="Frequently Asked Questions" name="FAQ" />

    <!-- FAQ Body -->
    <div class="py-12 md:py-20 bg-gray-50/50 transition-colors duration-300">
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
            placeholder="Search questions..." 
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
          <h3 class="text-lg font-bold text-gray-700">No matching questions found</h3>
          <p class="text-sm text-gray-400 mt-1">Try searching for other keywords.</p>
        </div>

      </div>
    </div>
  </div>
</template>
