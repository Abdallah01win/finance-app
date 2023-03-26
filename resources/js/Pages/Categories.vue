<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/inertia-vue3';
import CategoryForm from '@/Components/CategoryForm.vue';
import CategoryCard from '@/Components/CategoryCard.vue';
import Dialoge from '@/Components/Dialoge.vue';
</script>

<script>
export default {
    props:{
        categories: Object,
    },
    components: {
        CategoryForm,
        CategoryCard,
        Dialoge,
        AuthenticatedLayout,
    },
    data() {
        return {
            expances: Array,
            savings: Array,
            income: Array,
            itemId: "",
        }
    },
    methods: {
        filterCategories(categories) {
            this.expances = categories.filter(element => element.type === "Expances");
            this.income = categories.filter(element => element.type === "Income");
            this.savings = categories.filter(element => element.type === "Savings");
        },
        getItemId(val) {
            this.itemId = val;
        }
    },
    mounted: function (){
        this. filterCategories(this.categories)
    }
}
</script> 
<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <div>
            <div v-if="expances.length !== 0" class="mb-6  bg-myDark-200 py-6 px-6 rounded-lg">
                <h3 class="mb-3 text-xl">Expances</h3>
                <div class="grid grid-cols-3 gap-6 ">
                    <CategoryCard :type="'expances'" :data="expances" @itemId="getItemId" />
                </div>
            </div>
            <div v-if="income.length !== 0" class="mb-6 bg-myDark-200 py-6 px-6 rounded-lg">
                <h3 class="mb-3 text-xl">Income</h3>
                <div class="grid grid-cols-3 gap-6">
                    <CategoryCard :type="'income'" :data="income" @itemId="getItemId" />
                </div>
            </div>
            <div v-if="savings.length !== 0" class="mb-6 bg-myDark-200 py-6 px-6 rounded-lg">
                <h3 class="mb-3 text-xl">Savings</h3>
                <div class="grid grid-cols-3 gap-6">
                    <CategoryCard :type="'savings'" :data="savings" @itemId="getItemId" />
                </div>
            </div>
            <div v-if="!income && !expances && !savings" class="text-xl text-center mt-8">
                No Categories to display for now!
            </div>
        </div>
        <CategoryForm />
        <Dialoge :title="'Confirm Delete'" :id="'confirmDelete'" :msg="'Are You Sure You want to delete this category?'"
            :itemId="itemId" />
    </AuthenticatedLayout>
</template>
    