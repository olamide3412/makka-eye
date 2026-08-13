<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ImageUpload from '@/Components/ImageUpload.vue';

defineOptions({ layout: AuthenticatedLayout });

const form = useForm({
    name: '',
    logo_url: '',
    website_url: '',
    description: '',
    status: 'active',
    sort_order: 0,
});

const submit = () => {
    form.post(route('admin.partners.store'));
};
</script>

<template>
    <Head title="Add New Partner | Administration" />

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 font-sans">
        
        <!-- Header -->
        <div class="flex items-center justify-between bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div>
                <Link :href="route('admin.partners.index')" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1 mb-2">
                    ← Back to Partners
                </Link>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white font-['Outfit',sans-serif]">
                    Add New Partner Organization
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Fill in partner information to display on the public website.
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 p-6 sm:p-8">
            <form @submit.prevent="submit" class="space-y-6">
                
                <!-- Partner Name -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Partner Organization Name *
                    </label>
                    <input 
                        v-model="form.name"
                        type="text"
                        required
                        placeholder="e.g. Al-Basar International Foundation"
                        class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-3 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/50"
                    />
                    <span v-if="form.errors.name" class="text-xs text-red-500 mt-1 block">{{ form.errors.name }}</span>
                </div>

                <!-- Logo Upload -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Partner Logo
                    </label>
                    <ImageUpload v-model="form.logo_url" />
                    <p class="text-xs text-gray-400 mt-1">Upload a clean PNG/JPG logo or paste image URL.</p>
                    <span v-if="form.errors.logo_url" class="text-xs text-red-500 mt-1 block">{{ form.errors.logo_url }}</span>
                </div>

                <!-- Website URL -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Website Link (Optional)
                    </label>
                    <input 
                        v-model="form.website_url"
                        type="url"
                        placeholder="https://example.org"
                        class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-3 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/50"
                    />
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Short Description (Optional)
                    </label>
                    <textarea 
                        v-model="form.description"
                        rows="4"
                        placeholder="Brief overview of partnership or health mission..."
                        class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-3 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/50"
                    ></textarea>
                </div>

                <!-- Status & Sort Order -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                            Status
                        </label>
                        <select 
                            v-model="form.status"
                            class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-3 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-bold"
                        >
                            <option value="active">Active (Visible on Homepage)</option>
                            <option value="inactive">Inactive (Hidden)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                            Sort Order
                        </label>
                        <input 
                            v-model.number="form.sort_order"
                            type="number"
                            class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-3 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white"
                        />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 flex items-center justify-end space-x-3 border-t border-gray-100 dark:border-slate-700">
                    <Link 
                        :href="route('admin.partners.index')"
                        class="px-6 py-3 rounded-xl border border-gray-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                    >
                        Cancel
                    </Link>
                    <button 
                        type="submit"
                        :disabled="form.processing"
                        class="px-8 py-3 rounded-xl bg-primary hover:bg-primary-dark text-white font-extrabold text-sm shadow-md hover:shadow-lg disabled:opacity-50 transition-all"
                    >
                        {{ form.processing ? 'Saving...' : 'Save Partner' }}
                    </button>
                </div>

            </form>
        </div>

    </div>
</template>
