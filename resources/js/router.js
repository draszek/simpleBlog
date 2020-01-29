import Vue from 'vue';
import VueRouter from "vue-router";
import Login from "./components/pages/Login";
import Register from "./components/pages/Register";
import Home from "./components/pages/Home";
import Post from "./components/pages/Post";
import {authAdministrator, authRedactor} from "./middlewares/auth";
import CreatePost from "./components/pages/admin/CreatePost";
import Users from "./components/pages/admin/Users";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {name: 'home', path: '/', component: Home},
        {name: 'login', path: '/login', component: Login},
        {name: 'register', path: '/register', component: Register},
        {name: 'post', path: '/post/:id', component: Post},
        {name: 'createPost', path: '/create-post', component: CreatePost, beforeEnter: authRedactor},
        {name: 'editPost', path: '/edit-post/:id', component: CreatePost, beforeEnter: authRedactor},
        {name: 'users', path: '/users', component: Users, beforeEnter: authAdministrator}
    ],
    mode: 'history'
})
