<script setup>
import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchCarForm from "@/Pages/Return/Partials/SearchCarForm.vue";
import TableRentals from "@/Pages/Return/Partials/TableRentals.vue";
import TableReturns from "@/Pages/Return/Partials/TableReturns.vue";

defineProps(['rentals', 'additionalCost', 'lateInDays', 'returns'])

const search = (key) => {
    console.log(key)
    router.get(route('return'), {
        search: key,
    }, {
        preserveState: true
    });
}
</script>

<template>
    <Head title="Return Car" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Return Cars</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                            <div>
                            </div>
                            <SearchCarForm @keyword-change="search" />
                        </div>

                        <TableRentals :rentals="rentals.data" />
                        <Pagination :links="rentals.links" />
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 text-gray-900">

                        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                            <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                                History
                            </h4>
                        </div>

                        <TableReturns :returns="returns.data" />
                        <Pagination :links="returns.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
