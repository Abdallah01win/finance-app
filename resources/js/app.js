import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createStore } from 'vuex';
import axios from 'axios';
const store = createStore({
    state(){
        return {
            transactions: [],
            user: null,
        }
    },
    mutations:{
        get(state, payload){
            state.transactions = payload
        },
        user(state, payload){
            state.user = payload
        }
    },
    getters:{
        //allTransactions: (state) => state.transactions,
        //userBalance: (state) => state.user.balance,
    },
    actions:{
        async getTransactions(context){
            let data = (await axios.get('transactions/list')).data;
            context.commit('get', data);
        },
        async getUser(context){
            let data = (await axios.get('users')).data;
            context.commit('user', data);
        }
    }

})


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props), store })
            .use(plugin)
            .use(store)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#808080' });
