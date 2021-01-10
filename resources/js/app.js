import router from "./router";
import store from './store';
import App from "./components/App";

require( './bootstrap' );

window.Vue = require( 'vue' );

const accessToken = localStorage.getItem( 'access_token' );
if ( accessToken ) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + accessToken;
}

// router.beforeEach( ( to, from, next ) => {
//     if ( to.matched.some( record => record.meta.requiresAuth ) ) {
//         if ( store.getters.isLoggedIn ) {
//             next()
//             return
//         }
//         next( '/login' )
//     } else {
//         next()
//     }
// } )

const app = new Vue( {
    el: '#app',
    router,                // <-- register router with Vue
    store,
    render: ( h ) => h( App ) // <-- render App component
} );
