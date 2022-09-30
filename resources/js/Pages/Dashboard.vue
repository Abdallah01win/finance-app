<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div> -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Expances chart
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Income chart
                    </div>
                </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex my-8">
                    <div class="p-6 bg-white grow text-center">
                        Income chart
                    </div>
                    <div class="p-6 bg-white border-x border-gray-200 grow text-center">
                        Income chart
                    </div>
                    <div class="p-6 bg-white grow text-center">
                        Income chart
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
