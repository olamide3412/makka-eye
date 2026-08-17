<template>
  <section class="history hidden" ref="sectionRef">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center md:text-left mb-8">
        <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider mb-3 bg-white/10 text-sky-200 border border-white/15">
          {{ $t('aboutPage.historyBadge') || 'Heritage & Legacy' }}
        </span>
        <h2 class="history__title">{{ $t('aboutPage.historyTitle') || 'Our History & Milestones' }}</h2>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl">
          {{ $t('aboutPage.historySubtitle') || 'Tracing our global journey in eradicating preventable blindness and providing accessible, world-class ophthalmic care.' }}
        </p>
      </div>

      <!-- Desktop Horizontal Track -->
      <div class="history__track hidden md:flex">
        <span class="history__line" aria-hidden="true" />

        <div
          v-for="(item, i) in milestones"
          :key="item.year"
          class="milestone"
          :class="[i % 2 === 0 ? 'milestone--top' : 'milestone--bottom', { 'is-visible': visible }]"
          :style="{ transitionDelay: visible ? `${i * 120}ms` : '0ms' }"
        >
          <div class="milestone__content">
            <img v-if="item.image" :src="item.image" :alt="item.imageAlt || ''" loading="lazy" />
            <h4 class="font-bold text-white text-sm mb-1">{{ item.title }}</h4>
            <ul v-if="item.points?.length">
              <li v-for="p in item.points" :key="p">{{ p }}</li>
            </ul>
          </div>
          <span class="milestone__dot" aria-hidden="true" />
          <span class="milestone__year">{{ item.year }}</span>
        </div>
      </div>

      <!-- Mobile Stacked Vertical Timeline (< 768px) -->
      <div class="md:hidden space-y-6 relative pl-6 border-l-2 border-white/20 mt-8">
        <div 
          v-for="(item, i) in milestones" 
          :key="'mobile-' + item.year"
          class="relative group"
          :style="{ transitionDelay: `${i * 100}ms` }"
        >
          <span class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full border-2 border-sky-400 bg-[#06465C]" />
          <div class="bg-white/10 rounded-2xl p-5 border border-white/15 backdrop-blur-xs">
            <span class="text-sky-400 font-extrabold text-lg block mb-1 font-['Outfit',sans-serif]">{{ item.year }}</span>
            <h4 class="font-bold text-white text-base mb-2">{{ item.title }}</h4>
            <img v-if="item.image" :src="item.image" :alt="item.imageAlt || ''" class="w-full h-36 object-cover rounded-xl mb-3" loading="lazy" />
            <ul v-if="item.points?.length" class="space-y-1.5 text-xs text-slate-200">
              <li v-for="p in item.points" :key="p" class="flex items-start gap-1.5">
                <span class="text-sky-400 font-bold">›</span>
                <span>{{ p }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

defineProps({
  // [{ year, title, points: [], image, imageAlt }]
  milestones: { type: Array, required: true },
})

const sectionRef = ref(null)
const visible = ref(false)
let observer

onMounted(() => {
  observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        visible.value = true
        observer.disconnect()
      }
    },
    { threshold: 0.15 }
  )
  if (sectionRef.value) observer.observe(sectionRef.value)
})
onBeforeUnmount(() => observer && observer.disconnect())
</script>

<style scoped>
.history {
  --h-bg: var(--brand-primary, #06465C);
  --h-accent: var(--brand-accent, #0A96EB);

  background: var(--h-bg);
  color: #fff;
  padding: clamp(3rem, 6vw, 5rem) 0;
  overflow-x: auto;
}

.history__title {
  font-size: clamp(1.8rem, 2.8vw, 2.5rem);
  font-weight: 800;
  font-family: 'Outfit', sans-serif;
  letter-spacing: -0.02em;
  margin: 0 0 0.5rem;
}

.history__track {
  position: relative;
  display: flex;
  gap: clamp(2rem, 3.5vw, 3.5rem);
  min-width: max-content;
  padding: 6rem 1rem;
}

.history__line {
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  height: 2px;
  background: rgba(255, 255, 255, 0.25);
}

.milestone {
  position: relative;
  width: 240px;
  display: flex;
  flex-direction: column;
  align-items: center;
  opacity: 0;
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.milestone--top {
  transform: translateY(16px);
  justify-content: flex-end;
}
.milestone--bottom {
  transform: translateY(-16px);
}
.milestone.is-visible {
  opacity: 1;
  transform: translateY(0);
}

.milestone--top .milestone__content {
  order: 1;
  margin-bottom: 1.25rem;
}
.milestone--top .milestone__dot {
  order: 2;
}
.milestone--top .milestone__year {
  order: 4;
  margin-top: 0.75rem;
}
.milestone--top::after {
  content: '';
  order: 3;
  width: 2px;
  height: 1.25rem;
  background: rgba(255, 255, 255, 0.4);
}

.milestone--bottom .milestone__dot {
  order: 1;
}
.milestone--bottom::after {
  content: '';
  order: 2;
  width: 2px;
  height: 1.25rem;
  background: rgba(255, 255, 255, 0.4);
}
.milestone--bottom .milestone__content {
  order: 3;
  margin-top: 1.25rem;
}
.milestone--bottom .milestone__year {
  order: 0;
  margin-bottom: 0.75rem;
}

.milestone__dot {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  border: 3px solid var(--h-accent);
  background: #fff;
  box-shadow: 0 0 10px rgba(10, 150, 235, 0.5);
}

.milestone__year {
  color: #7dd3fc;
  font-weight: 800;
  font-size: 1.3rem;
  font-family: 'Outfit', sans-serif;
}

.milestone__content {
  text-align: left;
  font-size: 0.85rem;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 16px;
  padding: 1rem;
  backdrop-blur-xs: blur(4px);
  width: 100%;
}

.milestone__content img {
  width: 100%;
  height: 95px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 0.6rem;
}

.milestone__content ul {
  list-style: none;
  margin: 0;
  padding: 0;
  text-align: left;
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
  color: #e2e8f0;
  font-size: 0.8rem;
  line-height: 1.4;
}

@media (prefers-reduced-motion: reduce) {
  .milestone {
    transition: none;
    opacity: 1;
    transform: none;
  }
}
</style>
