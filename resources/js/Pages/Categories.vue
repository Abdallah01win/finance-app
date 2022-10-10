<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/inertia-vue3';
import CategoryForm from '@/Components/CategoryForm.vue';
import CategoryCard from '@/Components/CategoryCard.vue';

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
        CategoryCard
    },
    data() {
        return {
            expances: [],
            income: [],
            investments: [],
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
                        this.investments.push(element);
                    }
                });
            });
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
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold mb-4">Categories</h1>
                    <button class="p-4 mr-2 bg-gray-800 rounded-full" @click="close">
                        <img src="../../../storage/assets/plus-w.svg" alt="" class="w-6">
                    </button>
                </div>
                <div class="mb-6">
                    <h3 class="mb-2 font-semibold text-xl">Expances Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <CategoryCard :data="expances" />                  
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="mb-2 font-semibold text-xl">Income Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <CategoryCard :data="income" />
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="mb-2 font-semibold text-xl">Investment Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <CategoryCard :data="investments" />                  
                    </div>
                </div>
            </div>
        </div>
        <CategoryForm />
    </AuthenticatedLayout>
</template>
    