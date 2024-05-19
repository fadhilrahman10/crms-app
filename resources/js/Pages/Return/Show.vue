<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps(['ret'])
</script>

<template>
    <Head title="Return Car Detail" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Return</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 text-gray-900">

                        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                            <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                                History
                            </h4>
                        </div>

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                                            Rental ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Return Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                                            Days Rented
                                        </th>
                                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                                            Total Fee
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-white">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ ret.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ ret.return_date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ ret.days_rented }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ ret.total_fee }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
