<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const rental = usePage().props.rental;
const additionalCost = usePage().props.additionalCost;
const lateInDays = usePage().props.lateInDays;
const cost = lateInDays * rental.car.rental_rate_per_day;
const totalAmounts = rental.total_amount + cost;

const form = useForm({
    rental_id: rental.id,
    lateInDays: lateInDays,
    totalAmounts: totalAmounts,
});
</script>

<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Create Car
        </h2>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                        Car
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Info
                    </th>
                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                        Price
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ rental.car.brand + ' - ' + rental.car.model + ' - ' + rental.car.plate_number }}
                    </th>
                    <td class="px-6 py-4">
                            {{ `Duration : ${rental.start_date} - ${rental.end_date}` }}
                    </td>
                    <td class="px-6 py-4">
                            {{ rental.total_amount }}
                    </td>
                </tr>
                <tr class="bg-white" v-if="additionalCost">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Additional Costs
                    </th>
                    <td class="px-6 py-4">
                        Late {{ lateInDays }}
                    </td>
                    <td class="px-6 py-4">
                        {{ cost }}
                    </td>
                </tr>

                </tbody>
                <tfoot>
                <tr class="font-semibold text-gray-900">
                    <th scope="row" colspan="2" class="px-6 py-3 text-base">Total</th>
                        <td class="px-6 py-3">{{ totalAmounts }}</td>
                </tr>
                </tfoot>
            </table>

            <div class="mt-4 flex justify-end">
                <form @submit.prevent="form.post(route('return.store'))">
                    <PrimaryButton :disabled="form.processing">Pay & Return</PrimaryButton>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
