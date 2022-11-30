import { createStore } from "vuex";
import axios from "axios";

const state ={
    todos:[
        {
        id:1,
        title: 'somyhing'
        },
        {
        id:2,
        title: 'somthing else'
        },
    ]
};
const actions = {};
const mutations = {};
const getters = {
    allTodos: (state)=> state.todos
};

export default {
    state, 
    actions,
    mutations,
    getters
}