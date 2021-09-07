import App from "./components/App.vue";
import router from "./router";
import store from "./store";

import axios from "axios";

import moment from "moment";
import VueSweetalert2 from "vue-sweetalert2";

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { TweenLite } from "gsap/gsap-core";
import swal from "./plugins/swal";

window.Vue = require("vue").default;

gsap.registerPlugin(ScrollTrigger, TweenLite);

require("./bootstrap");

const accessToken = localStorage.getItem("access_token");
if (accessToken) {
    axios.defaults.headers.common["Authorization"] = "Bearer " + accessToken;
}

moment.locale("es");
Vue.filter("formatDate", function(val) {
    if (val) {
        // return moment(String(val)).format('MM/DD/YYYY hh:mm')
        return moment(String(val)).format("LLLL");
    }
});

Vue.use(swal);

const options = {
    confirmButtonColor: "#41b882",
    cancelButtonColor: "#ff7674"
};

Vue.use(VueSweetalert2, options);

const app = new Vue({
    el: "#app",
    router,
    store,
    render: h => h(App)
});
