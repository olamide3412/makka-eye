<template>
  <section class="mission" ref="sectionRef">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
      <div class="mission__grid">
        
        <!-- Left: Text & Inclusions List -->
        <div class="mission__text" :class="{ 'is-visible': visible }">
          <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider mb-3 bg-sky-100/80 text-primary border border-sky-200/80 shadow-xs">
            Purpose & Commitment
          </span>
          <h2 class="font-['Outfit',sans-serif]">Our Mission & Vision</h2>
          <p class="mission__intro">{{ intro }}</p>
          <ul class="mission__list">
            <li 
              v-for="item in points" 
              :key="item" 
              tabindex="0"
              class="mission-point-card p-4 rounded-2xl bg-white border border-sky-100/80 shadow-xs flex items-start gap-3 group cursor-pointer transition-all duration-300"
            >
              <span class="mission__bullet group-hover:scale-110 transition-transform duration-300 shadow-xs" aria-hidden="true">✓</span>
              <span class="font-medium text-slate-700 group-hover:text-slate-900 leading-relaxed transition-colors">{{ item }}</span>
            </li>
          </ul>
        </div>

        <!-- Right: Photo with Striped Accent and Zoom-out hover effect -->
        <div class="mission__media" :class="{ 'is-visible': visible }">
          <div class="relative max-w-md mx-auto lg:max-w-none">
            <div class="mission__image-wrapper">
              <img :src="image" :alt="imageAlt" loading="lazy" />
            </div>
            <span class="mission__stripes" aria-hidden="true" />
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

defineProps({
  intro: { 
    type: String, 
    default: 'To eradicate preventable blindness and provide accessible, world-class ophthalmic care through clinical excellence, advanced diagnostics, and compassionate service.' 
  },
  points: { 
    type: Array, 
    default: () => [
      'Delivering specialized cataract, glaucoma, retinal, and pediatric eye treatments.',
      'Conducting community eye outreach camps to reach underserved populations.',
      'Equipping modern surgical suites with advanced diagnostic and laser technology.',
      'Training healthcare workers and elevating eye care standards across the region.'
    ] 
  },
  image: { type: String, required: true },
  imageAlt: { type: String, default: 'Makkah Specialist Eye Hospital' },
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
    { threshold: 0.2 }
  )
  if (sectionRef.value) observer.observe(sectionRef.value)
})
onBeforeUnmount(() => observer && observer.disconnect())
</script>

<style scoped>
.mission {
  --m-surface: var(--brand-surface-alt, #f0f9ff);
  --m-primary: var(--brand-primary, #06465C);
  --m-accent: var(--brand-accent, #0A96EB);

  background: var(--m-surface);
  padding: clamp(3.5rem, 7vw, 5.5rem) 0;
  overflow: hidden;
}

.mission__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: 3.5rem;
}

@media (max-width: 860px) {
  .mission__grid {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }
}

.mission__text,
.mission__media {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.mission__media {
  transition-delay: 0.12s;
}
.mission__text.is-visible,
.mission__media.is-visible {
  opacity: 1;
  transform: translateY(0);
}

.mission__text h2 {
  color: var(--m-primary);
  font-size: clamp(2rem, 3vw, 2.75rem);
  font-weight: 900;
  letter-spacing: -0.02em;
  line-height: 1.15;
  margin: 0 0 1rem;
}

.mission__intro {
  color: #475569;
  font-size: 1.05rem;
  line-height: 1.6;
  margin: 0 0 1.5rem;
}

.mission__list {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
}

.mission-point-card {
  position: relative;
  overflow: hidden;
  isolation: isolate;
}

.mission-point-card::before {
  content: '';
  position: absolute;
  inset: 0;
  width: 6px;
  background: var(--m-accent, #0A96EB);
  z-index: -1;
  transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.35s ease;
}

.mission-point-card:hover::before,
.mission-point-card:focus-within::before {
  width: 100%;
  background: #e8f4fc;
}

.mission-point-card:hover,
.mission-point-card:focus-within {
  box-shadow: 0 8px 22px rgba(10, 150, 235, 0.14);
  border-color: #bae6fd;
  transform: translateY(-2px);
}

.mission__bullet {
  color: #fff;
  background: var(--m-accent);
  width: 22px;
  height: 22px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 900;
  flex: none;
  margin-top: 2px;
}

.mission__media {
  position: relative;
  cursor: pointer;
}

.mission__image-wrapper {
  overflow: hidden;
  border-radius: 24px;
  border: 4px solid #fff;
  box-shadow: 0 20px 40px -15px rgba(6, 70, 92, 0.25);
  position: relative;
  z-index: 2;
  transition: box-shadow 0.6s ease, transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
}

.mission__media:hover .mission__image-wrapper {
  box-shadow: 0 25px 50px -12px rgba(10, 150, 235, 0.3);
  transform: translateY(-4px);
}

.mission__media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transform: scale(1.16);
  transition: transform 0.8s cubic-bezier(0.25, 1, 0.5, 1);
}

/* On hover, the image smoothly zooms out into normal frame scale */
.mission__media:hover img {
  transform: scale(1.0);
}

/* decorative striped tab echoing reference site's diagonal pattern */
.mission__stripes {
  position: absolute;
  right: -16px;
  bottom: -16px;
  width: 50%;
  height: 38%;
  z-index: 1;
  border-radius: 20px;
  background-image: repeating-linear-gradient(
    -45deg,
    var(--m-accent) 0 8px,
    transparent 8px 18px
  );
  opacity: 0.6;
  transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.6s ease;
}

.mission__media:hover .mission__stripes {
  transform: translate(6px, 6px);
  opacity: 0.85;
}

@media (prefers-reduced-motion: reduce) {
  .mission__text,
  .mission__media,
  .mission__media img,
  .mission__image-wrapper,
  .mission__stripes {
    transition: none;
    opacity: 1;
    transform: none;
  }
}
</style>
