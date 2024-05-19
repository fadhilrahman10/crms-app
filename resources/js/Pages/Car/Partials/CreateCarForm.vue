<script setup>
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {nextTick, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import axios from "axios";

const creatingCar = ref(false);
const brandInput = ref(null);

const form = useForm({
    brand: '',
    model: '',
    plate_number: '',
    rental_rate_per_day: '',
    is_available: false,
});

const createCarForm = () => {
    creatingCar.value = true;

    nextTick(() => brandInput.value.focus());
};

const createCar = async () => {
    form.post(route('car.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    creatingCar.value = false;
    form.reset();
};
</script>

<template>
    <PrimaryButton @click="createCarForm">Create Car</PrimaryButton>

    <Modal :show="creatingCar" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create Car
            </h2>

            <form @submit.prevent="createCar">
                <div class="mt-6">
                    <InputLabel for="brand" value="Brand" required />

                    <TextInput
                        id="brand"
                        ref="brandInput"
                        v-model="form.brand"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Brand"
                    />

                    <InputError :message="form.errors.brand" class="mt-2" />
                    </div>

                <div class="mt-6">
                    <InputLabel for="model" value="Model" required />

                    <TextInput
                        id="model"
                        v-model="form.model"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Model"
                    />

                    <InputError :message="form.errors.model" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="plate_number" value="Plate Number" required />

                    <TextInput
                        id="plate_number"
                        v-model="form.plate_number"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Plate Number"
                    />

                    <InputError :message="form.errors.plate_number" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="rental_rate_per_day" value="Rental Rate Per Day" required />

                    <TextInput
                        id="rental_rate_per_day"
                        v-model="form.rental_rate_per_day"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Rental Rate Per Day"
                    />

                    <InputError :message="form.errors.rental_rate_per_day" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="is_available" value="Available" required />

                    <div class="flex gap-2">
                        <div class="flex items-center ps-4 border border-gray-200 rounded w-full">
                            <input :checked="form.is_available" value="true" id="bordered-radio-1" type="radio" v-model="form.is_available" name="bordered-radio" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Available</label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded w-full">
                            <input :checked="!form.is_available" value="false" id="bordered-radio-2" type="radio" v-model="form.is_available" name="bordered-radio" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Not Available</label>
                        </div>
                    </div>

                    <InputError :message="form.errors.is_available" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <PrimaryButton
                            class="ms-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Create
                        </PrimaryButton>
                    </div>
            </form>
        </div>
    </Modal>
</template>

<style scoped>

</style>
