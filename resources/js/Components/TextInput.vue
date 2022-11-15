<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <input class="border-none focus:border-none focus:ring focus:ring-myBlue rounded-md bg-myDark-200 text-white" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>
