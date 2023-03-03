<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    title: '',
    date: '',
    description: '',
    type: '',
    category: '',
    ammount: '',
});

const submit = () => {
    form.post(route('transactions/add'), {
        onFinish: () => {
            form.reset('title', 'ammount', 'category', 'date', 'description', 'type')
            close('TransactionFormHolder')
        },
    });
};
const close = (id) => {
    const formHolder = document.getElementById(id);
    formHolder.classList.toggle('hidden');
}
</script>

<script>
export default {
    data() {
        return {

        }
    },
    props: {
        categories: Object,
    }
}
</script>


<template>
    <div @click.self="close('TransactionFormHolder')"
        class="bg-myDark-300/90 fixed top-0 left-0 w-full h-screen z-10 hidden" id="TransactionFormHolder">
        <div class=" bg-myDark-100 overflow-hidden shadow-sm sm:rounded-lg px-10 py-8 w-[50%] mx-auto translate-y-[25%]">
            <div class="h-fit">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-2xl text-white">Add New Transaction</h3>
                    <button class="p-2 bg-gray-200 rounded-full" @click="close('TransactionFormHolder')">
                        <img src="../../../storage/assets/close.svg" alt="" class="w-6">
                    </button>
                </div>
                <form @submit.prevent="submit">
                    <div class="w-full">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                            autocomplete="" />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="description" value="Description" />
                        <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                            autocomplete="" />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="flex gap-4 mt-4">
                        <div class="w-full">
                            <InputLabel for="ammount" value="Ammount" />
                            <TextInput id="ammount" type="number" class="mt-1 block w-full" v-model="form.ammount" required
                                autocomplete="" />
                            <InputError class="mt-2" :message="form.errors.ammount" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="date" value="Date" />
                            <TextInput id="date" type="date" class="mt-1 block w-full" v-model="form.date" required
                                autofocus />
                            <InputError class="mt-2" :message="form.errors.date" />
                        </div>
                    </div>
                    <div class="flex gap-4">
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
                        <div class="mt-4 w-full">
                            <InputLabel for="category" value="Category" />
                            <select id="category"
                                class="mt-1 block w-full border-none focus:border-none focus:ring focus:ring-myBlue rounded-md bg-myDark-200 text-white"
                                v-bind:disabled="form.type == ''" v-model="form.category" required>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                    category.title }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.category" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add Transaction
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>