<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UpdateCarForm from "@/Pages/Car/Partials/UpdateCarForm.vue";
import DeleteCarForm from "@/Pages/Car/Partials/DeleteCarForm.vue";
// import UpdateCandidateForm from "@/Pages/Candidate/Partials/UpdateCarForm.vue";
// import DeleteCandidateForm from "@/Pages/Candidate/Partials/DeleteCarForm.vue";

defineProps({
    car: {
        type: Object,
    }
});
</script>

<template>
    <Head title="Edit Car" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Car</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateCarForm
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteCarForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
