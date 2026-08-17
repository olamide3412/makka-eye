<template>
    <section class="py-20 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
                <span class="inline-block px-3.5 py-1.5 rounded-full bg-primary/10 text-primary font-bold text-xs uppercase tracking-wider mb-3 shadow-xs">
                    {{ $t('home.whyChooseBadge') || 'Clinical Standards & Heritage' }}
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 font-['Outfit',sans-serif] tracking-tight">
                    {{ $t('whyChoose.title') }}
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-base sm:text-lg text-gray-600 leading-relaxed font-medium">
                    {{ $t('whyChoose.subtitle') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <div v-for="(item, index) in features" :key="item.key"
                     data-aos="fade-up"
                     :data-aos-delay="index * 100 + 100"
                     data-aos-duration="800"
                     tabindex="0"
                     class="why-choose-card bg-white rounded-2xl p-7 sm:p-8 shadow-sm border border-gray-100 group cursor-pointer transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-sky-50 text-primary flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all duration-300 group-hover:scale-105 shadow-xs text-2xl">
                        {{ item.icon }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#06465C] transition-colors font-['Outfit',sans-serif]">
                        {{ $t(`whyChoose.features.${item.key}.title`) }}
                    </h3>
                    <p class="text-gray-600 group-hover:text-slate-800 leading-relaxed text-sm transition-colors">
                        {{ $t(`whyChoose.features.${item.key}.description`) }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const features = [
    { icon: '👨‍⚕️', key: 'staff' },
    { icon: '👁️', key: 'family' },
    { icon: '🔬', key: 'technology' },
    { icon: '📍', key: 'location' },
];
</script>

<style scoped>
.why-choose-card {
  position: relative;
  overflow: hidden;
  isolation: isolate;
}

.why-choose-card::before {
  content: '';
  position: absolute;
  inset: 0;
  width: 6px;
  background: var(--color-primary, #0A96EB);
  z-index: -1;
  transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.35s ease;
}

.why-choose-card:hover::before,
.why-choose-card:focus-within::before {
  width: 100%;
  background: #e8f4fc;
}

.why-choose-card:hover,
.why-choose-card:focus-within {
  box-shadow: 0 12px 30px rgba(10, 150, 235, 0.15);
  border-color: #bae6fd;
  transform: translateY(-3px);
}
</style>
