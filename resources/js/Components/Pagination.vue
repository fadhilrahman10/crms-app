<script setup>
import {Link} from "@inertiajs/vue3";

defineProps(['links'])
</script>

<template>
    <div class="flex m-4 float-end">
        <Component
            :is="link.url ? Link : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
            :class="{ 'bg-gray-800 border border-transparent hover:bg-gray-700 text-white hover:text-white': link.active }"
        />
    </div>
</template>

<style scoped>

</style>
