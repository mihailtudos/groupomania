require('./bootstrap');
import router from "./routes";
import VueRouter from "vue-router";
import Vuex from 'vuex';
import Index from './Index';

// const store = new Vuex.store(storeDefinition);

window.Vue = require('vue').default;
Vue.use(VueRouter);


const app = new Vue({
    el: '#app',
    router,
    components: {
        "index": Index,
    },
    async beforeCreate() {
        // this.$store.dispatch('loadStoreState');
        await axios.get('/sanctum/csrf-cookie');
        await axios.post('/login', {
            email: 'mihairmcr7@gmail.com',
            password: 'password'
        });
        await axios.get('/user');
    }
});
