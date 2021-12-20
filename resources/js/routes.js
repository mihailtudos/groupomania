import VueRouter from "vue-router";
import Home from "./views/home/Home";
import Post from "./views/post/Post";
import Login from "./components/Auth/Login";
import Policy from "./components/Policy/Policy";
import Profile from "./components/Profile/Profile";
import Register from "./components/Auth/Register";
import {auth, notAuth} from "./components/Shared/util/auth";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
        beforeEnter(to, from, next) {
            auth(to, from, next);
        }

    },
    {
        path: "/post/:id",
        component: Post,
        name: "post",
    },
    {
        path: "/auth/login",
        component: Login,
        name: "login",
        beforeEnter(to, from, next) {
            notAuth(to, from, next);
        }
    },
    {
        path: "/auth/register",
        component: Register,
        name: "register",
        beforeEnter(to, from, next) {
           notAuth(to, from, next);
        }
    },
    {
        path: "/cookies",
        component: Policy,
        name: "cookies",
    },
    {
        path: "/policy",
        component: Policy,
        name: "policy",
    },
    {
        path: "/user/profile/:id",
        component: Profile,
        name: "profile",
        beforeEnter(to, from, next) {
            auth(to, from, next);
        }
    }

];


const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
