<script setup>

import CreateReturnForm from "@/Pages/Return/Partials/CreateReturnForm.vue";
import {Link} from "@inertiajs/vue3";

defineProps(['rentals'])
</script>

<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Car
                </th>
                <th scope="col" class="px-6 py-3">
                    Start - End
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Amount
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="rentals.length < 1">
                <th scope="col" colspan="5" class="px-6 py-3 text-center">
                    No data
                </th>
            </tr>
            <tr class="bg-white border-b" v-for="rental in rentals">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                    <div class="ps-3">
                        <div class="text-base font-semibold">{{ rental.car.brand }} - {{ rental.car.model }}</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    {{ rental.start_date }} - {{ rental.end_date }}
                </td>
                <td class="px-6 py-4">
                    {{ rental.total_amount }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ rental.status }}
                </td>
                <td class="px-6 py-4 text-center">
                    <Link
                        :href="route('return.create', rental.id)"
                        class="font-medium text-blue-600 hover:underline transition duration-150 ease-in-out"
                    >
                        Return
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
