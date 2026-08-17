<template>
  <section class="core-values" ref="sectionRef">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="core-values__inner">
        <div class="text-center max-w-2xl mx-auto mb-12">
          <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider mb-3 bg-sky-50 text-primary border border-sky-100 shadow-xs">
            {{ $t('aboutPage.coreValuesBadge') || 'Guiding Principles' }}
          </span>
          <h2 class="core-values__title font-['Outfit',sans-serif]">{{ $t('aboutPage.coreValuesTitle') || 'Our Core Values' }}</h2>
          <p class="core-values__subtitle">
            {{ $t('aboutPage.coreValuesSubtitle') || 'Our values guide every clinical decision, surgical procedure, and patient interaction across our hospital.' }}
          </p>
        </div>

        <div class="core-values__grid">
          <article
            v-for="(value, i) in values"
            :key="value.title"
            class="value-card group"
            :class="{ 'is-visible': visible }"
            :style="{ transitionDelay: visible ? `${i * 90}ms` : '0ms' }"
            tabindex="0"
          >
            <span class="value-card__icon group-hover:bg-primary group-hover:text-white group-hover:shadow-md transition-all duration-300" v-html="value.icon" aria-hidden="true" />
            <h3 class="value-card__title group-hover:text-[#06465C] transition-colors font-['Outfit',sans-serif]">{{ value.title }}</h3>
            <p class="value-card__desc group-hover:text-slate-800 transition-colors">{{ value.description }}</p>
          </article>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

const values = [
  {
    title: 'Clinical Excellence',
    description:
      'We adhere to the highest international ophthalmology standards, employing proven medical protocols and modern surgical precision.',
    icon: '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3.2"/><path d="M5 20c0-3.6 3.1-6.2 7-6.2s7 2.6 7 6.2"/></svg>',
  },
  {
    title: 'Patient Safety & Quality',
    description:
      'Patient well-being is paramount. Strict sterilization, advanced diagnostic verification, and clinical safety measures govern all treatments.',
    icon: '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/><path d="M9 12l2 2 4-4"/></svg>',
  },
  {
    title: 'Compassion & Empathy',
    description:
      'We understand that vision problems can be stressful. We greet every patient warmly, providing reassuring and dignified care.',
    icon: '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M8.5 14c1 1.2 2.2 1.8 3.5 1.8s2.5-.6 3.5-1.8"/><path d="M9 9h.01M15 9h.01"/></svg>',
  },
  {
    title: 'Accessibility & Inclusion',
    description:
      'Dedicated to our non-profit foundation mission, we strive to make sight-saving treatments affordable and accessible to all communities.',
    icon: '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21c-4-2.5-8-5.6-8-10a5 5 0 0 1 8-4 5 5 0 0 1 8 4c0 4.4-4 7.5-8 10z"/></svg>',
  },
  {
    title: 'Integrity & Transparency',
    description:
      'We conduct all medical consultations and operational services with honesty, ethical transparency, and patient-first recommendations.',
    icon: '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v4M4.2 7l2.8 2.8M19.8 7L17 9.8M3 15h18M6 19h12"/></svg>',
  },
  {
    title: 'Continuous Innovation',
    description:
      'We continuously upgrade our medical technology, adopt modern ophthalmic techniques, and invest in ongoing professional training.',
    icon: '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 12a8 8 0 0 1 13.3-6M20 12a8 8 0 0 1-13.3 6"/><path d="M17 3v4h-4M7 21v-4h4"/></svg>',
  },
]

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
    { threshold: 0.2 }
  )
  if (sectionRef.value) observer.observe(sectionRef.value)
})

onBeforeUnmount(() => observer && observer.disconnect())
</script>

<style scoped>
.core-values {
  --cv-surface: var(--brand-surface, #f8fafc);
  --cv-primary: var(--brand-primary, #06465C);
  --cv-accent: var(--brand-accent, #0A96EB);
  --cv-hover-bg: #e8f4fc;

  background: var(--cv-surface);
  padding: clamp(3.5rem, 7vw, 6rem) 0;
}

.core-values__inner {
  max-width: 1180px;
  margin-inline: auto;
}

.core-values__title {
  color: var(--cv-primary);
  font-size: clamp(2rem, 3vw, 2.75rem);
  font-weight: 900;
  letter-spacing: -0.02em;
  margin: 0 0 0.5rem;
}

.core-values__subtitle {
  color: #64748b;
  font-size: 1.05rem;
  line-height: 1.6;
  margin: 0 auto;
  max-width: 60ch;
}

.core-values__grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.75rem;
}

@media (max-width: 768px) {
  .core-values__grid {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }
}

.value-card {
  position: relative;
  background: #fff;
  border-radius: 20px;
  padding: 2rem 2rem 2rem 2.25rem;
  box-shadow: 0 4px 20px rgba(6, 70, 92, 0.06);
  border: 1px solid rgba(226, 232, 240, 0.8);
  overflow: hidden;
  isolation: isolate;
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.5s ease, transform 0.5s ease, box-shadow 0.3s ease, border-color 0.3s ease;
  cursor: default;
}

.value-card.is-visible {
  opacity: 1;
  transform: translateY(0);
}

/* Left accent bar expanding to a luminous light sky-blue background on hover/focus */
.value-card::before {
  content: '';
  position: absolute;
  inset: 0;
  width: 6px;
  background: var(--cv-accent);
  z-index: -1;
  transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.35s ease;
}

.value-card:hover::before,
.value-card:focus-within::before {
  width: 100%;
  background: var(--cv-hover-bg);
}

.value-card:hover,
.value-card:focus-within {
  box-shadow: 0 12px 30px rgba(10, 150, 235, 0.15);
  border-color: #bae6fd;
  transform: translateY(-3px);
}

.value-card__icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 52px;
  height: 52px;
  border-radius: 16px;
  background: #f0f9ff;
  color: var(--cv-accent);
  box-shadow: 0 2px 8px rgba(10, 150, 235, 0.1);
  margin-bottom: 1.25rem;
  transition: all 0.3s ease;
}

.value-card__title {
  color: var(--cv-primary);
  font-size: 1.25rem;
  font-weight: 800;
  margin: 0 0 0.6rem;
  transition: color 0.3s ease;
}

.value-card__desc {
  color: #475569;
  font-size: 0.95rem;
  line-height: 1.6;
  margin: 0;
  transition: color 0.3s ease;
}

@media (prefers-reduced-motion: reduce) {
  .value-card {
    transition: none;
    opacity: 1;
    transform: none;
  }
  .value-card::before {
    transition: none;
  }
}
</style>
