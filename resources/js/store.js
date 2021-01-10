import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use( Vuex )

const store = new Vuex.Store( {
    state: {
        status: '',
        token: localStorage.getItem( 'access_token' ) || '',
        userRole: localStorage.getItem( 'user_role' ) || '',
        user: {}
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
    },
    mutations: {
        retrieveToken ( state, token ) {
            state.token = token
        },
        destroyToken ( state ) {
            state.token = null
        },
        auth_request ( state ) {
            state.status = 'loading'
        },
        auth_success ( state, data ) {
            state.status = data.status
            state.token = data.token
            state.userRole = data.user_role
            // state.user = user
        },
        auth_error ( state ) {
            state.status = 'error'
        },
        logout ( state ) {
            state.status = ''
            state.token = ''
        },
    },
    actions: {
        retrieveToken ( context, credentials ) {

            return new Promise( ( resolve, reject ) => {
                axios.get( '/sanctum/csrf-cookie' ).then( () => {
                    axios.post( '/api/login', {
                        email: credentials.email,
                        password: credentials.password,
                    } )
                        .then( response => {
                            //console.log(response)
                            const token = response.data.access_token
                            const userRol = response.data.rol
                            const message = response.data.message

                            localStorage.setItem( 'user_role', userRol )
                            localStorage.setItem( 'access_token', token )

                            axios.defaults.headers.common[ 'Authorization' ] = 'Bearer ' + token;

                            context.commit( 'auth_success', { status: message, token, user_role: userRol } )
                            context.commit( 'retrieveToken', token )

                            resolve( response )
                        } )
                        .catch( error => {
                            // console.log(error)
                            localStorage.removeItem( 'access_token' );
                            localStorage.removeItem( 'user_role' );
                            reject( error )
                        } )
                } )
            } )

        },
        destroyToken ( context ) {

            if ( context.getters.isLoggedIn ) {
                return new Promise( ( resolve, reject ) => {
                    axios.post( '/api/logout', '', {
                        // headers: { Authorization: "Bearer " + context.state.token }
                    } )
                        .then( response => {
                            localStorage.removeItem( 'access_token' )
                            localStorage.removeItem( 'user_role' );
                            delete axios.defaults.headers.common[ 'Authorization' ];

                            context.commit( 'destroyToken' )

                            resolve( response )
                        } )
                        .catch( error => {
                            // console.log( error )
                            localStorage.removeItem( 'access_token' )
                            localStorage.removeItem( 'user_role' );
                            delete axios.defaults.headers.common[ 'Authorization' ];

                            context.commit( 'destroyToken' )

                            reject( error )
                        } )
                } )

            }
        }
    }
} )

export default store
