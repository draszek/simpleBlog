import Vue from 'vue';
import wysiwyg from 'vue-wysiwyg'
import router from './router';
import App from './components/App';
import store from './store';
require('./bootstrap');

Vue.use(wysiwyg, {});

const app = new Vue({
    el: 'App',
    components: {
        App
    },
    router,
    store,
});
