<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import TransactionForm from '@/Components/TransactionForm.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    title: '',
    date: '',
    description: '',
    type: '',
    category: '',
    ammount: '',
});

const close = () => {
    const formHolder = document.getElementById('TransactionFormHolder');
    formHolder.classList.toggle('hidden');
}
</script>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            transactions: [],
            components: {
                TransactionForm,
            },
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
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold mb-4">Transactions</h1>
                    <button class="p-4 mr-2 bg-gray-800 rounded-full" @click="close">
                        <img src="../../../storage/assets/plus-w.svg" alt="" class="w-6">
                    </button>
                </div>
                <div class="flex gap-8 justify-between">
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
                            <div class="p-2 text-sm font-bold cursor-pointer">Savings</div>
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
        <TransactionForm/>
    </AuthenticatedLayout>
</template>