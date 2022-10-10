<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const close = (id) => {
    const formHolder = document.getElementById(id);
    formHolder.classList.toggle('hidden');
}
</script>
<script>
export default {
    name: "CategoryCard",
    components: {
        Dropdown,
        DropdownLink,
    },
    props: {
        data: Array
    }
};
</script>
<template>
    <div v-for="(item, index) in data">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
            <div class="p-6 grow">
                <div class="flex justify-between items-center mb-3">
                    <div class=" font-semibold text-lg">{{item.title[0].toUpperCase() +
                    item.title.slice(1)}}
                    </div>
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <img src="../../../storage/assets/dots.svg" alt="" class="w-6 cursor-pointer">
                        </template>

                        <template #content>
                            <DropdownLink :href="route('categories/edit')" method="post" as="button"
                                :data="{id : item.id}">
                                Edit
                            </DropdownLink>
                            <div as="button"
                                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out cursor-pointer"
                                @click="()=>{ this.$emit('itemId', item.id); close('confirmDelete');}">
                                Delete
                            </div>
                        </template>
                    </Dropdown>
                </div>
                <div class="flex flex-col gap-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="bg-gray-200 rounded-full p-3 grid" style="place-content: center;">
                                <img src="../../../storage/assets/edit.svg" alt="edit" class="w-4">
                            </div>
                            <div>{{item.total}}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="bg-gray-200 rounded-full p-2 grid" style="place-content: center;">
                                <img src="../../../storage/assets/target.svg" alt="edit" class="w-5">
                            </div>
                            <div>{{item.limit}}</div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>{{item.updated_at}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>