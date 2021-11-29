import Vue from "vue";
import Router from "vue-router";
import store from "./store";

import Home from "./pages/Home";
import Login from "./pages/Login";
import Register from "./pages/Register";
import NewRecipe from "./pages/NewRecipe";
import Recipes from "./pages/Recipes";
import ShowRecipe from "./pages/ShowRecipe";
import EditRecipe from "./pages/EditRecipe";
import UserRecipes from "./pages/UserRecipes";

Vue.use(Router);

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },

    {
        path: "/login",
        name: "login",
        component: Login,
        beforeEnter: (to, from, next) => {
            if (!store.state.user.status) {
                next();
            } else {
                next(false);
            }
        },
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        beforeEnter: (to, from, next) => {
            if (!store.state.user.status) {
                next();
            } else {
                next(false);
            }
        },
    },
    {
        path: "/new-recipe",
        name: "new-recipe",
        component: NewRecipe,
        beforeEnter: (to, from, next) => {
            if (store.state.user.status) {
                next();
            } else {
                next(false);
            }
        },
    },
    {
        path: "/recipes",
        name: "recipes",
        component: Recipes,
    },
    {
        path: "/recipes/:id",
        name: "recipes-id",
        component: ShowRecipe,
    },
    {
        path: "/edit-recipe/:id",
        name: "edit-recipe",
        component: EditRecipe,
        beforeEnter: (to, from, next) => {
            if (
                store.state.user.status &&
                store.state.userRecipe.user_id == store.state.user.id
            )
                next();
            else {
                next("/");
            }
        },
        beforeRouteUpdate: (to, from, next) => {
            if (
                store.state.user.status &&
                store.state.userRecipe.user_id == store.state.user.id
            )
                next();
            else {
                next("/");
            }
        },
    },
    {
        path: "/user-recipes/:id",
        name: "user-recipes",
        component: UserRecipes,
        beforeEnter: (to, from, next) => {
            if (store.state.user.status) next();
            else {
                next("/");
            }
        },
        beforeRouteUpdate: (to, from, next) => {
            console.log(this.$route.params);
            if (
                store.state.user.status &&
                this.$route.params == store.state.user.id
            )
                next();
            else {
                next("/");
            }
        },
    },
];

export default new Router({
    mode: "hash",
    routes: routes,
});
