<script setup>
defineProps({
    type: {
        type: String,
        required: true
    }
});
</script>

<template>
    <svg class="w-full h-full" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Common Eye Outer Shell -->
        <path d="M6 30C22 12 48 8 50 8C52 8 78 12 94 30C78 48 52 52 50 52C48 52 22 48 6 30Z" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
        
        <!-- Glaucoma Iris and Pupil -->
        <g v-if="type === 'glaucoma'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <circle cx="50" cy="30" r="9" stroke="currentColor" stroke-width="2" />
            <circle cx="50" cy="30" r="4.5" fill="currentColor" />
        </g>

        <!-- Squint Iris and Pupil -->
        <g v-if="type === 'squint'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <circle cx="50" cy="30" r="8" fill="#0A96EB" />
        </g>

        <!-- Cataracts Iris and Pupil -->
        <g v-if="type === 'cataracts'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <line x1="43" y1="23" x2="57" y2="37" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
            <line x1="38" y1="28" x2="50" y2="40" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
            <line x1="50" y1="20" x2="62" y2="32" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
        </g>

        <!-- Prosthetic (Artificial Eye) -->
        <g v-if="type === 'prosthetic'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <circle cx="50" cy="30" r="9.5" stroke="#0A96EB" stroke-width="2" fill="none" />
            <circle cx="50" cy="30" r="4.5" fill="currentColor" />
            <path d="M32 14C38 10 45 9 50 9C55 9 62 10 68 14" stroke="#0A96EB" stroke-width="2" stroke-dasharray="3,3" stroke-linecap="round" fill="none" />
            <path d="M32 46C38 50 45 51 50 51C55 51 62 50 68 46" stroke="#0A96EB" stroke-width="2" stroke-dasharray="3,3" stroke-linecap="round" fill="none" />
        </g>

        <!-- Examination (Target / Crosshair) -->
        <g v-if="type === 'examination'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <line x1="50" y1="18" x2="50" y2="42" stroke="#0A96EB" stroke-width="2" stroke-linecap="round" />
            <line x1="38" y1="30" x2="62" y2="30" stroke="#0A96EB" stroke-width="2" stroke-linecap="round" />
            <circle cx="50" cy="30" r="3" fill="currentColor" />
        </g>

        <!-- Lasik (Laser Beam) -->
        <g v-if="type === 'lasik'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <circle cx="50" cy="30" r="4.5" fill="currentColor" />
            <path d="M78 8L55 25" stroke="#0A96EB" stroke-width="3" stroke-linecap="round" />
            <circle cx="55" cy="25" r="3.5" fill="#0A96EB" />
        </g>

        <!-- Retina (Neural / Vessels network) -->
        <g v-if="type === 'retina'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <path d="M38 30C42 27 45 28 48 30C52 32 55 31 58 30" stroke="#0A96EB" stroke-width="1.5" stroke-linecap="round" fill="none" />
            <path d="M44 26C46 29 48 28 52 32" stroke="#0A96EB" stroke-width="1.5" stroke-linecap="round" fill="none" />
            <path d="M54 34C52 31 55 30 56 26" stroke="#0A96EB" stroke-width="1.5" stroke-linecap="round" fill="none" />
            <circle cx="50" cy="30" r="4.5" fill="currentColor" />
        </g>

        <!-- Cornea Transplant (Layered Arc) -->
        <g v-if="type === 'cornea'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <path d="M28 20C24 25 24 35 28 40" stroke="#0A96EB" stroke-width="3" stroke-linecap="round" fill="none" />
            <circle cx="50" cy="30" r="4.5" fill="currentColor" />
        </g>

        <!-- Diabetic (Cross / Star) -->
        <g v-if="type === 'diabetic'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <path d="M50 24v12M44 30h12" stroke="#0A96EB" stroke-width="2.5" stroke-linecap="round" />
        </g>

        <!-- Emergency (Flashing rays) -->
        <g v-if="type === 'emergency'">
            <circle cx="50" cy="30" r="15" stroke="currentColor" stroke-width="3" />
            <path d="M12 18l-4-4M88 18l4-4M12 42l-4 4M88 42l4 4" stroke="#0A96EB" stroke-width="2.5" stroke-linecap="round" />
            <circle cx="50" cy="30" r="5" fill="currentColor" />
        </g>
    </svg>
</template>
