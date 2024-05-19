<script setup>
import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateCarForm from "@/Pages/Car/Partials/CreateCarForm.vue";
import TableCars from "@/Pages/Car/Partials/TableCars.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchCarForm from "@/Pages/Car/Partials/SearchCarForm.vue";

defineProps(['cars'])

const search = (key) => {
    console.log(key)
    router.get(route('car'), {
        search: key,
    }, {
        preserveState: true
    });
}
</script>

<template>
    <Head title="Car" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cars</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                            <div>
                                <CreateCarForm />
                            </div>

                            <SearchCarForm @keyword-change="search" />
                        </div>

                        <TableCars :cars="cars.data" />
                        <Pagination :links="cars.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
