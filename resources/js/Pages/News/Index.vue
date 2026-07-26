<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    articles: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const activeCategory = ref(props.filters?.category || 'all');

const categories = [
    { value: 'all', label: 'All' },
    { value: 'news', label: 'News' },
    { value: 'event', label: 'Events' },
    { value: 'announcement', label: 'Announcements' },
    { value: 'media', label: 'Media' },
];

const categoryColors = {
    news: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    event: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
    announcement: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    media: 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
};

const doSearch = () => {
    router.get(route('news.index'), {
        search: search.value || undefined,
        category: activeCategory.value === 'all' ? undefined : activeCategory.value,
    }, { preserveState: true, replace: true });
};

const setCategory = (cat) => {
    activeCategory.value = cat;
    doSearch();
};

watch(search, (val) => { if (!val) doSearch(); });

const formatDate = (d) => d ? new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }) : '';

const getCoverImage = (article) => {
    if (article.cover_image) return article.cover_image;
    if (article.media_gallery && article.media_gallery.length > 0) {
        const firstImage = article.media_gallery.find(m => m.type === 'image');
        if (firstImage) return firstImage.url;
    }
    return null;
};

const hasVideo = (article) => {
    if (article.media_gallery && article.media_gallery.length > 0) {
        return article.media_gallery.some(m => m.type === 'video');
    }
    return false;
};
</script>

<template>
    <div>
        <Head title="News & Media | Makkah Specialist Eye Hospital">
            <meta name="description" content="Stay updated with the latest news, events, announcements, and media from Makkah Specialist Eye Hospital." />
        </Head>

        <!-- Hero -->
        <section class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-20 pt-36 md:pt-44">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <span class="inline-block bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400 text-sm font-semibold px-4 py-1 rounded-full mb-4">Hospital Updates</span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4" style="font-family: Georgia, serif;">News & Media</h1>
                <p class="text-lg text-gray-500 dark:text-gray-400">The latest news, events, announcements, and media from our hospital.</p>
            </div>
        </section>

        <!-- Filter Bar -->
        <section class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 sticky top-14 md:top-[104px] z-30">
            <div class="max-w-7xl mx-auto px-4 py-3 flex flex-col md:flex-row gap-3 items-center justify-between">
                <div class="flex gap-2 flex-wrap">
                    <button v-for="cat in categories" :key="cat.value" @click="setCategory(cat.value)"
                        :class="['px-4 py-1.5 rounded-full text-sm font-medium transition-all border', activeCategory === cat.value ? 'bg-primary text-white border-primary shadow-md' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-primary hover:text-primary']">
                        {{ cat.label }}
                    </button>
                </div>
                <div class="relative w-full md:w-64">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input v-model="search" @keyup.enter="doSearch" type="text" placeholder="Search news..." class="w-full pl-9 pr-4 py-2 rounded-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-sm text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary/40 focus:outline-none" />
                </div>
            </div>
        </section>

        <!-- Articles Grid -->
        <section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
            <div class="max-w-7xl mx-auto px-4">
                <div v-if="!articles?.data?.length" class="flex flex-col items-center justify-center py-24 gap-4">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <p class="text-xl font-semibold text-gray-500 dark:text-gray-400">No articles found</p>
                </div>

                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link v-for="article in articles.data" :key="article.id" :href="route('news.show', article.slug)"
                        class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700 flex flex-col">
                        <div class="relative h-52 overflow-hidden bg-gradient-to-br from-indigo-50 to-blue-100 dark:from-gray-700 dark:to-gray-600">
                            <img v-if="getCoverImage(article)" :src="getCoverImage(article)" :alt="article.title" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div v-else class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-indigo-300/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                            <span :class="['absolute top-3 left-3 text-xs font-bold px-3 py-1 rounded-full capitalize', categoryColors[article.category] || 'bg-gray-100 text-gray-600']">{{ article.category }}</span>
                            <!-- Media Indicators -->
                            <div v-if="hasVideo(article)" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/60 text-white flex items-center justify-center shadow" title="Contains video attachment">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-xs text-gray-400 dark:text-gray-500 mb-2">{{ formatDate(article.published_at) }}</p>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary transition-colors line-clamp-2">{{ article.title }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 flex-1">{{ article.excerpt }}</p>
                            <span class="mt-4 text-primary text-sm font-semibold flex items-center gap-1 group-hover:gap-2 transition-all self-end">
                                Read more
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </Link>
                </div>

                <!-- Pagination -->
                <div v-if="articles?.links?.length > 3" class="flex justify-center mt-12 gap-2">
                    <template v-for="link in articles.links" :key="link.label">
                        <Link v-if="link.url" :href="link.url" preserve-scroll
                            :class="['px-4 py-2 rounded-lg text-sm font-medium transition-colors border', link.active ? 'bg-primary text-white border-primary' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-primary hover:text-primary']"
                            v-html="link.label" />
                    </template>
                </div>
            </div>
        </section>
    </div>
</template>
