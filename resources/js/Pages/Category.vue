<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, computed } from 'vue';
</script>

<script>
export default {
    props: {
        groupedCategories: '',
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)
            return myDate
        },
    },
    data() {
        return {
            selectedGroupedCategory: this.groupedCategories[0],
            selectedTimeSpan: Object.keys(this.groupedCategories[0].transactions)[0],
        };
    },
    computed: {
        timeSpans() {
            return Object.keys(this.selectedGroupedCategory.transactions);
        },
        selectedTransactions() {
            return this.selectedGroupedCategory.transactions[this.selectedTimeSpan];
        },
    },
};
</script>
        
<template>
    <Head title="Category" />

    <AuthenticatedLayout>

        <div class="py-12">
            <Link :href="route('category/show')" method="post" as="button"
                :data="{ id: selectedGroupedCategory.category.id, timeSpan: 'month' }">Month format</Link>

           <!--  <h2>{{ groupedCategories.category.title }}</h2> -->

            <div class="w-full grid grid-cols-[1fr,.7fr] gap-6 my-6">
                <div class="bg-myDark-200 rounded-lg overflow-hidden"></div>

                <div class="rounded-lg bg-myDark-200 p-6">
                    <div class="text-white text-xl font-medium">Transactions</div>
                    <select v-model="selectedTimeSpan">
                        <option v-for="(timeSpan, index) in timeSpans" :value="timeSpan" :key="index">{{ timeSpan }}</option>
                    </select>
                    <!-- <div v-for="(transactions, index) in selectedTransactions" :key="index"
                        class="py-4 flex flex-col /items-center justify-between"> -->
                        <!-- <h3>{{ timeSpan }}</h3> -->
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-myDark-100">
                                    <td class="pl-3 py-4 text-white capitalize">#</td>
                                    <td class="pl-3 py-4 text-white capitalize ">title</td>
                                    <td class="pl-3 py-4 text-white capitalize ">Amount</td>
                                    <td class="pl-3 py-4 text-white capitalize">Date</td>
                                    <td class="pl-3 py-4 text-white capitalize ">Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in selectedTransactions" :key="index"
                                    class="border-b border-myDark-100 hover:bg-myDark-100">
                                    <td class="pl-3 py-2">{{ index + 1 }}</td>
                                    <td class="pl-3 py-2">{{ item.title }}</td>
                                    <td class="pl-3 py-2">{{ item.ammount }}</td>
                                    <td class="pl-3 py-2">{{ dateConvert(item.date).date }}</td>
                                    <td class="flex items-center gap-2 pl-3 py-2">
                                        <div class="cursor-pointer hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <line x1="216" y1="56" x2="40" y2="56" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                                <line x1="88" y1="24" x2="168" y2="24" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                                <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none"
                                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="16"></path>
                                            </svg>
                                        </div>

                                        <div class="cursor-pointer hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <path
                                                    d="M96,216H48a8,8,0,0,1-8-8V163.3a7.9,7.9,0,0,1,2.3-5.6l120-120a8,8,0,0,1,11.4,0l44.6,44.6a8,8,0,0,1,0,11.4Z"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16"></path>
                                                <line x1="216" y1="216" x2="96" y2="216" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                                <line x1="136" y1="64" x2="192" y2="120" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>