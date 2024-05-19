<script setup>

import {Link} from "@inertiajs/vue3";

defineProps(['cars'])
</script>

<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Brand
                </th>
                <th scope="col" class="px-6 py-3">
                    Model
                </th>
                <th scope="col" class="px-6 py-3">
                    Rental Rate Per Day
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Available
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="cars.length < 1">
                <th scope="col" colspan="5" class="px-6 py-3 text-center">
                    No data
                </th>
            </tr>
            <tr class="bg-white border-b" v-for="car in cars">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                    <div class="ps-3">
                        <div class="text-base font-semibold">{{ car.brand }}</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    {{ car.model }}
                </td>
                <td class="px-6 py-4">
                    {{ car.rental_rate_per_day }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ car.is_available }}
                </td>
                <td class="px-6 py-4 text-center">
                    <Link
                        :href="route('car.edit', car.id)"
                        class="font-medium text-blue-600 hover:underline transition duration-150 ease-in-out"
                    >
                        Edit
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
