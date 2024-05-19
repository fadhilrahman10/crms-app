<script setup>
import {Link} from "@inertiajs/vue3";

defineProps(['returns'])
</script>

<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Car
                </th>
                <th scope="col" class="px-6 py-3">
                    Return Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Days Rented
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Total Fee
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="returns.length < 1">
                <th scope="col" colspan="5" class="px-6 py-3 text-center">
                    No data
                </th>
            </tr>
            <tr class="bg-white border-b" v-for="ret in returns">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                    <div class="ps-3">
                        <div class="text-base font-semibold">{{ ret.rental.car.brand }}</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    {{ ret.return_date }}
                </td>
                <td class="px-6 py-4">
                    {{ ret.days_rented }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ ret.total_fee }}
                </td>
                <td class="px-6 py-4 text-center">
                    <Link
                        :href="route('return.show', ret.id)"
                        class="font-medium text-blue-600 hover:underline transition duration-150 ease-in-out"
                    >
                        Detail
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>

</template>

<style scoped>

</style>
