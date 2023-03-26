<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import TransactionForm from '@/Components/TransactionForm.vue';
import TransactionsTable from "@/Components/TransactionsTable.vue";
import { Head, useForm } from '@inertiajs/inertia-vue3';


</script>
<script>
export default {
    data() {
        return {
            components: {
                TransactionForm,
                TransactionsTable
            },
        }
    },
    props:{
        categories: Object,
    },

}
</script>
            
<template>
    <Head title="Transactions" />
    <AuthenticatedLayout>
        <TransactionsTable />
        <TransactionForm :categories="categories" />
    </AuthenticatedLayout>
</template>