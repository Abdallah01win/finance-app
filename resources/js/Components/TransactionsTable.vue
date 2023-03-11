<script>
import axios from 'axios';
import { Link } from '@inertiajs/inertia-vue3';
import { mapGetters, mapState, mapActions, } from 'vuex';

export default {
    data() {
        return {
            transactions: [],
            page: 1,
            lastPage: 1
        }
    },
    computed: {
        pageNumbers() {
            const from = Math.max(this.page - 2, 1);
            const to = Math.min(this.page + 2, this.lastPage);
            const pages = [];
            for (let i = from; i <= to; i++) {
                pages.push(i);
            }
            return pages;
        }
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)
            return myDate
        },
        fetchData() {
            axios.get('transactions/list?page=' + this.page)
                .then(response => {
                    this.transactions = response.data.data;
                    this.lastPage = response.data.last_page;
                });
        },
        previousPage() {
            this.page--;
            this.fetchData();
        },
        nextPage() {
            this.page++;
            this.fetchData();
        },
        goToPage(pageNumber) {
            this.page = pageNumber;
            this.fetchData();
        }
    },
    mounted: function () {
        //this.getTransactions();
        this.fetchData();
    },
    components: {
        Link,
    }
}
</script>
<template>
    <div class="bg-myDark-200 rounded-lg overflow-hidden">
        <div class="py-4 px-8 flex items-center justify-between">
            <div>
                <div class="text-xl font-medium" :class="{ 'text-2xl text-white': $page.component == 'Dashboard' }">
                    Transactions</div>
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


        <table class="w-full">
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
                <tr v-for="(item, index) in transactions" :key="transactions[index].id"
                    class="border-b border-myDark-100 hover:bg-myDark-100">
                    <td class="pl-8 py-2">{{ index + 1 }}</td>
                    <td>{{ dateConvert(item.date).date }}</td>
                    <td class="pl-3 py-2">{{ item.title }}</td>
                    <td class="pl-3 py-2">{{ item.ammount }}</td>
                    <td class="pl-3 py-2">{{ item.category_name }}</td>
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
                                <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
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
        </table>

        <div class="flex justify-between items-start px-8 py-3">
            <div class="flex items-center gap-4">
                <button :disabled="page === 1" @click="previousPage"
                    :class="{ 'hover:text-white': page !== 1 }">Previous</button>
                <ul class="flex items-center gap-2">
                    <li v-for="pageNumber in pageNumbers" :key="pageNumber">
                        <button :disabled="pageNumber === page" @click="goToPage(pageNumber)"
                            :class="{ 'hover:text-white': pageNumber !== page }">
                            {{ pageNumber }}
                        </button>
                    </li>
                </ul>
                <button :disabled="page === lastPage" @click="nextPage"
                    :class="{ 'hover:text-white': page !== lastPage }">Next</button>
            </div>
        </div>
    </div>
</template>