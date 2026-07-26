<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    posts: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const activeCategory = ref(props.filters?.category || '');

const categories = ['Eye Care Tips', 'Medical News', 'Patient Stories', 'Hospital Updates', 'Surgical Advances'];

const doSearch = () => {
    router.get(route('blog.index'), {
        search: search.value || undefined,
        category: activeCategory.value || undefined,
    }, { preserveState: true, replace: true });
};

const setCategory = (cat) => {
    activeCategory.value = activeCategory.value === cat ? '' : cat;
    doSearch();
};

watch(search, (val) => {
    if (!val) doSearch();
});

const formatDate = (d) => d ? new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }) : '';
</script>

<template>
    <div>
        <Head title="Blog | Makkah Specialist Eye Hospital">
            <meta name="description" content="Read expert articles, eye health tips, and hospital updates from the team at Makkah Specialist Eye Hospital." />
        </Head>

        <!-- Hero -->
        <section class="bg-gradient-to-br from-primary/10 to-blue-50 dark:from-gray-900 dark:to-gray-800 py-20 pt-36 md:pt-44">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <span class="inline-block bg-primary/10 text-primary text-sm font-semibold px-4 py-1 rounded-full mb-4">Our Blog</span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4" style="font-family: Georgia, serif;">Eye Health Insights & Hospital News</h1>
                <p class="text-lg text-gray-500 dark:text-gray-400">Expert articles, patient stories, and updates from Makkah Specialist Eye Hospital.</p>
            </div>
        </section>

        <!-- Filters -->
        <section class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 sticky top-14 md:top-[104px] z-30">
            <div class="max-w-7xl mx-auto px-4 py-3 flex flex-col md:flex-row gap-3 items-center justify-between">
                <!-- Search -->
                <div class="relative w-full md:w-72">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input v-model="search" @keyup.enter="doSearch" type="text" placeholder="Search articles..." class="w-full pl-9 pr-4 py-2.5 rounded-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-sm text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary/40 focus:outline-none transition-all" />
                </div>
                <!-- Categories -->
                <div class="flex flex-wrap gap-2">
                    <button v-for="cat in categories" :key="cat" @click="setCategory(cat)"
                        :class="['px-3 py-1.5 rounded-full text-sm font-medium transition-all duration-200 border', activeCategory === cat ? 'bg-primary text-white border-primary shadow-md' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-primary hover:text-primary']">
                        {{ cat }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Blog Grid -->
        <section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
            <div class="max-w-7xl mx-auto px-4">
                <!-- Empty state -->
                <div v-if="!posts?.data?.length" class="flex flex-col items-center justify-center py-24 gap-4">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <p class="text-xl font-semibold text-gray-500 dark:text-gray-400">No posts found</p>
                    <p class="text-gray-400">Try adjusting your search or check back later.</p>
                </div>

                <!-- Grid -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link v-for="post in posts.data" :key="post.id" :href="route('blog.show', post.slug)"
                        class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700 flex flex-col">
                        <!-- Cover -->
                        <div class="relative h-52 overflow-hidden bg-gradient-to-br from-primary/20 to-blue-100 dark:from-gray-700 dark:to-gray-600">
                            <img v-if="post.cover_image" :src="post.cover_image" :alt="post.title" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div v-else class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </div>
                            <span v-if="post.category" class="absolute top-3 left-3 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">{{ post.category }}</span>
                        </div>
                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-xs text-gray-400 dark:text-gray-500 mb-2 flex items-center gap-2">
                                <span>{{ formatDate(post.published_at) }}</span>
                                <span v-if="post.read_time">· {{ post.read_time }} min read</span>
                            </p>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary transition-colors line-clamp-2">{{ post.title }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 flex-1">{{ post.excerpt }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-xs text-gray-400">By {{ post.author?.name || 'Admin' }}</span>
                                <span class="text-primary text-sm font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Read more
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- Pagination -->
                <div v-if="posts?.links?.length > 3" class="flex justify-center mt-12 gap-2">
                    <template v-for="link in posts.links" :key="link.label">
                        <Link v-if="link.url" :href="link.url" preserve-scroll
                            :class="['px-4 py-2 rounded-lg text-sm font-medium transition-colors border', link.active ? 'bg-primary text-white border-primary shadow-md' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-primary hover:text-primary']"
                            v-html="link.label" />
                        <span v-else :class="['px-4 py-2 rounded-lg text-sm border border-transparent text-gray-300 dark:text-gray-600 cursor-not-allowed']" v-html="link.label" />
                    </template>
                </div>
            </div>
        </section>
    </div>
</template>
