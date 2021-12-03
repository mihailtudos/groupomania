import VueRouter from "vue-router";
import Home from "./views/home/Home";
import Post from "./views/post/Post";
import Login from "./components/Auth/Login";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home"
    },
    {
        path: "/post/:id",
        component: Post,
        name: "post"
    },
    {
        path: "/login",
        component: Login,
        name: "login"
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
