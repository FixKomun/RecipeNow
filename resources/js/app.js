require("./bootstrap");

window.Vue = require("vue").default;

import iView from "iview";
import "iview/dist/styles/iview.css";
import router from "./router";
import common from "./common";
import store from "./store";
import Vue from "vue";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

// Import Bootstrap an BootstrapVue CSS files (order is important)
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

Vue.use(iView);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.mixin(common);

Vue.component("App", require("./App.vue").default);

const app = new Vue({
    el: "#app",
    router: router,
    store: store,
});
