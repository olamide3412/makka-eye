<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    partners: {
        type: Array,
        default: () => []
    }
});

const expandedPartners = ref({});

const toggleExpand = (id) => {
    expandedPartners.value[id] = !expandedPartners.value[id];
};

const defaultPartners = [
    {
        id: 1,
        name: 'Al-Basar International Foundation',
        logo_url: '/images/logo.png',
        website_url: 'https://albasar.org',
        description: 'Leading non-governmental organization dedicated to preventing blindness across Africa and Asia through specialized eye hospitals and mobile medical campaigns.'
    },
    {
        id: 2,
        name: 'Al-Noor Eye Foundation',
        logo_url: '',
        website_url: 'https://alnoorfoundation.org',
        description: 'Global charitable foundation providing specialized eye care infrastructure, surgical equipment, and medical outreach programs.'
    },
    {
        id: 3,
        name: 'Standard Chartered - Seeing is Believing',
        logo_url: '',
        website_url: 'https://www.sc.com',
        description: 'International initiative combating avoidable blindness through funding, capacity building, and medical equipment donation.'
    },
    {
        id: 4,
        name: 'Oyo State Ministry of Health',
        logo_url: '',
        website_url: 'https://oyostate.gov.ng',
        description: 'State healthcare governing body partnering for community eye screening programs, public health campaigns, and medical assistance.'
    }
];

const displayPartners = computed(() => {
    return (props.partners && props.partners.length > 0) ? props.partners : defaultPartners;
});
</script>

<template>
    <section class="py-16 md:py-24 bg-slate-50 dark:bg-slate-900/60 border-t border-gray-100 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="text-xs font-extrabold text-primary uppercase tracking-widest bg-sky-50 dark:bg-sky-950/40 px-3.5 py-1.5 rounded-full border border-sky-100 dark:border-sky-900/50">
                    Global Health Alliances
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 dark:text-white mt-3 tracking-tight font-['Outfit',sans-serif]">
                    Strategic Partners & Healthcare Affiliates
                </h2>
                <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                    Collaborating with premier international foundations and global health organizations to deliver world-class eye care and prevent avoidable blindness.
                </p>
            </div>

            <!-- Partners Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
                <div 
                    v-for="partner in displayPartners" 
                    :key="partner.id"
                    class="bg-white dark:bg-slate-800 p-6 sm:p-7 rounded-3xl border border-gray-100 dark:border-slate-700/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group"
                >
                    <div>
                        <!-- Enlarged Logo Container -->
                        <div class="w-full h-36 sm:h-40 rounded-2xl bg-slate-50 dark:bg-slate-900/80 flex items-center justify-center p-3 sm:p-4 border border-gray-100/80 dark:border-slate-700/50 mb-5 group-hover:bg-sky-50/50 dark:group-hover:bg-slate-800 transition-colors">
                            <img 
                                v-if="partner.logo_url" 
                                :src="partner.logo_url" 
                                :alt="partner.name" 
                                class="max-h-28 sm:max-h-32 w-full object-contain transition-transform duration-300 group-hover:scale-105" 
                            />
                            <div v-else class="text-center p-3">
                                <span class="text-xl font-black text-primary tracking-tight font-['Outfit',sans-serif] block leading-tight">
                                    {{ partner.name }}
                                </span>
                            </div>
                        </div>

                        <!-- Name & Expandable Description -->
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit',sans-serif] group-hover:text-primary transition-colors leading-snug">
                            {{ partner.name }}
                        </h3>

                        <div v-if="partner.description" class="mt-3">
                            <p 
                                :class="[
                                    'text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed transition-all duration-300',
                                    expandedPartners[partner.id] ? '' : 'line-clamp-4'
                                ]"
                            >
                                {{ partner.description }}
                            </p>
                            <button 
                                v-if="partner.description && partner.description.length > 110"
                                @click="toggleExpand(partner.id)"
                                type="button"
                                class="mt-2 text-xs font-extrabold text-primary hover:text-primary-dark hover:underline focus:outline-none inline-flex items-center gap-1"
                            >
                                <span>{{ expandedPartners[partner.id] ? 'Show Less ▲' : 'Show More ▼' }}</span>
                            </button>
                        </div>
                    </div>

                    <!-- External Link -->
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-slate-700/60 flex items-center justify-between">
                        <a 
                            v-if="partner.website_url"
                            :href="partner.website_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-xs font-extrabold text-primary hover:text-primary-dark inline-flex items-center gap-1.5 transition-transform group-hover:translate-x-1"
                        >
                            <span>Learn More</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <span v-else class="text-xs font-bold text-slate-400">Official Affiliate</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>
