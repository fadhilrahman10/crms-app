<script setup>
defineProps({
    value: {
        type: String,
    },
    required: {
        type: Boolean,
        default: false,
    }
});
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
         <span v-if="value">
            {{ value }} <span v-if="required" class="text-red-600">*</span>
        </span>
        <span v-else><slot /></span>
    </label>
</template>
