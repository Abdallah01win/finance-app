import { createApp } from 'vue';
import transactions from './modules/transactions.js'
import { createStore } from 'vuex';
const store = createStore({
    state(){
        return {
            counter: 300,
        }
    }
})


