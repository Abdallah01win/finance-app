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
    limit: '',
    type: '',
});

const submit = () => {
    form.post(route('categories/add'), {
        onFinish: () => form.reset('title', 'limit', 'type'),
    });
};
</script>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            categories: [],
        }
    },
    methods: {
        loadCategories() {
            axios.get('transactions/list').then(response => this.categories = response.data);
        }
    },
    mounted: function () {
        this.loadCategories();
    }
}
</script> 
<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mb-6">
                    <h3 class="text-xl font-bold mb-3">Expances Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 grow">
                                <div class="mb-2 font-semibold text-lg">Title</div>
                                <div class="flex flex-col gap-y-2">
                                    <div class="flex justify-between items-center ">
                                        <div>Total</div>
                                        <div>limit</div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>Last Updated</div>
                                        <div>Edit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 grow text-center">D1</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Income Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Investment Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                    </div>
                </div>

                <!-- form -->
                <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mt-4 w-full">
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required
                                autofocus autocomplete="" />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        
                            <div class="mt-4 w-full">
                                <InputLabel for="limit" value="Limit" />
                                <TextInput id="limit" type="number" class="mt-1 block w-full" v-model="form.limit"
                                     autocomplete="" />
                                <InputError class="mt-2" :message="form.errors.limit" />
                            </div>
                        
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

                        <div class="flex items-center justify-end mt-4">

                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Add Category
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
    