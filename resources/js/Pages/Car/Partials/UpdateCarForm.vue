<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, usePage} from '@inertiajs/vue3';

const car = usePage().props.car;

const form = useForm({
    brand: car.brand,
    model: car.model,
    plate_number: car.plate_number,
    rental_rate_per_day: car.rental_rate_per_day.toString(),
    is_available: car.is_available,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Candidate Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your candidate information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('car.update', car.id))" class="mt-6 space-y-6">
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
                        <input :checked="form.is_available" value="1" id="bordered-radio-1" type="radio" v-model="form.is_available" name="bordered-radio" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Available</label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded w-full">
                        <input :checked="!form.is_available" value="0" id="bordered-radio-2" type="radio" v-model="form.is_available" name="bordered-radio" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Not Available</label>
                    </div>
                </div>

                <InputError :message="form.errors.is_available" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
