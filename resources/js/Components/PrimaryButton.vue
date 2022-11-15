<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-6 py-3 bg-myDark-300 border border-transparent rounded-md text-sm text-white uppercase tracking-widest hover:bg-myDark-200 active:bg-myDark-100 focus:outline-none focus:border-myDark-100 focus:shadow-outline-gray transition ease-in-out duration-150">
        <slot />
    </button>
</template>
