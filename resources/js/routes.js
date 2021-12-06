import VueRouter from "vue-router";
import Home from "./views/home/Home";
import Post from "./views/post/Post";
import Login from "./components/Auth/Login";
import Policy from "./components/Policy/Policy";
import Profile from "./components/Profile/Profile";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
    },
    {
        path: "/post/:id",
        component: Post,
        name: "post",
    },
    {
        path: "/login",
        component: Login,
        name: "login",
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
        path: "/user/profile",
        component: Profile,
        name: "profile",
    }
];


const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
