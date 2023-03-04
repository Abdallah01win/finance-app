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
        data: Array,
        type: String
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)
            return myDate
        },
        calcPercent(total, fr) {
            let myPercent = {}
            let ret = Math.floor(((fr * 100) / total))
            myPercent.ret = ret
            myPercent.width = ret <= 100 ? `width: ${ret}%` : 'width: 100%'
            return myPercent
        },
        daysLeft(date) {
            const inputDate = new Date(date);
            const currentDate = new Date();
            const timeDiff = inputDate.getTime() - currentDate.getTime();
            const daysLeft = Math.ceil(timeDiff / (1000 * 3600 * 24));
            return daysLeft;
        }
    }
};
</script>
<template>
    <div v-for="(item, index) in data" :key=index>
        <div class="bg-myDark-100 overflow-hidden sm:rounded-lg flex cursor-pointer">
            <div class="px-6 py-4 grow">
                <div class="flex justify-between items-center mb-3 text-white">
                    <div class="flex gap-x-4 items-center">
                        <div class=" font-semibold text-lg">{{ item.title[0].toUpperCase() +
                            item.title.slice(1)
                        }}
                        </div>
                        <span>
                            <div class="text-myDark-300 text-xs px-2 rounded-2xl font-semibold grid place-content-center"
                                :class="{
                                    'bg-myBlue': type == 'savings',
                                    'bg-myRed': type == 'expances',
                                    'bg-myGreen': type == 'income',
                                }">
                                <div class="translate-y-[10%]">{{ calcPercent(item.limit, item.total).ret }}%</div>
                            </div>
                        </span>
                    </div>
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <img src="../../../storage/assets/dots.svg" alt="" class="w-6 cursor-pointer">
                        </template>

                        <template #content>
                            <DropdownLink :href="route('categories/edit')" method="post" as="button"
                                :data="{ id: item.id }">
                                Edit
                            </DropdownLink>
                            <div as="button"
                                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out cursor-pointer"
                                @click="() => { this.$emit('itemId', item.id); close('confirmDelete'); }">
                                Delete
                            </div>
                        </template>
                    </Dropdown>
                </div>
                <div>
                    <div class="mb-2 w-full h-4 bg-myDark-300 rounded-full">
                        <div class="h-4 rounded-full" :style="calcPercent(item.limit, item.total).width" :class="{
                            'bg-myBlue': type == 'savings',
                            'bg-myRed': type == 'expances',
                            'bg-myGreen': type == 'income',
                        }"></div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>{{ item.total }} USD</span>
                        <span>{{ item.limit }} USD</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="mt-3 text-sm font-semibold">
                        <div>{{ dateConvert(item.updated_at).date }}</div>
                    </div>
                    <div v-if="item.deadline != null" class="mt-3 text-sm font-semibold">
                        <div>{{  daysLeft(item.deadline) }} Days Left</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>