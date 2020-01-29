import Vue from 'vue';
import Vuex from 'vuex';
import router from "./router";

Vue.use(Vuex);

const types = {
    LOGIN: 'LOGIN',
    LOGOUT: 'LOGOUT',
    REGISTER: 'REGISTER'
};

const state = {
    logged: !!localStorage.getItem('token'),
    accountType: localStorage.getItem('accountType')
};

const getters = {
    isLogged: state => state.logged,
    getAccountType: state => state.accountType
};

const actions = {
    async login({commit}, credentials) {
        await axios.post('/api/login', credentials).then(response => {
            if(response.status === 200 && response.data.accessToken !== undefined) {
                localStorage.setItem('token', response.data.accessToken);
                localStorage.setItem('accountType', response.data.accountType);
                commit(types.LOGIN, response.data.accountType);
                router.push({name: 'home'});
            }
        }).catch(e => {
            console.log("unautorized");
        });
    },

    logout({commit}) {
        axios.post('/api/logout').then(response => {
            if(response.status === 200) {
                localStorage.removeItem('token');
                localStorage.removeItem('accountType');
                commit(types.LOGOUT);
                router.push({name: 'home'});
            }
        }).catch(e => {
            console.log("error while logout");
        });
    },

    register({commit}, credentials) {
        axios.post('/api/register', credentials).then(response => {
            if(response.status === 200 && response.data.accessToken !== undefined) {
                localStorage.setItem('token', response.data.accessToken);
                localStorage.removeItem('accountType');
                commit(types.LOGIN, response.data.accountType);
                router.push({name: 'home'});
            }
        }).catch(e => {
            console.log("unautorized");
        });
    }
};

const mutations = {
    [types.LOGIN] (state, type) {
        state.logged = true;
        state.accountType = type;
        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.accountType;
    },
    [types.LOGOUT] (state) {
        state.logged = false;
        state.accountType = null;
    }
};

export default new Vuex.Store({
   state,
   getters,
   actions,
   mutations
});
