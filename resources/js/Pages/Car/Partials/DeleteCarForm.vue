<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {useForm, usePage} from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from "axios";

const confirmingCarDeletion = ref(false);
const car = usePage().props.car;

const form = useForm({
    password: '',
});

const confirmCarDeletion = () => {
    confirmingCarDeletion.value = true;
};

const deleteCar = async () => {
    form.delete(route('car.destroy', car.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });

};

const closeModal = () => {
    confirmingCarDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Car</h2>

            <p class="mt-1 text-sm text-gray-600">
                Once this car is deleted, all of its resources and data will be permanently deleted. Before deleting
                this car, please download any data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="confirmCarDeletion">Delete Car</DangerButton>

        <Modal :show="confirmingCarDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete this car?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once this car is deleted, all of its resources and data will be permanently deleted. Please
                    to confirm you would like to permanently delete this car.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteCar"
                    >
                        Delete Car
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
