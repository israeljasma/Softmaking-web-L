import Vue from "vue";
import VueRouter from "vue-router";
Vue.use( VueRouter );

// pages
import PageHome from "./pages/Home";
import PageLogin from "./pages/Login";
import PageLogout from "./pages/Logout";
import PageRegister from "./pages/Register";
import PageForgotPassword from "./pages/ForgotPassword";
import PageResetPassword from "./pages/ResetPassword";
import PageNotFound from "./pages/NotFound";
import PageDashboard from "./pages/Dashboard";
import PageProfile from "./pages/Profile";
import PageUsers from "./pages/Users";
import PageClients from "./pages/Clients";
import PageMessages from "./pages/Messages";
import PageInvoices from "./pages/Invoices";
import PageCreateEditInvoice from "./pages/CreateEditInvoice";
import PageCreateEditClient from "./pages/CreateEditClient";
import PageInvoice from "./pages/Invoice";
import PageTickets from "./pages/Tickets";
import PageTicket from "./pages/Ticket";
import { roles } from "./roles";
import store from "./store";

const router = new VueRouter( {
    mode: "history",
    base: process.env.BASE_URL,
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
            path: "/profile",
            name: "profile",
            component: PageProfile,
            props: true,
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
            },
        },
        {
            path: "/clients",
            name: "clients",
            component: PageClients,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
        },
        {
            path: "/client",
            component: PageCreateEditClient,
            name: "createClient",
            props: true,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
        },
        {
            path: "/client/:clientId",
            component: PageCreateEditClient,
            name: "editClient",
            props: true,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
        },
        {
            path: "/users/:userId/invoices",
            name: "invoices",
            component: PageInvoices,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
        },
        {
            path: "/users/:userId/invoices/:invoiceId",
            name: "invoice",
            props: true,
            component: PageInvoice,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
        },
        {
            path: "/users/:userId/invoice",
            component: PageCreateEditInvoice,
            name: "createInvoice",
            props: true,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
        },
        {
            path: "/users/:userId/invoice/:invoiceId",
            component: PageCreateEditInvoice,
            name: "editInvoice",
            props: true,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
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
            path: "/tickets/:ticketId",
            name: "ticket",
            component: PageTicket,
            props: true,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            }
        },
        {
            path: "/messages",
            name: "messages",
            component: PageMessages,
            meta: {
                requiresAuth: true,
                userRoles: [ roles.admin, roles.superadmin ]
            },
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
            path: '/password/reset/:token',
            name: 'reset-password-form',
            component: PageResetPassword,
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
    const lastPath = localStorage.getItem( 'last_path' ) || 'dashboard'
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
