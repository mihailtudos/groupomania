import ValidationErrors from "./components/Shared/ValidationErrors";
import moment from "moment";

require('./bootstrap');
import router from "./routes";
import VueRouter from "vue-router";
import Index from './Index';

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.component('login-form', require('./components/Auth/LoginForm').default);
Vue.component('v-error', ValidationErrors);

import store from './store/index';

Vue.mixin({
    methods: {
        capitalizeFirstLetter: (str) => str.charAt(0).toUpperCase() + str.slice(1),
        isEmailValid: (email) => {
            const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(email);
        },
        isPasswordValid: (password) => {
            return password.length >= 6;
        },
        getUsername(email) {
            return email.split('@')[0];
        },
        isImage(image){
            console.log(image.name)
          if (/\.(jpe?g|png|gif|webp)$/i.test( image.name ))  {
              console.log('passed')
              return true;
          }
          return false;
        }
    }
});

Vue.filter('fromNow', (value) => {
    return moment(value).fromNow();
})

const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        "index": Index,
    },
    async beforeCreate() {
        await this.$store.dispatch("currentUser/loadStoredState");
        await this.$store.dispatch("currentUser/loadUser");
    },
});
