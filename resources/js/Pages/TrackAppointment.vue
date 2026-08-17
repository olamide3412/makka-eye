<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import TextInput from '@/Components/Forms/TextInput.vue'

defineProps({
    appointment: Object,
    searched: Boolean,
    flash: Object
})

const form = useForm({
    tracking_number: ''
})

const track = () => {
    form.get(route('track-appointment'), {
        preserveState: true
    })
}

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString(undefined, {
        year: 'numeric', month: 'long', day: 'numeric'
    });
}
</script>

<template>
    <Head :title="($t('track.title') || 'Track Appointment') + ' | Makkah Specialist Eye Hospital'" />

    <div class="min-h-screen py-16 px-4 bg-slate-50/70 mt-8">
        <div class="max-w-xl mx-auto" data-aos="fade-up" data-aos-duration="800">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center space-x-2 bg-sky-50 text-primary font-extrabold text-xs px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-3 border border-sky-100 shadow-xs">
                    <span>{{ $t('track.badge') || 'Appointment Status' }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 font-['Outfit',sans-serif]">{{ $t('track.title') || 'Track Your Appointment' }}</h1>
                <p class="text-slate-600 mt-2 text-sm sm:text-base">{{ $t('track.subtitle') || 'Enter your tracking number below to check the status of your booking.' }}</p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-10 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <form @submit.prevent="track">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1">
                            <TextInput 
                                name="tracking_number" 
                                v-model="form.tracking_number" 
                                type="text" 
                                :placeholder="$t('track.placeholder') || 'e.g. MEH-A8X9-2026'" 
                                required
                            />
                        </div>
                        <button 
                            type="submit" 
                            class="bg-primary hover:bg-[#0880cc] text-white font-extrabold py-3 px-8 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 cursor-pointer"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">{{ $t('track.searching') || 'Searching...' }}</span>
                            <span v-else>{{ $t('track.button') || 'Track' }}</span>
                        </button>
                    </div>
                </form>

                <!-- Error Message -->
                <div v-if="flash?.error" class="mt-4 p-4 bg-red-50 text-red-700 rounded-2xl text-sm font-medium text-center border border-red-100">
                    {{ flash.error }}
                </div>

                <!-- Results Area -->
                <div v-if="searched && appointment" class="mt-8 border-t border-gray-100 pt-6 animate-fade-in-up">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-black text-slate-900 font-['Outfit',sans-serif]">{{ $t('track.detailsTitle') || 'Appointment Details' }}</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider shadow-xs"
                              :class="{
                                  'bg-amber-100 text-amber-800 border border-amber-200': appointment.status === 'pending',
                                  'bg-emerald-100 text-emerald-800 border border-emerald-200': appointment.status === 'confirmed',
                                  'bg-sky-100 text-sky-800 border border-sky-200': appointment.status === 'completed',
                                  'bg-red-100 text-red-800 border border-red-200': appointment.status === 'cancelled'
                              }">
                            {{ appointment.status === 'pending' ? ($t('track.statusPending') || 'Pending') :
                               appointment.status === 'confirmed' ? ($t('track.statusConfirmed') || 'Confirmed') :
                               appointment.status === 'completed' ? ($t('track.statusCompleted') || 'Completed') :
                               appointment.status === 'cancelled' ? ($t('track.statusCancelled') || 'Cancelled') : appointment.status }}
                        </span>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="bg-slate-50 p-4 rounded-2xl border border-gray-100/80 hover:bg-sky-50/30 transition-colors">
                            <p class="text-xs text-slate-500 font-medium">{{ $t('track.patientName') || 'Patient Name' }}</p>
                            <p class="font-bold text-slate-900 text-base mt-0.5">{{ appointment.first_name }} {{ appointment.last_name }}</p>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-2xl border border-gray-100/80 hover:bg-sky-50/30 transition-colors">
                            <p class="text-xs text-slate-500 font-medium">{{ $t('track.scheduledService') || 'Scheduled Service' }}</p>
                            <p class="font-bold text-slate-900 text-base mt-0.5">{{ appointment.service_needed }}</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="bg-slate-50 p-4 rounded-2xl border border-gray-100/80 hover:bg-sky-50/30 transition-colors">
                                <p class="text-xs text-slate-500 font-medium">{{ $t('track.date') || 'Date' }}</p>
                                <p class="font-bold text-slate-900 mt-0.5">{{ formatDate(appointment.appointment_date) }}</p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-gray-100/80 hover:bg-sky-50/30 transition-colors">
                                <p class="text-xs text-slate-500 font-medium">{{ $t('track.time') || 'Time' }}</p>
                                <p class="font-bold text-slate-900 mt-0.5">{{ appointment.appointment_time }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-fade-in-up {
    animation: fadeInUp 0.5s ease-out;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
