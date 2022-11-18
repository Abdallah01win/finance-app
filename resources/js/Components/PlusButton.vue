<script>
export default {
    data() {
        return {
        }
    },
    props: {
        formToggel: String,
    },
    methods: {
         close (formToggel) {
            const formHolder = document.getElementById(formToggel);
            formHolder.classList.toggle('hidden');
        }
    }
}
</script>
<template>
    <button
        class="grid place-content-center p-4 mr-2 bg-myDark-200 hover:bg-myDark-100 text-white opacity-50 hover:opacity-100 rounded-full"
        @click="close(this.formToggel)">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 256 256">
            <rect width="256" height="256" fill="none"></rect>
            <line x1="40" y1="128" x2="216" y2="128" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="16"></line>
            <line x1="128" y1="40" x2="128" y2="216" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="16"></line>
        </svg>
    </button>
</template>