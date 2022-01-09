import Vue from "vue";
import Vuex from "vuex";
import currentUser from "./modules/currentUser";
import explorePosts from "./modules/explorePosts";
Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        currentUser,
        explorePosts
    }
})
