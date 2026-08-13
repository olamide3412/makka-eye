<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import Pagination from '@/Components/Pagination.vue';

defineOptions({ layout: AuthenticatedLayout });

const props = defineProps({
    partners: Object,
    filters: Object,
    counts: Object,
});

const isModalOpen = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    name: '',
    logo_url: '',
    website_url: '',
    description: '',
    status: 'active',
    sort_order: 0,
});

const openCreateModal = () => {
    isEditing.value = false;
    editingId.value = null;
    form.reset();
    form.clearErrors();
    isModalOpen.value = true;
};

const openEditModal = (partner) => {
    isEditing.value = true;
    editingId.value = partner.id;
    form.clearErrors();
    form.name = partner.name;
    form.logo_url = partner.logo_url || '';
    form.website_url = partner.website_url || '';
    form.description = partner.description || '';
    form.status = partner.status;
    form.sort_order = partner.sort_order || 0;
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    form.reset();
};

const submitForm = () => {
    if (isEditing.value) {
        form.put(route('admin.partners.update', editingId.value), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.partners.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const deletePartner = (partner) => {
    if (confirm(`Are you sure you want to delete "${partner.name}"?`)) {
        router.delete(route('admin.partners.destroy', partner.id));
    }
};

const search = ref(props.filters?.search || '');
const filterStatus = ref(props.filters?.status || '');

const applyFilters = () => {
    router.get(route('admin.partners.index'), {
        search: search.value,
        status: filterStatus.value,
    }, { preserveState: true, replace: true });
};
</script>

<template>
    <Head title="Manage Partners | Administration" />

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 font-sans">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white font-['Outfit',sans-serif]">
                    Strategic Partners & Healthcare Affiliates
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Add, edit, or remove partner organizations displayed on the public homepage.
                </p>
            </div>
            <button 
                @click="openCreateModal"
                class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white font-extrabold text-sm px-5 py-2.5 rounded-xl transition-all shadow-sm hover:shadow"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Add New Partner
            </button>
        </div>

        <!-- Filter Stats Bar -->
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div class="flex items-center space-x-2 text-sm font-semibold">
                <button 
                    @click="filterStatus = ''; applyFilters()"
                    :class="[
                        'px-4 py-2 rounded-xl transition-colors',
                        filterStatus === '' ? 'bg-primary text-white' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100'
                    ]"
                >
                    All Partners ({{ counts?.all || 0 }})
                </button>
                <button 
                    @click="filterStatus = 'active'; applyFilters()"
                    :class="[
                        'px-4 py-2 rounded-xl transition-colors',
                        filterStatus === 'active' ? 'bg-emerald-600 text-white' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100'
                    ]"
                >
                    Active ({{ counts?.active || 0 }})
                </button>
                <button 
                    @click="filterStatus = 'inactive'; applyFilters()"
                    :class="[
                        'px-4 py-2 rounded-xl transition-colors',
                        filterStatus === 'inactive' ? 'bg-slate-600 text-white' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100'
                    ]"
                >
                    Inactive ({{ counts?.inactive || 0 }})
                </button>
            </div>

            <!-- Search input -->
            <div class="w-full sm:w-64">
                <input 
                    v-model="search"
                    @input="applyFilters"
                    type="text"
                    placeholder="Search partners..."
                    class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-4 py-2 text-sm bg-white dark:bg-slate-800 text-slate-900 dark:text-white"
                />
            </div>
        </div>

        <!-- Partners Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-700 dark:text-slate-200">
                    <thead class="bg-slate-50 dark:bg-slate-900/50 text-xs uppercase text-slate-500 font-extrabold border-b border-gray-100 dark:border-slate-700">
                        <tr>
                            <th class="px-6 py-4">Logo & Partner Name</th>
                            <th class="px-6 py-4">Website</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Order</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-700/60 font-medium">
                        <tr v-for="partner in partners.data" :key="partner.id" class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center shrink-0 overflow-hidden border border-gray-200 dark:border-slate-600 p-1">
                                        <img v-if="partner.logo_url" :src="partner.logo_url" :alt="partner.name" class="w-full h-full object-contain" />
                                        <span v-else class="text-base font-extrabold text-slate-400">
                                            {{ partner.name.charAt(0) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 dark:text-white text-base">
                                            {{ partner.name }}
                                        </h3>
                                        <p v-if="partner.description" class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1 max-w-sm mt-0.5">
                                            {{ partner.description }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a 
                                    v-if="partner.website_url" 
                                    :href="partner.website_url" 
                                    target="_blank" 
                                    class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1"
                                >
                                    <span>Visit Site</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                                <span v-else class="text-xs text-gray-400">N/A</span>
                            </td>
                            <td class="px-6 py-4">
                                <span 
                                    :class="[
                                        'px-2.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider',
                                        partner.status === 'active' 
                                            ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300' 
                                            : 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-400'
                                    ]"
                                >
                                    {{ partner.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-slate-600 dark:text-slate-400">
                                {{ partner.sort_order }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button 
                                    @click="openEditModal(partner)" 
                                    class="px-3 py-1.5 bg-slate-100 dark:bg-slate-700 hover:bg-primary hover:text-white rounded-lg text-xs font-bold transition-colors"
                                >
                                    Edit
                                </button>
                                <button 
                                    @click="deletePartner(partner)" 
                                    class="px-3 py-1.5 bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white rounded-lg text-xs font-bold transition-colors"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr v-if="!partners.data || partners.data.length === 0">
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                No partners found. Click "Add New Partner" to get started.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="partners && partners.last_page > 1" class="p-4 border-t border-gray-100 dark:border-slate-700">
                <Pagination :paginator="partners" />
            </div>
        </div>

        <!-- Add/Edit Partner Modal -->
        <transition name="fade">
            <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
                <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-gray-100 dark:border-slate-700 space-y-6">
                    <div class="flex items-center justify-between border-b border-gray-100 dark:border-slate-700 pb-4">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white font-['Outfit',sans-serif]">
                            {{ isEditing ? 'Edit Partner' : 'Add New Partner' }}
                        </h3>
                        <button @click="closeModal" class="text-gray-400 hover:text-slate-600 dark:hover:text-slate-200">
                            ✕
                        </button>
                    </div>

                    <form @submit.prevent="submitForm" class="space-y-4">
                        <!-- Partner Name -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                                Partner Organization Name *
                            </label>
                            <input 
                                v-model="form.name"
                                type="text"
                                required
                                placeholder="e.g. Al-Basar International Foundation"
                                class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-2.5 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white"
                            />
                            <span v-if="form.errors.name" class="text-xs text-red-500 mt-1 block">{{ form.errors.name }}</span>
                        </div>

                        <!-- Logo Upload -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                                Partner Logo
                            </label>
                            <ImageUpload v-model="form.logo_url" />
                            <p class="text-xs text-gray-400 mt-1">Upload a clean PNG/JPG logo or paste image URL.</p>
                            <span v-if="form.errors.logo_url" class="text-xs text-red-500 mt-1 block">{{ form.errors.logo_url }}</span>
                        </div>

                        <!-- Website URL -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                                Website Link (Optional)
                            </label>
                            <input 
                                v-model="form.website_url"
                                type="url"
                                placeholder="https://example.org"
                                class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-2.5 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white"
                            />
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                                Short Description (Optional)
                            </label>
                            <textarea 
                                v-model="form.description"
                                rows="3"
                                placeholder="Brief overview of partnership or health mission..."
                                class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-2.5 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white"
                            ></textarea>
                        </div>

                        <!-- Status & Sort Order -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                                    Status
                                </label>
                                <select 
                                    v-model="form.status"
                                    class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-2.5 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-bold"
                                >
                                    <option value="active">Active (Visible on Homepage)</option>
                                    <option value="inactive">Inactive (Hidden)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                                    Sort Order
                                </label>
                                <input 
                                    v-model.number="form.sort_order"
                                    type="number"
                                    class="w-full rounded-xl border border-gray-300 dark:border-slate-700 px-4 py-2.5 text-sm bg-white dark:bg-slate-900 text-slate-900 dark:text-white"
                                />
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100 dark:border-slate-700">
                            <button 
                                type="button" 
                                @click="closeModal"
                                class="px-5 py-2.5 rounded-xl border border-gray-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm hover:bg-slate-100"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                :disabled="form.processing"
                                class="px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-extrabold text-sm shadow-md hover:shadow-lg disabled:opacity-50"
                            >
                                {{ form.processing ? 'Saving...' : (isEditing ? 'Update Partner' : 'Save Partner') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </transition>

    </div>
</template>
