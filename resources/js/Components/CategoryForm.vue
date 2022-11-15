<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    title: '',
    limit: '',
    type: '',
});

const submit = () => {
    form.post(route('categories/add'), {
        onFinish: () => {
            form.reset('title', 'limit', 'type')
            close('formHolder')
        },
    });
};
const close = (id) => {
    const formHolder = document.getElementById(id);
    formHolder.classList.toggle('hidden');
}
</script>

<template>
    <div @click.self="close('formHolder')" class="bg-myDark-300/90 absolute top-0 left-0 w-full h-screen z-10 hidden" id="formHolder">
        <div class=" bg-myDark-100 overflow-hidden shadow-sm sm:rounded-lg px-10 py-8 w-[50%] mx-auto translate-y-[50%]">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-2xl text-white">Creat a New Category</h3>
                <button class="p-2 bg-gray-200 rounded-full" @click="close('formHolder')">
                    <img src="../../../storage/assets/close.svg" alt="" class="w-6">
                </button>
            </div>
            <form @submit.prevent="submit">
                <div class="mt-4 w-full">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                        autocomplete="" />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>

                <div class="mt-4 w-full">
                    <InputLabel for="limit" value="Target" />
                    <TextInput id="limit" type="number" min="0" class="mt-1 block w-full" v-model="form.limit"
                        autocomplete="" />
                    <InputError class="mt-2" :message="form.errors.limit" />
                </div>

                <div class="mt-4 w-full">
                    <InputLabel for="type" value="Type" />
                    <select name="type" id="type"
                        class="mt-1 block w-full border-none focus:border-none focus:ring focus:ring-myBlue rounded-md bg-myDark-200 text-white"
                        v-model="form.type">
                        <option value="Income">Income</option>
                        <option value="Expances">Expances</option>
                        <option value="Savings">Savings</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <div class="flex items-center justify-end mt-6">

                    <PrimaryButton type="button" class="ml-4" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Cancel
                    </PrimaryButton>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add Category
                    </PrimaryButton>

                </div>
            </form>
        </div>
    </div>
</template>