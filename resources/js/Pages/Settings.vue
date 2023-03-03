<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    FirstName: '',
    last_name: '',
    income: null,
    expances: null,
    savings: null,
    image: null,
    currancy: '',
    language: '',
});

const submit = (e) => {
    form.post(route('settings/edit'), {});
    console.log(form)
};

</script>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            user: '',
            isEditable: false,
        }
    },
    components:{
    },
    methods: {
        getUser() {
            axios.get('/users').then((response) => {
                this.user = response.data[0]
            });
        },
    },
    beforeMount: function () {
        this.getUser();
    }
}
</script>
        
<template>

    <Head title="Settings" />

    <AuthenticatedLayout>
        <!-- Settings -->
        <form class="w-full grid grid-cols-[3fr,1.3fr] gap-6 my-6" action="" method="post" @submit.prevent="submit" enctype="multipart/form-data">
            <!-- settings sec -->
            <div class="rounded-lg bg-myDark-200 border border-myDark-100 p-6">
                <div class="flex items-center justify-between">
                    <div class="text-xl font-medium text-white">Personal Details</div>
                    <div>
                        <PrimaryButton @click="this.isEditable = !isEditable"
                            :type="this.isEditable ? 'button' : 'submit'"
                            class="bg-myBlue/100 font-poppins pt-2 pb-2 hover:border hover:border-myDark-100/100 hover:bg-myDark-300/100 font-semibold">
                            {{ isEditable ? 'Save' : 'Edit' }}
                        </PrimaryButton>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex gap-4">
                        <!-- :value="" -->
                        <div class="w-full">
                            <InputLabel for="FirstName" value="First Name" />
                            <TextInput id="FirstName" type="text" class="mt-1 block w-full bg-myDark-300/100"
                                v-model="form.FirstName" 
                                :placeholder="user.name"
                                v-bind:disabled="!isEditable"></TextInput>
                            <InputError class="mt-2" :message="form.errors.FirstName" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="LastName" value="Last Name" />
                            <TextInput id="LastName" type="text" class="mt-1 block w-full bg-myDark-300/100"
                                v-model="form.last_name" :placeholder="user.last_name" v-bind:disabled="!isEditable" />
                            <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>
                    </div>
                    <div class="w-full mt-4">
                        <InputLabel for="Email" value="Email" />
                        <TextInput id="Email" type="email" class="mt-1 block w-full bg-myDark-300/100"
                        :placeholder="user.email" disabled/>
                        <InputError class="mt-2" />
                    </div>

                    <!-- Targets -->
                    <div class="text-xl font-medium my-4 text-white">Targets</div>
                    <div class="flex gap-4">
                        <div class="w-full">
                            <InputLabel for="Income" value="Income" />
                            <TextInput id="Income" type="number" class="mt-1 block w-full bg-myDark-300/100"
                                v-model="form.income" :placeholder="user.income_target" v-bind:disabled="!isEditable" />
                            <InputError class="mt-2" :message="form.errors.income" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="Expances" value="Expances" />
                            <TextInput id="Expances" type="number" class="mt-1 block w-full bg-myDark-300/100"
                                v-model="form.expances" :placeholder="user.expances_target" v-bind:disabled="!isEditable" />
                            <InputError class="mt-2" :message="form.errors.expances" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="Savings" value="Savings" />
                            <TextInput id="Savings" type="number" class="mt-1 block w-full bg-myDark-300/100"
                                v-model="form.savings" :placeholder="user.savings_target" v-bind:disabled="!isEditable" />
                            <InputError class="mt-2" :message="form.errors.savings" />
                        </div>
                    </div>
                </div>
                <div class="text-xl font-medium mt-4 mb-2 text-white">Danger Zone</div>
                <p class="mb-4 w-[85%]">Deleting your OnPoint account or reseting your data will resault in the lose
                    of all of your Transactions, Categories, and Settings!</p>
                <div class="flex items-center gap-x-6">
                    <PrimaryButton
                        class="bg-myRed/100 text-myDark-200 pt-2 pb-2 font-semibold hover:border hover:border-myRed hover:text-myRed hover:bg-myDark-300/100">
                        Delete My Account</PrimaryButton>

                    <PrimaryButton
                        class="text-myRed bg-myDark-300/100 pt-2 pb-2 font-semibold border border-myRed hover:text-myDark-300/100 hover:bg-myRed">
                        Reset My Data</PrimaryButton>

                </div>

            </div>
            <!-- End settings sec -->
            <!-- Profile sec -->
            <div class="rounded-lg bg-myDark-200 border border-myDark-100 p-6 flex flex-col justify-between">
                <div>
                    <div class="text-xl font-medium text-white">Profile</div>
                    <!-- user -->
                    <div class="mt-2 mb-4">
                        <div class="flex items-center gap-x-4">
                            <div>
                                <div class="bg-myDark-100 rounded-lg hover:text-white cursor-pointer overflow-hidden">
                                    <div class="w-14 h-14 p-2" v-if="user.image == null">
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
                                    <div  class="w-14 h-14">
                                        <img :src="user.image" alt="" class="w-full h-full">
                                    </div>
                                </div>
                                <!-- end user -->
                            </div>
                            <div class="flex flex-col justify-between">
                                <div class="text-white">
                                    {{ user.name }} {{user.last_name}}
                                </div>
                                <div class="text-sm">
                                    {{ user.email }}
                                </div>
                            </div>
                        </div>
                        <!-- Image Upload -->
                        <div
                            class="border-4 border-dashed border-myDark-100 py-8 px-4 mt-4 text-center items-center flex flex-col gap-y-2 text-sm">
                            <div class="w-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                    <title>Cloud Upload</title>
                                    <path
                                        d="M320 367.79h76c55 0 100-29.21 100-83.6s-53-81.47-96-83.6c-8.89-85.06-71-136.8-144-136.8-69 0-113.44 45.79-128 91.2-60 5.7-112 43.88-112 106.4s54 106.4 120 106.4h56"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32"
                                        d="M320 255.79l-64-64-64 64M256 448.21V207.79" />
                                </svg>
                            </div>
                            <div class="relative">
                                <span class="w-fit">
                                    <input type="file" accept="image/png, image/jpeg" name="image" id="image"
                                        @change="(e)=>{form.image =  e.target.files[0]}"
                                        class="absolute top-0 left-0 opacity-0 bg-myRed overflow-hidden">
                                    <span class="text-myBlue cursor-pointer hover:underline">Click Here</span>
                                </span>
                                <span> drop to Upload your profile picture.</span>
                                <InputError class="mt-2" :message="form.errors.image" />
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End user -->

                <!-- Preferances -->
                <div class="text-xl font-medium text-white">Preferances</div>
                <div class="mt-2 flex flex-col gap-y-2 mb-4">
                    <div>
                        <InputLabel for="Currancy" value="Currancy" />
                        <select v-bind:disabled="!isEditable"
                                v-model="form.currancy"
                                name="Currancy" id="Currancy"
                            class="bg-myDark-300 rounded-lg text-white outline-none border border-myDark-100 focus:outline-myBlue w-full mt-1">
                            <option value="USD">USD</option>
                            <option value="MDH">MDH</option>
                            <option value="EU">EU</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.Currancy" />
                    </div>
                    <div>
                        <InputLabel for="Language" value="Language" />
                        <select v-bind:disabled="!isEditable" v-model="form.language" name="Language" id="Language"
                            class="bg-myDark-300 rounded-lg text-white outline-none border border-myDark-100 focus:outline-myBlue w-full mt-1">
                            <option value="English">English</option>
                            <option value="French">French</option>
                            <option value="Arabic">Arabic</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.currancy" />
                    </div>
                </div>

                <div>
                    <p class="text-xs mt-auto">
                        Note: Changing the currancy will NOT convert previoussly entered amounts.
                    </p>
                </div>
            </div>
            <!-- End Preferances -->

            <!-- end Profile sec -->
        </form>
    </AuthenticatedLayout>
</template>