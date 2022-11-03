<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            transactions: [],
            components: {
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

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12 overflow-y-scroll h-[91.5vh]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-5 flex items-center justify-between">
                    <div>
                        <div class="mb-1">Wellcome back!</div>
                        <div class="text-white text-3xl font-medium">{{ $page.props.auth.user.name }}'s Dashboard</div>
                    </div>
                    <div>button</div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-myDark-200 overflow-hidden rounded-lg border border-myDark-100">
                        <div class="p-6 hover:bg-myDark-100">
                            <div>Income</div>
                            <div class="flex items-center gap-2 text-3xl text-white mt-1 font-medium">
                                <span>253k</span>
                                <span class="uppercase ">USD</span>
                                <!-- lable component -->
                                <span
                                    class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">30%</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-myDark-200 hover:bg-myDark-100 overflow-hidden rounded-lg border border-myDark-100">
                        <div class="p-6 hover:bg-myDark-100">
                            <div>Investments</div>
                            <div class="flex items-center gap-2 text-3xl text-white mt-1 font-medium">
                                <span>253k</span>
                                <span class="uppercase ">USD</span>
                                <!-- lable component -->
                                <span
                                    class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">30%</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-myDark-200 hover:bg-myDark-100 overflow-hidden rounded-lg border border-myDark-100">
                        <div class="p-6 hover:bg-myDark-100">
                            <div>Expances</div>
                            <div class="flex items-center gap-2 text-3xl text-white mt-1 font-medium">
                                <span>253k</span>
                                <span class="uppercase ">USD</span>
                                <!-- lable component -->
                                <span
                                    class="bg-myRed text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">02%</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mt-4">
                    <div class="py-4 flex items-center justify-between">
                        <div>
                            <div class="text-white text-2xl font-medium">Recent Transactions</div>
                        </div>
                        <form action="#">
                            <select name="sortTransactions" id="sortTransactions"
                                class="bg-myDark-300 rounded-lg text-white outline-none border border-myDark-100 focus:outline-myBlue w-48">
                                <option value="">Newest</option>
                                <option value="">Amount</option>
                                <option value="">Type</option>
                                <option value="">Oldest</option>
                            </select>
                        </form>
                    </div>
                    <table class="w-full  bg-myDark-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="border-b border-myDark-100">
                                <td class="pl-8 py-4 text-white capitalize">#</td>
                                <td class="pl-3 py-4 text-white capitalize">Date</td>
                                <td class="pl-3 py-4 text-white capitalize ">title</td>
                                <td class="pl-3 py-4 text-white capitalize ">Amount</td>
                                <td class="pl-3 py-4 text-white capitalize ">Category</td>
                                <td class="pl-3 py-4 text-white capitalize ">Type</td>
                                <td class="pl-3 py-4 text-white capitalize ">Actions</td>
                            </tr>
                        </thead>

                        <tbody v-for="(item, index) in transactions">
                            <tr class="border-b border-myDark-100 hover:bg-myDark-100">
                                <!-- <td>{{ item.created_at }}</td> -->
                                <td class="pl-8 py-2">{{ index + 1 }}</td>
                                <td class="pl-3 py-2">Date</td>
                                <td class="pl-3 py-2">{{ item.title }}</td>
                                <td class="pl-3 py-2">{{ item.ammount }}</td>
                                <td class="pl-3 py-2">{{ item.category }}</td>
                                <td class="pl-3 py-2 text-myDark-300 font-semibold text-sm">
                                    <span class="bg-myGreen rounded-full px-2" v-if="item.type === 'Income'">{{ item.type }}</span>
                                    <span class="bg-myRed rounded-full px-2" v-if="item.type === 'Expances'">{{ item.type }}</span>
                                    <span class="bg-myBlue rounded-full px-2" v-if="item.type === 'Investments'">{{ item.type }}</span>
                                </td>
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
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
select {
    background-image: url(../../../storage/assets/caret-down.svg) !important;
    background-size: 1.3rem 1.3rem !important;
}
</style>