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
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    /*form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });*/
};
</script>
            
<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-xl font-bold mb-3">Transactions</div>
                <div class="flex gap-8 justify-between">

                    <div class="w-[65%] bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="mb-2 font-semibold text-lg">Add New Transaction</div>
                        <form @submit.prevent="submit">
                            <div class="flex gap-4">
                                <div class="w-full">
                                    <InputLabel for="title" value="Title" />
                                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.email"
                                        required autofocus autocomplete="" />
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div class="w-full">
                                    <InputLabel for="date" value="date" />
                                    <TextInput id="date" type="date" class="mt-1 block w-full" v-model="form.email"
                                        required autofocus autocomplete="" />
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="description" value="Description" />
                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.password" required autocomplete="" />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="flex gap-4">
                                <div class="mt-4 w-full">
                                    <InputLabel for="type" value="Type" />
                                    <TextInput id="type" type="text" class="mt-1 block w-full" v-model="form.password"
                                        required autocomplete="" />
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                                <div class="mt-4 w-full">
                                    <InputLabel for="category" value="Category" />
                                    <TextInput id="category" type="text" class="mt-1 block w-full"
                                        v-model="form.password" required autocomplete="" />
                                    <InputError class="mt-2" :message="form.errors.description" />
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

                        <div class="flex flex-col mt-3 gap-y-2">
                            <div class="flex justify-between items-center border-b border-gray-100 p-2">
                                <div class="flex flex-col ">
                                    <span class="font-bold">Transaction Title</span>
                                    <span class="text-sm text-gray-600">Category</span>
                                </div>
                                <div class="font-bold">-$100</div>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 p-2">
                                <div class="flex flex-col ">
                                    <span class="font-bold">Transaction Title</span>
                                    <span class="text-sm text-gray-600">Category</span>
                                </div>
                                <div class="font-bold">-$100</div>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 p-2">
                                <div class="flex flex-col ">
                                    <span class="font-bold">Transaction Title</span>
                                    <span class="text-sm text-gray-600">Category</span>
                                </div>
                                <div class="font-bold">-$100</div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Add transaction form -->
                <!-- transaction History as table -->
                <!-- order by date option -->
                <!-- order by amout option -->

            </div>
        </div>
    </AuthenticatedLayout>
</template>