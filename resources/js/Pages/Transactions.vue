<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

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
        onFinish: () => form.reset('title', 'ammount', 'category', 'date', 'description', 'type'),
    });
};
</script>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            transactions: [],
        }
    },
    methods: {
        loadTransactions() {
            axios.get('transactions/list').then(response => this.transactions = response.data);
        }
    },
    mounted: function () {
        this.loadTransactions();
    }
}
</script>
            
<template>

    <Head title="Transactions" />
    <AuthenticatedLayout>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-xl font-bold mb-3">Transactions</div>
                <div class="flex gap-8 justify-between">

                    <div class="w-[65%] bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 h-fit">
                        <div class="mb-2 font-semibold text-lg">Add New Transaction</div>
                        <form @submit.prevent="submit">
                            <div class="w-full">
                                <InputLabel for="title" value="Title" />
                                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title"
                                    required autofocus autocomplete="" />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="description" value="Description" />
                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" autocomplete="" />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div class="flex gap-4 mt-4">
                                <div class="w-full">
                                    <InputLabel for="ammount" value="Ammount" />
                                    <TextInput id="ammount" type="number" class="mt-1 block w-full"
                                        v-model="form.ammount" required autocomplete="" />
                                    <InputError class="mt-2" :message="form.errors.ammount" />
                                </div>
                                <div class="w-full">
                                    <InputLabel for="date" value="Date" />
                                    <TextInput id="date" type="date" class="mt-1 block w-full" v-model="form.date"
                                        required autofocus />
                                    <InputError class="mt-2" :message="form.errors.date" />
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="mt-4 w-full">
                                    <InputLabel for="type" value="Type" />
                                    <select name="type" id="type"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        v-model="form.type">
                                        <option value="Income">Income</option>
                                        <option value="Expances">Expances</option>
                                        <option value="Investments">Investments</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.type" />
                                </div>
                                <div class="mt-4 w-full">
                                    <InputLabel for="category" value="Category" />
                                    <TextInput id="category" type="text" class="mt-1 block w-full"
                                        v-bind:disabled="form.type == ''" v-model="form.category" required
                                        autocomplete="" />
                                    <InputError class="mt-2" :message="form.errors.category" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Add Transaction
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                    <div class="w-[35%] bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="mb-2 flex justify-between items-center">
                            <span class="font-semibold text-lg">History</span>
                            <Dropdown align="right" width="30">
                                <template #trigger>
                                    <span class="cursor-pointer text-gray-500">Filter By</span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Ammount
                                    </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Date
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>

                        <div class="flex gap-4 items-center mt-4">
                            <div class="border-b-2 border-black p-2 text-sm font-bold cursor-pointer">All</div>
                            <div class="p-2 text-sm font-bold cursor-pointer">Income</div>
                            <div class="p-2 text-sm font-bold cursor-pointer">Expances</div>
                            <div class="p-2 text-sm font-bold cursor-pointer">Investments</div>
                        </div>

                        <div class="flex flex-col mt-3 gap-y-2" v-for="(item, index) in transactions">
                            <div class="flex justify-between items-center border-b border-gray-100 p-2">
                                <div class="flex flex-col ">
                                    <span class="font-bold capitalize">{{ item.title }}</span>
                                    <span class="text-sm text-gray-600 capitalize">{{ item.category }}</span>
                                </div>
                                <div class="font-bold capitalize">${{ item.ammount }}</div>
                            </div>
                        </div>
                        <div class="flex gap-2 items-center p-2 pb-0 mt-4 cursor-pointer">
                            <div class="text-sm font-bold">View All</div>
                            <img src="../../../storage/assets/arrow-right.svg" alt="" class="w-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>