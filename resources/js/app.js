import router from "./router";
import store from './store';
import App from "./components/App";

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

const app = new Vue( {
    el: '#app',
    router,                // <-- register router with Vue
    store,
    render: ( h ) => h( App ) // <-- render App component
} );
