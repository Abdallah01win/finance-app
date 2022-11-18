<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
const form = useForm({
    email: '',
    password: '',
    remember: false
});

</script>
<script>
export default {
    data() {
        return {
            isEditable: false,
        }
    }
}
</script>
        
<template>

    <Head title="Settings" />

    <AuthenticatedLayout>
        <div>

            <!-- Settings -->
            <div class="w-full grid grid-cols-[3fr,1.3fr] gap-6 my-6">
                <!-- settings sec -->
                <div class="rounded-lg bg-myDark-200 border border-myDark-100 p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-xl font-medium text-white">Personal Details</div>
                        <div>
                            <PrimaryButton @click="this.isEditable = !isEditable"
                                class="bg-myBlue/100 font-bold font-poppins pt-2 pb-2">{{ isEditable ? 'Save' : 'Edit'
                                }}
                            </PrimaryButton>
                        </div>
                    </div>
                    <form action="" method="post" class="mt-4">
                        <div class="flex gap-4">
                            <div class="w-full">
                                <InputLabel for="FirstName" value="First Name" />
                                <TextInput id="FirstName" type="text" class="mt-1 block w-full bg-myDark-300/100"
                                    v-model="form.FirstName" autocomplete="" :value="$page.props.auth.user.name"
                                    v-bind:disabled="!isEditable"></TextInput>
                                <InputError class="mt-2" :message="form.errors.FirstName" />
                            </div>
                            <div class="w-full">
                                <InputLabel for="LastName" value="Last Name" />
                                <TextInput id="LastName" type="text" class="mt-1 block w-full bg-myDark-300/100"
                                    v-model="form.LastName" autocomplete="" v-bind:disabled="!isEditable" />
                                <InputError class="mt-2" :message="form.errors.LastName" />
                            </div>
                        </div>
                        <div class="w-full mt-4">
                            <InputLabel for="Email" value="Email" />
                            <TextInput id="Email" type="email" class="mt-1 block w-full bg-myDark-300/100"
                                v-model="form.Email" required autofocus :value="$page.props.auth.user.email" disabled
                                autocomplete="" />
                            <InputError class="mt-2" :message="form.errors.Email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="description" value="Description" />
                            <TextInput id="description" type="text" class="mt-1 block w-full bg-myDark-300/100"
                                v-model="form.description" autocomplete="" v-bind:disabled="!isEditable" />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>
                        <!-- Targets -->
                        <div class="text-xl font-medium my-4 text-white">Targets</div>
                        <div class="flex gap-4">
                            <div class="w-full">
                                <InputLabel for="FirstName" value="Income" />
                                <TextInput id="FirstName" type="number" class="mt-1 block w-full bg-myDark-300/100"
                                    v-model="form.FirstName" autocomplete="" v-bind:disabled="!isEditable" />
                                <InputError class="mt-2" :message="form.errors.FirstName" />
                            </div>
                            <div class="w-full">
                                <InputLabel for="LastName" value="Expances" />
                                <TextInput id="LastName" type="number" class="mt-1 block w-full bg-myDark-300/100"
                                    v-model="form.LastName" autocomplete="" v-bind:disabled="!isEditable" />
                                <InputError class="mt-2" :message="form.errors.LastName" />
                            </div>
                            <div class="w-full">
                                <InputLabel for="LastName" value="Savings" />
                                <TextInput id="LastName" type="number" class="mt-1 block w-full bg-myDark-300/100"
                                    v-model="form.LastName" autocomplete="" v-bind:disabled="!isEditable" />
                                <InputError class="mt-2" :message="form.errors.LastName" />
                            </div>
                        </div>
                    </form>
                    <div class="text-xl font-medium mt-4 mb-2 text-white">Danger Zone</div>
                    <p class="mb-4 w-[85%]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, tempore!
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur, quam.</p>
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
                <div class="rounded-lg bg-myDark-200 border border-myDark-100 p-6">
                    <div class="text-xl font-medium text-white">Profile</div>

                </div>
                <!-- end Profile sec -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>