<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import TransactionsTable from "@/Components/TransactionsTable.vue";
import { onMounted } from 'vue';
import Chart from 'chart.js/auto';

onMounted(() => {
    fetch('transactions.lineChart').then((response) => {
        return response.json();
    }).then((data) => {
        function dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)
            return myDate
        }
        const ctx = document.getElementById('myChart').getContext('2d');
        if (ctx) {
            // Get the unique types from the transaction_totals object
            const types = [...new Set(Object.values(data).flatMap(Object.keys))];
            // Initialize an object to hold the data for each type
            const typeData = {};
            // Loop through each type and create an array of data points for each type
            types.forEach((type) => {
                typeData[type] = {
                    label: type,
                    data: [],
                    pointRadius: 0,
                    borderWidth: 2,
                    borderColor: type === "Expances" ? "#e50201ff" : type === "Savings" ? "#2f66eeff" : "#1fbe6dff",
                };
                // Loop through each day and get the total amount for the current type and day
                Object.entries(data).forEach(([date, values]) => {
                    const amount = values[type] || 0; // If the type does not exist for the current day, set the amount to 0
                    const formattedDate = dateConvert(date).date;
                    typeData[type].data.push({ x: formattedDate, y: amount });
                });
            });
            const myChart = new Chart(ctx, {
                type: 'line',
                id: 'myChart',
                data: {
                    datasets: Object.values(typeData),
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
    const legendItems = document.querySelectorAll('.legend-item');
    legendItems.forEach((item) => {
        item.addEventListener('click', () => {
            const chart = Chart.getChart('myChart');
            const clickedLabel = item.getAttribute('data-label');
            chart.data.datasets.forEach((set) => {
                if (set.label === clickedLabel) {
                    const datasetIndex = chart.data.datasets.indexOf(set);
                    if (datasetIndex !== -1) {
                        const meta = chart.getDatasetMeta(datasetIndex);
                        meta.hidden = !meta.hidden;
                        chart.update();
                        item.classList.toggle('line-through')
                        item.firstElementChild.classList.toggle('bg-white/40')
                    }
                }
            })
        });
    })
})
</script>
<script>
export default {
    data() {
        return {
            incomeTarget: true,
            expancesTarget: true,
            savingsTarget: false,
            components: {
                TransactionsTable,
            },
            typeData: ''
        }
    },
    props: {
        categories: Object,
    },
    methods: {
        calcPercent(total, fr) {
            let myPercent = {}
            let ret = Math.floor(((fr * 100) / total))
            myPercent.ret = ret
            myPercent.width = ret <= 100 ? `width: ${ret}%` : 'width: 100%'
            return myPercent
        },
        dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)

            return myDate
        }
    }
}
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>

        <div class="">

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
                        <div class="flex items-center text-sm py-2 px-3 bg-myDark-300 rounded-lg border border-myDark-100">
                            <div class="flex items-center legend-item cursor-pointer" data-label="Income">
                                <span class="w-5 h-5 bg-myGreen border border-myDark-100 mr-2 rounded-md"></span>
                                <span>Income</span>
                            </div>
                            <div class="flex items-center border-x border-myDark-100 mx-3 px-3 legend-item cursor-pointer"
                                data-label="Expances">
                                <span class="w-5 h-5 bg-myRed border border-myDark-100 mr-2 rounded-md"></span>
                                <span>Expances</span>
                            </div>
                            <div class="flex items-center legend-item cursor-pointer" data-label="Savings">
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
                        <div v-for="item in categories" :key="item">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span>
                                        {{ item.type }} Target
                                    </span>
                                    <span>
                                        <div class="bg-myGreen text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center"
                                            :class="{
                                                'bg-myRed/100': item.type == 'Expances',
                                                'bg-myBlue/100': item.type == 'Savings',
                                            }">
                                            <div class="translate-y-[10%]">
                                                {{ Math.floor(((parseInt(item.transactions_sum) *
                                                    100) / parseInt(item.limit))) }}%</div>
                                        </div>
                                    </span>
                                </div>
                                <div class="mb-2 w-full h-4 bg-myDark-300 rounded-full">
                                    <div class="h-4 rounded-full"
                                        :style="calcPercent(item.limit, item.transactions_sum).width" :class="{
                                            'bg-myBlue': item.type == 'Savings',
                                            'bg-myRed': item.type == 'Expances',
                                            'bg-myGreen': item.type == 'Income',
                                        }"></div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>{{ item.transactions_sum }} USD</span>
                                    <span>{{ item.limit }} USD</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- End Chart Sec -->
            <!-- Transactions Table -->
            <TransactionsTable />
            <!-- End Transactions Table -->
        </div>
    </AuthenticatedLayout>
</template>
<style>
select {
    background-image: url(../../../storage/assets/caret-down.svg) !important;
    background-size: 1.3rem 1.3rem !important;
}
</style> 