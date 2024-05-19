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

const props = defineProps(['car'])

const creatingRental = ref(false);
const startDateInput = ref(null);

const form = useForm({
    car_id: props.car.id,
    start_date: '',
    end_date: '',
});

const createRentalForm = () => {
    creatingRental.value = true;

    nextTick(() => startDateInput.value.focus());
};

const createCar = async () => {
    form.post(route('rental.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: (err) => console.log(err)
    });
};

const closeModal = () => {
    creatingRental.value = false;
    form.reset();
};
</script>

<template>
    <PrimaryButton @click="createRentalForm">Rental Car</PrimaryButton>

    <Modal :show="creatingRental" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create Car
            </h2>

            <form @submit.prevent="createCar">
                <div v-if="form.errors.booked" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    <span class="font-medium">Your rental date was Booked!</span>
                </div>

                <div class="mt-6">
                    <InputLabel for="start_date" value="Start Date" required />

                    <TextInput
                        id="start_date"
                        ref="startDateInput"
                        v-model="form.start_date"
                        type="date"
                        class="mt-1 block w-full"
                        placeholder="Start Date"
                    />

                    <InputError :message="form.errors.start_date" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="end_date" value="End Date" required />

                    <TextInput
                        id="end_date"
                        v-model="form.end_date"
                        type="date"
                        class="mt-1 block w-full"
                        placeholder="End Date"
                    />

                    <InputError :message="form.errors.end_date" class="mt-2" />
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
