<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import  TransactionsTable from "@/Components/TransactionsTable.vue";
import { onMounted } from 'vue';
import Chart from 'chart.js/auto';

onMounted(() => {
    fetch('transactions/lineChart').then((response) => {
        return response.json();
    }).then((data) => {
        const ctx = document.getElementById('myChart').getContext('2d');
        if (ctx) {
            let days = []
            let income = []
            let expances = []
            let Savings = []
            for (let i = 0; i < data.length; i++) {
                const element = data[i];
                days.push(element.date);
                (element.type === 'Income') ? income.push(element) : (element.type === 'Expances') ? expances.push(element) : Savings.push(element);
            }
            //console.log(expances, income, days);
            let expancesData = []
            let incomeData = []
            let investmentsData = []
            /*for (let i = 0; i < days.length; i++) {
                const element = days[i];
                for (let x = 0; x < expances.length; x++) {
                    const el = expances[x];
                    if (element == el.date) {
                        expancesData.splice(i, 0, el.amount)
                    } else {
                        expancesData.splice(i, 0, 0)
                    }
                }
            }*/
            for (let i = 0; i < expances.length; i++) {
                const element = expances[i];
                expancesData.push(element.amount)
            }
            for (let i = 0; i < income.length; i++) {
                const element = income[i];
                incomeData.push(element.amount)
            }
            for (let i = 0; i < Savings.length; i++) {
                const element = Savings[i];
                investmentsData.push(element.amount)
            }
            console.log(expancesData)
            console.log(incomeData)
            console.log(investmentsData)
            console.log('this is bullshit')

            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: days,
                    datasets: [{
                        label: 'Income',
                        data: incomeData,
                        pointRadius: 0,
                        borderColor: [
                            '#1fbe6dff',
                        ],
                        borderWidth: 2
                    },
                    {
                        label: 'Expances',
                        data: expancesData,
                        pointRadius: 0,
                        borderColor: [
                            '#e50201ff',
                        ],
                        borderWidth: 2
                    },
                    {
                        label: 'Savings',
                        data: [1500, 1400, 3000],
                        pointRadius: 0,
                        borderColor: [
                            '#2f66eeff',
                        ],
                        borderWidth: 2
                    },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderColor: '#181818ff',
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Poppins',
                                    size: 14,
                                }
                            }
                        },
                        x: {
                            grid: {
                                borderColor: '#181818ff',
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Poppins',
                                    size: 14,
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        }
    })
})
</script>
<script>
//import axios from 'axios';
export default {
    data() {
        return {
            //transactions: [],
            incomeTarget: true,
            expancesTarget: true,
            savingsTarget: false,
            components: {
                TransactionsTable,
            },
        }
    },
    methods: {
        /*loadTransactions() {
            axios.get('transactions/list').then(response => this.transactions = response.data);
        },*/
        dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)
            
            return myDate
        }
    },
    mounted: function () {
        //this.loadTransactions();
    }
}
</script>
<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-5 flex items-center justify-between">
                    <div>
                        <div class="mb-1">Wellcome back!</div>
                        <div class="text-white text-3xl font-medium">{{ $page.props.auth.user.name }}'s Dashboard</div>
                    </div>
                    <div>button</div>
                </div>
                <!-- General stats sec -->
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-myDark-200 overflow-hidden rounded-lg border border-myDark-100">
                        <div class="p-6 hover:bg-myDark-100">
                            <div>Income</div>
                            <div class="flex items-center gap-2 text-3xl text-white mt-1 font-medium">
                                <span>253k</span>
                                <span class="uppercase ">USD</span>
                                <!-- lable component -->
                                <div
                                    class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">
                                    <div class="translate-y-[10%]">30%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-myDark-200 hover:bg-myDark-100 overflow-hidden rounded-lg border border-myDark-100">
                        <div class="p-6 hover:bg-myDark-100">
                            <div>Savings</div>
                            <div class="flex items-center gap-2 text-3xl text-white mt-1 font-medium">
                                <span>253k</span>
                                <span class="uppercase ">USD</span>
                                <!-- lable component -->
                                <div
                                    class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">
                                    <div class="translate-y-[10%]">30%</div>
                                </div>
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
                                <div
                                    class="bg-myRed text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">
                                    <div class="translate-y-[10%]">30%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End General stats sec -->

                <!-- Charts section -->
                <div class="w-full grid grid-cols-[3fr,1.3fr] gap-6 my-6">
                    <div class="rounded-lg bg-myDark-200 border border-myDark-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="text-white text-2xl font-medium">Statistics</div>
                            <div
                                class="flex items-center text-sm py-2 px-3 bg-myDark-300 rounded-lg border border-myDark-100">
                                <div class="flex items-center">
                                    <span class="w-5 h-5 bg-myGreen border border-myDark-100 mr-2 rounded-md"></span>
                                    <span>Income</span>
                                </div>
                                <div class="flex items-center border-x border-myDark-100 mx-3 px-3">
                                    <span class="w-5 h-5 bg-myRed border border-myDark-100 mr-2 rounded-md"></span>
                                    <span>Expances</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-5 h-5 bg-myBlue border border-myDark-100 mr-2 rounded-md"></span>
                                    <span>Savings</span>
                                </div>
                            </div>
                        </div>
                        <canvas id="myChart" height="250" class="w-full"></canvas>
                    </div>
                    <!-- Statistics -->
                    <div class="rounded-lg bg-myDark-200 p-6 border border-myDark-100">
                        <div class="flex items-center justify-between mb-6">
                            <div class="text-white text-2xl font-medium">Analytics</div>
                            <Link :href="route('analytics')">
                            <div class="flex gap-1 py-3 text-xs">
                                <span>
                                    View More
                                </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                        viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none"></rect>
                                        <line x1="40" y1="128" x2="216" y2="128" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                        <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline>
                                    </svg>
                                </span>
                            </div>
                            </Link>
                        </div>
                        <div class="flex flex-col gap-y-4 text-sm">
                            <div v-if="this.incomeTarget">
                                <div class="flex items-center justify-between mb-2">
                                    <span>
                                        Income Target
                                    </span>
                                    <span>
                                        <div
                                            class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">
                                            <div class="translate-y-[10%]">30%</div>
                                        </div>
                                    </span>
                                </div>
                                <div class="mb-2 w-full h-4 bg-myDark-100 rounded-full">
                                    <div class="h-4 bg-myGreen rounded-full" style="width: 45%"></div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>2K USD</span>
                                    <span>4K USD</span>
                                </div>
                            </div>
                            <div v-else class="text-center text-white">No Analytics for now. Set your Targets in <span class="underline">
                                    <Link :href="route('settings')">Settings.</Link>
                                </span>.</div>
                            <div v-if="this.expancesTarget">
                                <div class="flex items-center justify-between mb-2">
                                    <span>
                                        Expances Target
                                    </span>
                                    <span>
                                        <div
                                            class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">
                                            <div class="translate-y-[10%]">20%</div>
                                        </div>
                                    </span>
                                </div>
                                <div class="mb-2 w-full h-4 bg-myDark-100 rounded-full">
                                    <div class="h-4 bg-myRed rounded-full" style="width: 20%"></div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>2K USD</span>
                                    <span>4K USD</span>
                                </div>
                            </div>
                            <div v-if="(this.expancesTarget != true) && (this.incomeTarget == true)"
                                class="text-center text-white">Set your Targets in <span class="underline">
                                    <Link :href="route('settings')">Settings.</Link>
                                </span></div>
                            <div v-if="this.savingsTarget">
                                <div class="flex items-center justify-between mb-2">
                                    <span>
                                        Savings Target
                                    </span>
                                    <span>
                                        <div
                                            class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center">
                                            <div class="translate-y-[10%]">80%</div>
                                        </div>
                                    </span>
                                </div>
                                <div class="mb-2 w-full h-4 bg-myDark-100 rounded-full">
                                    <div class="h-4 bg-myBlue rounded-full" style="width: 80%"></div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>2K USD</span>
                                    <span>4K USD</span>
                                </div>
                            </div>
                            <div v-if="(this.savingsTarget != true) && (this.incomeTarget == true) && (this.expancesTarget == true)"
                                class="text-center text-white">Set Savings Target in <span class="underline">
                                    <Link :href="route('settings')">Settings.</Link>
                                </span> </div>
                        </div>
                    </div>

                </div>
                <!-- End Chart Sec -->
                <!-- Transactions Table -->
                <TransactionsTable />
                <!-- End Transactions Table -->
                
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


/* Doughnut Chart data query */
//SELECT SUM(ammount), type, created_at FROM `transactions` GROUP BY type;


/* Line Chart data query */
//SELECT SUM(ammount) as amount, type, substr(created_at, 1, 10) as date FROM `transactions` GROUP BY substr(created_at, 1, 10); 