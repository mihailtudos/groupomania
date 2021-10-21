import VueRouter from "vue-router";
import Home from "./views/home/Home";
import Post from "./views/post/Post";

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
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
