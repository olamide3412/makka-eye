<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    posts: {
        type: Array,
        default: () => []
    }
});

const defaultCover = 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=1200&auto=format&fit=crop';

const formatDate = (dateStr) => {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    });
};
</script>

<template>
    <section v-if="props.posts && props.posts.length > 0" class="py-16 md:py-24 bg-slate-50/60 border-t border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12" data-aos="fade-up" data-aos-duration="800">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center space-x-2 bg-sky-50 text-primary font-extrabold text-xs px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-3 border border-sky-100 shadow-xs">
                        <span>{{ $t('home.blogBadge') || 'Eye Health & Clinical Insights' }}</span>
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight font-['Outfit',sans-serif]">
                        {{ $t('home.blogTitle') || 'Latest From Our Blog' }}
                    </h2>
                    <p class="mt-3 text-base sm:text-lg text-slate-600 leading-relaxed font-medium">
                        {{ $t('home.blogSubtitle') || 'Stay informed with specialist advice, preventative tips, and treatment breakthroughs from our medical team.' }}
                    </p>
                </div>

                <div class="shrink-0">
                    <Link 
                        :href="route('blog.index')" 
                        class="inline-flex items-center gap-2 bg-white hover:bg-primary text-primary hover:text-white border-2 border-primary/20 hover:border-primary font-extrabold text-sm px-6 py-3 rounded-full transition-all duration-300 shadow-xs hover:shadow-lg hover:-translate-y-0.5"
                    >
                        <span>{{ $t('home.exploreAllArticles') || 'Explore All Articles' }}</span>
                        <span class="text-base leading-none">→</span>
                    </Link>
                </div>
            </div>

            <!-- Blog Cards Grid (3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article 
                    v-for="(post, index) in props.posts" 
                    :key="post.id"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                    data-aos-duration="800"
                    class="group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between"
                >
                    <div>
                        <!-- Cover Image with Hover Zoom -->
                        <Link :href="route('blog.show', post.slug)" class="block relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img 
                                :src="post.cover_image || defaultCover" 
                                :alt="post.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy"
                            />
                            <!-- Category Pill -->
                            <div class="absolute top-4 left-4 z-10">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-white/90 text-primary backdrop-blur-xs border border-white/80 shadow-xs">
                                    {{ post.category || 'Eye Care' }}
                                </span>
                            </div>
                        </Link>

                        <!-- Content Area -->
                        <div class="p-6 sm:p-7">
                            <!-- Meta: Date & Read Time -->
                            <div class="flex items-center gap-3 text-xs font-semibold text-slate-400 mb-3">
                                <span>{{ formatDate(post.published_at) }}</span>
                                <span>•</span>
                                <span>{{ post.read_time || ('4 ' + ($t('blog.readTime') || 'min read')) }}</span>
                            </div>

                            <!-- Post Title -->
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-primary transition-colors font-['Outfit',sans-serif] leading-snug line-clamp-2 mb-3">
                                <Link :href="route('blog.show', post.slug)">
                                    {{ post.title }}
                                </Link>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                                {{ post.excerpt }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-50 flex items-center justify-between">
                        <Link 
                            :href="route('blog.show', post.slug)" 
                            class="inline-flex items-center gap-1.5 text-xs font-extrabold text-primary group-hover:text-[#0880cc] transition-colors"
                        >
                            <span>{{ $t('home.readFullArticle') || 'Read Full Article' }}</span>
                            <span class="group-hover:translate-x-1 transition-transform duration-200">→</span>
                        </Link>
                    </div>
                </article>
            </div>

        </div>
    </section>
</template>
