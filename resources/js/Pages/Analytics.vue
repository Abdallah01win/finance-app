<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>
        
<template>

    <Head title="Analytics" />

    <AuthenticatedLayout>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-8">
                    <div>
                        Avrage weekly expances
                    </div>
                    <div>
                        Avrage monthly expances
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>