<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import TransactionForm from '@/Components/TransactionForm.vue';
import TransactionsTable from "@/Components/TransactionsTable.vue";
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
                TransactionsTable
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

        <div class="py-12 mx-8">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-white text-3xl font-medium ">{{ $page.props.auth.user.name }}'s Transactions</h1>
                <button
                    class="grid place-content-center p-4 mr-2 bg-myDark-200 hover:bg-myDark-100 text-white opacity-50 hover:opacity-100 rounded-full"
                    @click="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none"></rect>
                        <line x1="40" y1="128" x2="216" y2="128" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                        <line x1="128" y1="40" x2="128" y2="216" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                    </svg>
                </button>
            </div>
            <TransactionsTable />

        </div>
        <TransactionForm />
    </AuthenticatedLayout>
</template>