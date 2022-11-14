<script>
import axios from 'axios';
export default {
    data() {
        return {
            transactions: [],
        }
    },
    methods: {
        loadTransactions() {
            axios.get('transactions/list').then(response => this.transactions = response.data);
        },
        dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)
            return myDate
        }
    },
    mounted: function () {
        this.loadTransactions();
    }
}
</script>
<template>
    <div class="">
        <div class="py-4 flex items-center justify-between">
            <div>
                <div class="text-white text-3xl font-medium">Transactions</div>
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


        <table class="w-full bg-myDark-200 rounded-lg overflow-hidden">
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

            <tbody>
                <tr v-for="(item, index) in transactions" class="border-b border-myDark-100 hover:bg-myDark-100">
                    <td class="pl-8 py-2">{{ index + 1 }}</td>
                    <td>{{ dateConvert(item.created_at).date }}</td>
                    <!-- <td class="pl-3 py-2">Date</td> -->
                    <td class="pl-3 py-2">{{ item.title }}</td>
                    <td class="pl-3 py-2">{{ item.ammount }}</td>
                    <td class="pl-3 py-2">{{ item.category }}</td>
                    <td class="pl-3 py-2 text-myDark-300 font-semibold text-sm">
                        <span class="bg-myGreen rounded-full px-2" v-if="item.type === 'Income'">{{
                                item.type
                        }}</span>
                        <span class="bg-myRed rounded-full px-2" v-if="item.type === 'Expances'">{{
                                item.type
                        }}</span>
                        <span class="bg-myBlue rounded-full px-2" v-if="item.type === 'Savings'">{{
                                item.type
                        }}</span>
                    </td>
                    <td class="flex items-center gap-2 pl-3 py-2">
                        <div class="cursor-pointer hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                viewBox="0 0 256 256">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <path
                                    d="M96,216H48a8,8,0,0,1-8-8V163.3a7.9,7.9,0,0,1,2.3-5.6l120-120a8,8,0,0,1,11.4,0l44.6,44.6a8,8,0,0,1,0,11.4Z"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16"></path>
                                <line x1="216" y1="216" x2="96" y2="216" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                <line x1="136" y1="64" x2="192" y2="120" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                            </svg>
                        </div>
                    </td>
                </tr>
            </tbody>
            <!-- <tfoot class="relative">
                            <a :href="route('transactions')" class="absolute top-0 left-0 block text-white">
                            <tr class="flex gap-3 py-3 pl-8">
                                <span>
                                    View More
                                </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none"></rect>
                                        <line x1="40" y1="128" x2="216" y2="128" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                        <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline>
                                    </svg>
                                </span>
                            </tr>
                            </a>
                        </tfoot> -->
        </table>
    </div>
</template>