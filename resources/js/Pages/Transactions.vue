<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import TransactionForm from '@/Components/TransactionForm.vue';
import TransactionsTable from "@/Components/TransactionsTable.vue";
import { Head, useForm } from '@inertiajs/inertia-vue3';


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
        <TransactionsTable />
        <TransactionForm />
    </AuthenticatedLayout>
</template>