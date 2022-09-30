<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>
    
<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mb-6">
                    <h3 class="text-xl font-bold mb-3">Expances Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 grow">
                            <div class="mb-2 font-semibold text-lg">Title</div>
                            <div class="flex flex-col gap-y-2">
                                <div class="flex justify-between items-center ">
                                    <div>Total</div>
                                    <div>limit</div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>Last Updated</div>
                                    <div>Edit</div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 grow text-center">D1</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Income Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Investment Categories</h3>
                    <div class="grid grid-cols-3 gap-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                            <div class="p-6 bg-white grow text-center">D1</div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
    