require('./bootstrap');

import { createApp } from "vue";
import axios from 'axios';
import VueAxios from 'vue-axios';
import FloatingVue from 'floating-vue'
import router from "./router";
import App from "./App.vue";
import Loading from "./components/common/Loading.vue";

const app = createApp(App);

app.use(router);
app.use(VueAxios, axios);
app.use(FloatingVue);
app.component('Loading', Loading);

app.mount("#app");
