import router from "./router";
import store from './store';
import App from "./components/App";

import moment from 'moment';
import Toasted from 'vue-toasted';
import VueSweetalert2 from 'vue-sweetalert2';

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { TweenLite } from "gsap/gsap-core";

gsap.registerPlugin(ScrollTrigger, TweenLite);

require( './bootstrap' );

window.Vue = require( 'vue' );

const accessToken = localStorage.getItem( 'access_token' );
if ( accessToken ) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + accessToken;
}

moment.locale('es');
Vue.filter('formatDate', function(val) {
    if (val) {
        // return moment(String(val)).format('MM/DD/YYYY hh:mm')
        return moment(String(val)).format('LLLL')
    }
});

Vue.use(Toasted, {
    theme: "toasted-primary",
    position: "top-right",
    fitToScreen: true,
    duration : 5000
});

const options = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674',
};

Vue.use(VueSweetalert2, options);

const app = new Vue( {
    el: '#app',
    router,                // <-- register router with Vue
    store,
    render: ( h ) => h( App ) // <-- render App component
} );
