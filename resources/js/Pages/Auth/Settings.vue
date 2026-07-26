<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ImageUpload from '@/Components/ImageUpload.vue'

const props = defineProps({
    settings: Object
})

const form = useForm({
    enable_appointments: props.settings?.enable_appointments ?? true,
    hero_slides: (props.settings?.hero_slides ?? []).map((slide, idx) => ({
        id: slide.id ?? `slide-${Date.now()}-${idx}-${Math.random()}`,
        type: slide.type,
        value: slide.value
    }))
})

const addSlide = () => {
    form.hero_slides.push({
        id: `slide-${Date.now()}-${Math.random()}`,
        type: 'link',
        value: ''
    })
}

const removeSlide = (index) => {
    form.hero_slides.splice(index, 1)
}

const moveSlide = (index, direction) => {
    const targetIndex = index + direction
    if (targetIndex < 0 || targetIndex >= form.hero_slides.length) return
    const item = form.hero_slides[index]
    form.hero_slides.splice(index, 1)
    form.hero_slides.splice(targetIndex, 0, item)
}

const saveSettings = () => {
    form.post(route('admin.settings.update'), {
        preserveScroll: true,
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="System Settings" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">System Settings</h1>
            <p class="text-sm text-gray-500 mt-0.5 dark:text-gray-400">Configure global hospital website options and behaviors.</p>
        </div>

        <div class="max-w-3xl">
            <form @submit.prevent="saveSettings" class="space-y-6">
                <!-- Appointment Settings Section -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Appointment Booking Control
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <label class="text-base font-semibold text-gray-900 dark:text-white block">
                                    Enable Online Appointment Booking
                                </label>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Toggle whether public visitors can schedule and request appointments on the website.
                                    When disabled, all booking entry points, buttons, navigation links, and pages on the users end are hidden.
                                </p>
                            </div>
                            
                            <!-- Toggle Switch -->
                            <button 
                                type="button"
                                @click="form.enable_appointments = !form.enable_appointments"
                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                :class="form.enable_appointments ? 'bg-primary' : 'bg-gray-200 dark:bg-gray-700'"
                            >
                                <span 
                                    class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                    :class="form.enable_appointments ? 'translate-x-5' : 'translate-x-0'"
                                />
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hero Slider Settings Section -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-slate-900/50 flex items-center justify-between">
                        <h3 class="font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Hero Slider Images
                        </h3>
                        <button 
                            type="button" 
                            @click="addSlide"
                            class="inline-flex items-center gap-1.5 bg-primary hover:bg-primary/95 text-white font-semibold py-1.5 px-4 rounded-xl text-sm transition-all shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Slide
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Configure the banner slides displayed in the home page hero section. If no custom slides are added, the system automatically falls back to default unsplash banners.
                        </p>

                        <!-- Empty State -->
                        <div v-if="form.hero_slides.length === 0" class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl bg-gray-50/55 dark:bg-slate-900/10">
                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">No Custom Hero Slides</span>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 max-w-sm text-center">Currently displaying default hospital facility images. Click "Add Slide" to begin customizing.</p>
                        </div>

                        <!-- Slides list -->
                        <div v-else class="space-y-4">
                            <div 
                                v-for="(slide, index) in form.hero_slides" 
                                :key="slide.id"
                                class="p-4 border border-gray-100 dark:border-gray-700/60 bg-gray-50/50 dark:bg-slate-900/30 rounded-2xl flex flex-col md:flex-row gap-4 items-start relative group transition-all hover:border-gray-200 dark:hover:border-gray-600/70"
                            >
                                <!-- Drag / Order controls -->
                                <div class="flex md:flex-col gap-1.5 items-center justify-center self-stretch bg-gray-100/50 dark:bg-slate-800/40 rounded-xl px-2 py-1 md:py-2">
                                    <button 
                                        type="button" 
                                        @click="moveSlide(index, -1)"
                                        :disabled="index === 0"
                                        class="p-1 text-gray-500 hover:text-primary dark:text-gray-400 dark:hover:text-primary disabled:opacity-30 disabled:hover:text-gray-500 transition-colors"
                                        title="Move Up"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
                                        </svg>
                                    </button>
                                    <span class="text-xs font-bold text-gray-400 dark:text-gray-500 min-w-4 text-center">
                                        #{{ index + 1 }}
                                    </span>
                                    <button 
                                        type="button" 
                                        @click="moveSlide(index, 1)"
                                        :disabled="index === form.hero_slides.length - 1"
                                        class="p-1 text-gray-500 hover:text-primary dark:text-gray-400 dark:hover:text-primary disabled:opacity-30 disabled:hover:text-gray-500 transition-colors"
                                        title="Move Down"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Slide Details -->
                                <div class="flex-1 space-y-3 w-full">
                                    <div class="flex items-center justify-between flex-wrap gap-2">
                                        <!-- Type selector buttons -->
                                        <div class="inline-flex rounded-lg bg-gray-100 dark:bg-slate-900 p-0.5 border border-gray-200/50 dark:border-gray-700/50">
                                            <button 
                                                type="button"
                                                @click="slide.type = 'link'; slide.value = ''"
                                                class="px-3 py-1 rounded-md text-xs font-semibold transition-all"
                                                :class="slide.type === 'link' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
                                            >
                                                External Link
                                            </button>
                                            <button 
                                                type="button"
                                                @click="slide.type = 'upload'; slide.value = ''"
                                                class="px-3 py-1 rounded-md text-xs font-semibold transition-all"
                                                :class="slide.type === 'upload' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
                                            >
                                                Upload Image
                                            </button>
                                        </div>

                                        <!-- Delete Button -->
                                        <button 
                                            type="button"
                                            @click="removeSlide(index)"
                                            class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors p-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/20"
                                            title="Delete slide"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Content Field -->
                                    <div class="mt-2 w-full">
                                        <!-- Link Input -->
                                        <div v-if="slide.type === 'link'" class="space-y-1">
                                            <input 
                                                v-model="slide.value" 
                                                type="url" 
                                                placeholder="https://example.com/image.jpg"
                                                class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary/45 focus:outline-none text-sm transition-all"
                                            />
                                        </div>

                                        <!-- Upload Input -->
                                        <div v-else-if="slide.type === 'upload'">
                                            <ImageUpload 
                                                v-model="slide.value" 
                                                label="Upload Slide Image"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Preview Pane (if URL/value is present and type is link) -->
                                <div 
                                    v-if="slide.type === 'link' && slide.value" 
                                    class="w-full md:w-32 h-24 rounded-xl overflow-hidden border border-gray-200/60 dark:border-gray-700/60 flex-shrink-0"
                                >
                                    <img :src="slide.value" alt="Preview" class="w-full h-full object-cover bg-gray-100 dark:bg-slate-900" @error="(e) => e.target.style.display = 'none'" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Actions -->
                <div class="flex justify-end gap-3 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="bg-primary hover:bg-primary/95 text-white font-semibold py-2.5 px-6 rounded-xl transition-all shadow disabled:opacity-60 flex items-center gap-2 text-sm"
                    >
                        <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        {{ form.processing ? 'Saving...' : 'Save Settings' }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
