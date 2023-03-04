<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import PlusButton from '@/Components/PlusButton.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
const showingNavigationDropdown = ref(false);


const form = useForm({
    title: '',
    date: '',
    description: '',
    type: '',
    category: '',
    ammount: '',
});
</script>
<script>
import { mapGetters } from 'vuex';
import axios from 'axios';
export default {
    computed: mapGetters(['allTodos']),
    data() {
        return {
            balance: Number,
            user: '',
        }
    },
    components: {
        PlusButton
    },
    methods: {
        getBalance() {
            axios.get('users/balance').then((response) => {
                this.balance = response.data[0].balance
            });
        },
        getUser() {
            axios.get('/users').then((response) => {
                this.user = response.data[0]
            });
        },
    },
    mounted: function () {
        this.getBalance();
        this.getUser();
    }
}
</script>

<template>
    <div class="">
        <div class="min-h-screen bg-myDark-300 text-[#808080]">
            <nav class="bg-myDark-200">
                <!-- Primary Navigation Menu -->
                <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <!-- <ApplicationLogo class="block h-9 w-auto" /> -->
                                <div class="font-bold text-3xl">
                                    <span class="text-myBlue">On</span>
                                    <span class="text-white">Point</span>
                                </div>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                            Dashboard
                                        </NavLink>
                                    </div> -->
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">

                            <!-- Settings Dropdown -->
                            <!-- <div class="ml-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <DropdownLink :href="route('logout')" method="post" as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </template>
                                        </Dropdown>
                                    </div> -->
                            <div class="flex items-center">
                                <!-- Search -->
                                <form class="flex items-center">
                                    <input type="text" name="search"
                                        class="bg-myDark-100 rounded-lg text-white outline-none border-0 focus:outline-myBlue placeholder:font-light placeholder:text-base placeholder:text-[#808080] w-[350px]"
                                        placeholder="Search">
                                    <button type="submit" class="w-6 translate-x-[-150%] hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                            <title>Search</title>
                                            <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                stroke-width="32" />
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                                        </svg>
                                    </button>
                                </form>
                                <!-- end Search -->
                                <!-- Balance -->
                                <div class="mr-6">
                                    <span>Balance: </span>
                                    <span class="font-semibold" :class="{
                                        'text-myGreen': balance > 0,
                                        'text-myRed': balance <= 0
                                    }">
                                        {{ balance }} USD
                                    </span>
                                </div>
                                <!-- End Balance -->
                                <!-- user -->
                                <div class="bg-myDark-100 rounded-lg hover:text-white cursor-pointer overflow-hidden">
                                    <div class="w-10 h-10 p-2" v-if="user.image == null">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                            <title>Person</title>
                                            <path
                                                d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32" />
                                            <path
                                                d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                                                fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                stroke-width="32" />
                                        </svg>
                                    </div>
                                    <div class="w-10 h-10">
                                        <img :src="user.image" alt="" class="w-full h-full">
                                    </div>
                                </div>
                                <!-- end user -->
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path
                                        :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Responsive Navigation Menu -->
                <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
                    class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex justify-between">
                <!-- Side Menu -->
                <div class="bg-myDark-200 shadow w-[22%] h-[91.5vh]">
                    <ul class="flex flex-col h-full">
                        <div class="uppercase text-white text-lg pl-8 pr-4 py-3 flex items-center justify-between">
                            <span>main menu {{ $store.state.counter }}</span>
                            <span class="w-6 hover:rotate-180 cursor-pointer transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                    <title>Chevron Forward</title>
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="48" d="M184 112l144 144-144 144" />
                                </svg>
                            </span>
                        </div>
                        <li class="border-b border-myDark-100 px-8 py-3 hover:text-white">
                            <Link href="/">
                            <span class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>Grid</title>
                                        <rect x="48" y="48" width="176" height="176" rx="20" ry="20" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <rect x="288" y="48" width="176" height="176" rx="20" ry="20" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <rect x="48" y="288" width="176" height="176" rx="20" ry="20" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <rect x="288" y="288" width="176" height="176" rx="20" ry="20" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                    </svg>
                                </span>
                                <span>
                                    Dashboard
                                </span>
                            </span>
                            </Link>
                        </li>
                        <li class="border-b border-myDark-100 px-8 py-3 hover:text-white">
                            <Link href="transactions">
                            <span class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>Shuffle</title>
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M400 304l48 48-48 48M400 112l48 48-48 48M64 352h85.19a80 80 0 0066.56-35.62L256 256" />
                                        <path
                                            d="M64 160h85.19a80 80 0 0166.56 35.62l80.5 120.76A80 80 0 00362.81 352H416M416 160h-53.19a80 80 0 00-66.56 35.62L288 208"
                                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                    </svg>
                                </span>
                                <span>
                                    Transactions
                                </span>
                            </span>
                            </Link>
                        </li>
                        <li class="border-b border-myDark-100 px-8 py-3 hover:text-white">
                            <Link href="categories">
                            <span class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>File Tray Full</title>
                                        <path
                                            d="M384 80H128c-26 0-43 14-48 40L48 272v112a48.14 48.14 0 0048 48h320a48.14 48.14 0 0048-48V272l-32-152c-5-27-23-40-48-40z"
                                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M48 272h144M320 272h144M192 272a64 64 0 00128 0M144 144h224M128 208h256" />
                                    </svg>
                                </span>
                                <span>
                                    Categories
                                </span>
                            </span>
                            </Link>
                        </li>
                        <li class="border-b border-myDark-100 px-8 py-3 hover:text-white">
                            <Link href="analytics">
                            <span class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>Trending Up</title>
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" d="M352 144h112v112" />
                                        <path
                                            d="M48 368l121.37-121.37a32 32 0 0145.26 0l50.74 50.74a32 32 0 0045.26 0L448 160"
                                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                    </svg>
                                </span>
                                <span>
                                    Analytics
                                </span>
                            </span>
                            </Link>
                        </li>


                        <div class="uppercase text-white text-lg px-8 py-3 mt-auto">Account</div>
                        <li class="border-b border-myDark-100 px-8 py-3 hover:text-white">
                            <Link href="help">
                            <span class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>Help Circle</title>
                                        <path d="M256 80a176 176 0 10176 176A176 176 0 00256 80z" fill="none"
                                            stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                        <path
                                            d="M200 202.29s.84-17.5 19.57-32.57C230.68 160.77 244 158.18 256 158c10.93-.14 20.69 1.67 26.53 4.45 10 4.76 29.47 16.38 29.47 41.09 0 26-17 37.81-36.37 50.8S251 281.43 251 296"
                                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                            stroke-width="28" />
                                        <circle cx="250" cy="348" r="20" />
                                    </svg>
                                </span>
                                <span>
                                    Help
                                </span>
                            </span>
                            </Link>
                        </li>

                        <li class="border-b border-myDark-100 px-8 py-3 hover:text-white">
                            <Link href="settings">
                            <span class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>Settings</title>
                                        <path
                                            d="M262.29 192.31a64 64 0 1057.4 57.4 64.13 64.13 0 00-57.4-57.4zM416.39 256a154.34 154.34 0 01-1.53 20.79l45.21 35.46a10.81 10.81 0 012.45 13.75l-42.77 74a10.81 10.81 0 01-13.14 4.59l-44.9-18.08a16.11 16.11 0 00-15.17 1.75A164.48 164.48 0 01325 400.8a15.94 15.94 0 00-8.82 12.14l-6.73 47.89a11.08 11.08 0 01-10.68 9.17h-85.54a11.11 11.11 0 01-10.69-8.87l-6.72-47.82a16.07 16.07 0 00-9-12.22 155.3 155.3 0 01-21.46-12.57 16 16 0 00-15.11-1.71l-44.89 18.07a10.81 10.81 0 01-13.14-4.58l-42.77-74a10.8 10.8 0 012.45-13.75l38.21-30a16.05 16.05 0 006-14.08c-.36-4.17-.58-8.33-.58-12.5s.21-8.27.58-12.35a16 16 0 00-6.07-13.94l-38.19-30A10.81 10.81 0 0149.48 186l42.77-74a10.81 10.81 0 0113.14-4.59l44.9 18.08a16.11 16.11 0 0015.17-1.75A164.48 164.48 0 01187 111.2a15.94 15.94 0 008.82-12.14l6.73-47.89A11.08 11.08 0 01213.23 42h85.54a11.11 11.11 0 0110.69 8.87l6.72 47.82a16.07 16.07 0 009 12.22 155.3 155.3 0 0121.46 12.57 16 16 0 0015.11 1.71l44.89-18.07a10.81 10.81 0 0113.14 4.58l42.77 74a10.8 10.8 0 01-2.45 13.75l-38.21 30a16.05 16.05 0 00-6.05 14.08c.33 4.14.55 8.3.55 12.47z"
                                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                    </svg>
                                </span>
                                <span>
                                    Settings
                                </span>
                            </span>
                            </Link>
                        </li>

                        <li class="px-8 py-3 hover:text-white">
                            <Link :href="route('logout')" method="post" as="button">
                            <span class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>Log Out</title>
                                        <path
                                            d="M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256"
                                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                    </svg>
                                </span>
                                <span>
                                    Log Out
                                </span>
                            </span>
                            </Link>
                        </li>
                    </ul>
                </div>
                <div class="w-full py-8 overflow-y-scroll h-[91.5vh]">
                    <div class="mx-8">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <div class="mb-1">Wellcome back!</div>
                                <div class="text-white text-3xl font-medium">{{ $page.props.auth.user.name }}'s {{
                                    $page.component
                                }}</div>
                            </div>
                            <Plus-button v-if="$page.component === 'Categories'" formToggel='formHolder' />
                            <Plus-button v-if="$page.component === 'Transactions'" formToggel='TransactionFormHolder' />
                        </div>
                        <slot />
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
