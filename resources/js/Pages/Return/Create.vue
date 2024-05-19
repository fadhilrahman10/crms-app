<script setup>

import SearchCarForm from "@/Pages/Return/Partials/SearchCarForm.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import TableRentals from "@/Pages/Return/Partials/TableRentals.vue";
import {Head} from "@inertiajs/vue3";
import CreateReturnForm from "@/Pages/Return/Partials/CreateReturnForm.vue";

defineProps(['rental'])

</script>

<template>
    <Head title="Return Car" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Return Car</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <CreateReturnForm />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
