<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>
    
<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex my-8">d1</div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex my-8">d2</div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex my-8">d3</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
    