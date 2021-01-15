import Vue from "vue";
import VueRouter from "vue-router";
Vue.use( VueRouter );

// pages
import PageHome from "./pages/Home";
import PageLogin from "./pages/Login";
import PageLogout from "./pages/Logout";
import PageRegister from "./pages/Register";
import PageForgotPassword from "./pages/ForgotPassword";
import PageNotFound from "./pages/NotFound";
import PageDashboard from "./pages/Dashboard";
import PageUsers from "./pages/Users";
import PageInvoices from "./pages/Invoices";
import PageTickets from "./pages/Tickets";
import { roles } from "./roles";
import store from "./store";

const router = new VueRouter( {
    mode: "history",
    linkExactActiveClass: 'is-active',
    scrollBehavior: function ( to, from, savedPosition ) {
        if ( to.hash ) {
            return { selector: to.hash }
        } else {
            return { x: 0, y: 0 }
        }
    },
    routes: [
        {
            path: "/",
            name: "home",
            component: PageHome
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: PageDashboard,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin, roles.cliente ]
            }
        },
        {
            path: "/users",
            name: "users",
            component: PageUsers,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            }
        },
        {
            path: "/invoices/:id",
            name: "invoices",
            props: true,
            component: PageInvoices,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            }
        },
        {
            path: "/tickets",
            name: "tickets",
            component: PageTickets,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            }
        },
        {
            path: "/login",
            name: "login",
            component: PageLogin,
            meta: {
                requiresVisitor: true
            }
        },
        {
            path: "/register",
            name: "register",
            component: PageRegister
        },
        {
            path: "/forgot-password",
            name: "forgotpassword",
            component: PageForgotPassword
        },
        {
            path: "/logout",
            name: "logout",
            component: PageLogout,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: "/404",
            name: '404',
            component: PageNotFound
        },
        {
            path: "*",
            redirect: '/404',
        }
    ]
} );

router.beforeEach( ( to, from, next ) => {
    const lastPath = localStorage.getItem('last_path') || 'dashboard'
    if ( to.matched.some( record => record.meta.requiresAuth ) ) {
        if ( store.getters.isLoggedIn ) {
            if ( to.matched.some( record => record.meta.userRoles.includes( store.state.userRole ) ) ) {
                next();
            } else {
                next( '/' );
            }
        } else {
            next( { name: 'login' } )
        }
    } else if ( to.matched.some( record => record.meta.requiresVisitor ) ) {
        if ( store.getters.isLoggedIn ) {
            next( { path: lastPath } )
        } else {
            next()
        }
    } else {
        next()
    }
} )

router.afterEach( to => {
    // console.log(to)
    localStorage.setItem( "last_path", to.path );
} );

export default router;
