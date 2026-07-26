<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    href: {
        type: String,
        default: '#'
    },
    active: {
        type: Boolean,
        default: false
    },
    onClick: Function
})
</script>

<template>
  <li class="h-full flex items-center">
    <Link
      :href="href"
      :class="[
        'h-full px-3 xl:px-4 py-5 flex items-center justify-center border-b-2 transition-all duration-200 text-[13px] xl:text-sm font-semibold tracking-wide gap-1.5 focus:outline-none',
        active 
          ? 'border-primary text-primary' 
          : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-primary hover:border-gray-200 dark:hover:border-slate-800'
      ]"
      @click="onClick"
    >
      <slot/>
    </Link>
  </li>
</template>

