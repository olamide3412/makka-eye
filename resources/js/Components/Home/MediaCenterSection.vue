<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    articles: {
        type: Object,
        default: () => ({ news: [], event: [], media: [] })
    }
});

// ─── Active category tab ───────────────────────────────────────────────────
const activeTab = ref('news');

const tabs = [
    { value: 'news',  label: 'News',   icon: 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z' },
    { value: 'event', label: 'Events', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
    { value: 'media', label: 'Videos', icon: 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
];

// Current tab's articles
const currentArticles = computed(() => props.articles?.[activeTab.value] || []);
const featuredArticle = computed(() => currentArticles.value[0] || null);
const sideArticles    = computed(() => currentArticles.value.slice(1, 4) || []);

// ─── Helpers ──────────────────────────────────────────────────────────────
const getCoverImage = (article) => {
    if (!article) return null;
    if (article.cover_image) return article.cover_image;
    if (article.media_gallery?.length > 0) {
        const img = article.media_gallery.find(m => m.type === 'image');
        if (img) return img.url;
    }
    return null;
};

const formatTimestamp = (d) => {
    if (!d) return '';
    const dateObj = new Date(d);
    const dayName = dateObj.toLocaleDateString('en-US', { weekday: 'long' });
    const month   = dateObj.toLocaleDateString('en-US', { month: 'long' });
    const day     = dateObj.getDate();
    const year    = dateObj.getFullYear();
    const hour    = String(dateObj.getHours()).padStart(2, '0');
    const min     = String(dateObj.getMinutes()).padStart(2, '0');
    return `${dayName}, ${month} ${day}, ${year} at ${hour}:${min}`;
};
</script>

<template>
    <section class="py-14 md:py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ── Section Header: Title left · Tabs right ─── -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 mb-8" data-aos="fade-up" data-aos-duration="800">

                <!-- Title -->
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight font-['Outfit',sans-serif]">
                    Media Center
                </h2>

                <!-- Category Tabs -->
                <div class="flex items-center gap-2 flex-wrap">
                    <button
                        v-for="(tab, idx) in tabs"
                        :key="tab.value"
                        @click="activeTab = tab.value"
                        :class="[
                            'inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 whitespace-nowrap transform hover:-translate-y-0.5 active:translate-y-0',
                            activeTab === tab.value
                                ? 'bg-primary text-white shadow-lg shadow-primary/20 scale-105'
                                : 'bg-white text-slate-700 border border-gray-200 hover:border-primary hover:text-primary hover:shadow-md'
                        ]"
                    >
                        <svg class="w-4 h-4 shrink-0 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="tab.icon"/>
                        </svg>
                        {{ tab.label }}
                    </button>
                </div>

            </div>

            <!-- ── Hero Split Grid ──────────────────────────── -->
            <!-- Empty state for this category -->
            <div
                v-if="!currentArticles.length"
                data-aos="fade-up"
                class="flex items-center justify-center h-64 rounded-2xl bg-slate-50 border border-dashed border-gray-200 text-slate-400 text-sm font-medium"
            >
                No {{ tabs.find(t => t.value === activeTab)?.label }} articles published yet.
            </div>

            <!-- Hero split (matches screenshot exactly) -->
            <div
                v-else
                data-aos="fade-up"
                data-aos-duration="1000"
                data-aos-delay="150"
                class="grid grid-cols-1 lg:grid-cols-12 gap-0 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100"
                style="min-height: 430px;"
            >
                <!-- LEFT: Large featured card (~58%) -->
                <Link
                    :href="route('news.show', featuredArticle.slug)"
                    class="group relative lg:col-span-7 flex flex-col justify-end bg-slate-900 min-h-[360px] lg:min-h-0 overflow-hidden"
                >
                    <!-- Cover image -->
                    <img
                        v-if="getCoverImage(featuredArticle)"
                        :src="getCoverImage(featuredArticle)"
                        :alt="featuredArticle.title"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out"
                    />
                    <!-- Fallback gradient -->
                    <div v-else class="absolute inset-0 bg-gradient-to-br from-primary/80 to-blue-900"></div>
                    <!-- Dark gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/40 to-transparent group-hover:opacity-90 transition-opacity duration-300"></div>
                    <!-- Title at bottom -->
                    <div class="relative z-10 p-6 sm:p-8 md:p-10 text-white text-center transform group-hover:-translate-y-1 transition-transform duration-300">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold leading-snug font-['Outfit',sans-serif] drop-shadow-lg group-hover:text-sky-200 transition-colors">
                            {{ featuredArticle.title }}
                        </h3>
                    </div>
                </Link>

                <!-- RIGHT: White/navy side panel (~42%) -->
                <div class="lg:col-span-5 bg-white border-l border-gray-100 flex flex-col">

                    <!-- Side article list -->
                    <div class="flex-1 flex flex-col divide-y divide-gray-100">
                        <div
                            v-for="(item, idx) in sideArticles"
                            :key="item.id"
                            class="px-6 py-5 flex flex-col gap-3 hover:bg-sky-50/50 transition-all duration-300 group/item cursor-pointer"
                        >
                            <!-- Timestamp -->
                            <span class="text-[11px] font-semibold text-primary tracking-wide block">
                                {{ formatTimestamp(item.published_at) }}
                            </span>

                            <!-- Thumbnail + Title + Excerpt -->
                            <Link :href="route('news.show', item.slug)" class="flex items-start gap-4">
                                <div class="w-[90px] h-[68px] rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-gray-200 shadow-sm group-hover/item:border-primary/40 transition-colors">
                                    <img
                                        v-if="getCoverImage(item)"
                                        :src="getCoverImage(item)"
                                        :alt="item.title"
                                        class="w-full h-full object-cover group-hover/item:scale-115 transition-transform duration-500 ease-out"
                                    />
                                    <div v-else class="w-full h-full flex items-center justify-center text-[10px] font-bold text-primary uppercase">
                                        {{ activeTab }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-extrabold text-slate-900 leading-snug line-clamp-2 group-hover/item:text-primary transition-colors font-['Outfit',sans-serif]">
                                        {{ item.title }}
                                    </h4>
                                    <p class="mt-1 text-[11px] leading-relaxed text-slate-600 line-clamp-2">
                                        {{ item.excerpt }}
                                    </p>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <!-- More → navigates to full news list page -->
                    <div class="flex justify-end px-6 py-4 border-t border-gray-100 bg-slate-50/50">
                        <Link
                            :href="route('news.index', { view: 'list', category: activeTab })"
                            class="inline-flex items-center gap-2 bg-primary/10 hover:bg-primary text-primary hover:text-white border border-primary/30 font-bold px-5 py-2 rounded-full text-xs transition-all duration-300 shadow-sm hover:shadow-md hover:scale-105"
                        >
                            <span>More</span>
                            <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </Link>
                    </div>

                </div><!-- end right panel -->

            </div><!-- end hero split -->

        </div>
    </section>
</template>
