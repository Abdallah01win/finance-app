<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/inertia-vue3';
import CategoryForm from '@/Components/CategoryForm.vue';
import CategoryCard from '@/Components/CategoryCard.vue';
import Dialoge from '@/Components/Dialoge.vue';
const close = () => {
    const formHolder = document.getElementById('formHolder');
    formHolder.classList.toggle('hidden');
}
</script>
<script>
import axios from 'axios';
export default {
    components: {
        CategoryForm,
        CategoryCard,
        Dialoge,
    },
    data() {
        return {
            expances: [],
            income: [],
            savings: [],
            itemId: Number,
        }
    },
    methods: {
        loadCategories() {
            axios.get('categories/list').then((response) => {
                let categories = response.data
                categories.forEach(element => {
                    if (element.type === "Expances") {
                        this.expances.push(element);
                    } else if (element.type === "Income") {
                        this.income.push(element);
                    } else {
                        this.savings.push(element);
                    }
                });
            });
        },
        getItemId(val) {
            console.log(val)
            this.itemId = val;
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
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-white text-3xl font-medium ">Categories</h1>
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
                <div class="mb-6  bg-myDark-200 py-6 px-6 rounded-lg">
                    <h3 class="mb-3 text-xl">Expances</h3>
                    <div class="grid grid-cols-3 gap-6">
                        <CategoryCard :type="'expances'" :data="expances" @itemId="getItemId" />
                    </div>
                </div>
                <div class="mb-6 bg-myDark-200 py-6 px-6 rounded-lg">
                    <h3 class="mb-3 text-xl">Income</h3>
                    <div class="grid grid-cols-3 gap-6">
                        <CategoryCard :type="'income'" :data="income" @itemId="getItemId" />
                    </div>
                </div>
                <div class="mb-6 bg-myDark-200 py-6 px-6 rounded-lg">
                    <h3 class="mb-3 text-xl">Investment</h3>
                    <div class="grid grid-cols-3 gap-6">
                        <CategoryCard :type="'savings'" :data="savings" @itemId="getItemId" />
                    </div>
                </div>
            </div>
        </div>
        <CategoryForm />
        <Dialoge :title="'Confirm Delete'" :id="'confirmDelete'" :msg="'Are You Sure You want to delete this category?'"
            :itemId="itemId" />
    </AuthenticatedLayout>
</template>
    