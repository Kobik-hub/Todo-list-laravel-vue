import Vue from "vue";
import Vuex from "vuex";
import authState from './modules/authState'
import getters from './getters'
Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        authState
    },
    getters
 });

 export default store;
