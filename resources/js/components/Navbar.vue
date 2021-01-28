<template>
  <div
    id="navbar"
    class="fixed md:py-5 md:px-6 w-full bg-gray-800 bg-opacity-75 md:bg-transparent z-50 shadow-sm"
    :class="{
      'navbar--hidden': !showNavbar,
      'md:bg-gray-800 bg-opacity-75': isLoggedIn && $route.name !== 'home',
    }"
  >
    <nav
      class="relative flex items-center justify-between py-5 pl-2 sm:h-10 xl:justify-around"
    >
      <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
        <div class="flex items-center justify-between w-full md:w-auto">
          <a href="/" aria-label="Home" class="flex flex-row items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              class="block h-8 w-auto"
              viewBox="0 0 135.978 141.949"
            >
              <defs>
                <linearGradient
                  id="a"
                  x1="0.5"
                  x2="0.5"
                  y2="1"
                  gradientUnits="objectBoundingBox"
                >
                  <stop offset="0" stop-color="#48a5d7" />
                  <stop offset="1" stop-color="#4480c1" />
                </linearGradient>
                <linearGradient
                  id="b"
                  x1="0.5"
                  x2="0.5"
                  y2="1"
                  gradientUnits="objectBoundingBox"
                >
                  <stop offset="0" stop-color="#185095" />
                  <stop offset="1" stop-color="#203169" />
                </linearGradient>
              </defs>
              <g transform="translate(-509.731 -564.032)">
                <path
                  d="M-344.349,100.374a12.793,12.793,0,0,1-.075-18.212l2.288-2.309a10.506,10.506,0,0,0,.782-4.358,12.507,12.507,0,0,0-1.223-4.164l-50-50,.05-.05L-407.269,7.576V3.1l36.282.01a10.557,10.557,0,0,1,2.089,0h.428l-.048.045a10.453,10.453,0,0,1,6,2.978L-305.952,62.7a12.5,12.5,0,0,1,0,17.678L-319.74,94.166l-.024-.024-3.284,3.261a21.181,21.181,0,0,1-13.92,5.6A10.19,10.19,0,0,1-344.349,100.374Z"
                  transform="translate(948 560.975)"
                  fill="url(#a)"
                />
                <path
                  d="M-344.349,100.374a12.793,12.793,0,0,1-.075-18.212l2.288-2.309a10.506,10.506,0,0,0,.782-4.358,12.507,12.507,0,0,0-1.223-4.164l-50-50,.05-.05L-407.269,7.576V3.1l36.282.01a10.557,10.557,0,0,1,2.089,0h.428l-.048.045a10.453,10.453,0,0,1,6,2.978L-305.952,62.7a12.5,12.5,0,0,1,0,17.678L-319.74,94.166l-.024-.024-3.284,3.261a21.181,21.181,0,0,1-13.92,5.6A10.19,10.19,0,0,1-344.349,100.374Z"
                  transform="translate(207.44 709.037) rotate(180)"
                  fill="url(#b)"
                />
              </g>
            </svg>
            <span
              class="md:hidden lg:block text-2xl uppercase font-bold text-center bg-clip-text text-transparent bg-gradient-to-b from-blue-300 via-blue-700 to-blue-900 ml-2"
              >SoftMaking</span
            >
          </a>
          <div class="flex items-center md:hidden">
            <button
              type="button"
              @click="isOpen = !isOpen"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-50 hover:bg-opacity-25 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
              id="main-menu"
              aria-label="Main menu"
              aria-haspopup="true"
            >
              <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div class="hidden md:flex md:items-center md:ml-4 md:pr-2">
        <router-link
          v-if="!isLoggedIn"
          class="ml-2 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          to="/"
          >Inicio</router-link
        >
        <router-link
          v-if="!isLoggedIn && $route.name === 'home'"
          to="#clients"
          class="ml-5 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          >Clientes</router-link
        >
        <router-link
          v-if="!isLoggedIn && $route.name === 'home'"
          to="#about"
          class="ml-5 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          >Acerca de</router-link
        >
        <router-link
          v-if="!isLoggedIn && $route.name === 'home'"
          to="#services"
          class="ml-5 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          >Servicios</router-link
        >
        <router-link
          to="#contact"
          v-if="!isLoggedIn && $route.name === 'home'"
          class="ml-5 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          >Contacto</router-link
        >
        <router-link
          v-if="!isLoggedIn"
          class="ml-4 font-bold border border-gray-400 text-gray-500 hover:text-blue-900 transition duration-150 ease-in-out px-4 py-2 rounded"
          to="/register"
          >Registrarse</router-link
        >
        <router-link
          v-if="isLoggedIn"
          class="ml-4 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          to="/dashboard"
          >Dashboard</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="ml-4 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          to="/users"
          exact
          >Usuarios</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="ml-4 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          to="/clients"
          exact
          >Clientes</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="ml-4 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          :to="{ name: 'invoices', params: { userId: user.id } }"
          >Mis Facturas</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="ml-4 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          to="/tickets"
          >Tickets</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="ml-4 font-bold text-gray-500 hover:text-gray-400 transition duration-150 ease-in-out"
          to="/messages"
          >Correos</router-link
        >

        <router-link
          v-if="!isLoggedIn"
          class="ml-4 font-bold border border-gray-400 text-gray-500 hover:text-blue-900 transition duration-150 ease-in-out px-4 py-2 rounded"
          to="/login"
          >Iniciar Sesión</router-link
        >
      </div>
      <div v-if="user" class="relative hidden md:inline-block ml-auto mr-4">
        <button
          type="button"
          class="flex items-center font-bold text-blue-600 hover:text-white transition duration-150 ease-in-out"
          @mouseover="isOpenDropdown = true"
        >
          <!-- @click="isOpenDropdown = !isOpenDropdown" -->
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="user-circle"
            class="h-8 w-8 rounded-full svg-inline--fa fa-user-circle fa-w-16 mr-1"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 496 512"
          >
            <path
              fill="currentColor"
              d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"
            ></path>
          </svg>
          <span>{{ user.name }}</span>
        </button>

        <div
          v-show="isOpenDropdown"
          @mouseleave="isOpenDropdown = false"
          class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100"
          role="menu"
          aria-orientation="vertical"
          aria-labelledby="options-menu"
        >
          <div class="py-1">
            <router-link
              :to="{ name: 'profile', params: { userId: user.id } }"
              v-if="isLoggedIn"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-400"
              role="menuitem"
              >Mi Perfil</router-link
            >
            <!-- <a
              href="#"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-400"
              role="menuitem"
              >Duplicate</a
            > -->
          </div>
          <div class="py-1">
            <a
              href="#"
              v-if="isLoggedIn"
              role="menuitem"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 ease-in-out"
              @click="logout"
              >Cerrar Sesión</a
            >
          </div>
        </div>
      </div>
    </nav>
    <div
      v-show="isOpen"
      @click="isOpen = false"
      id="nav-content"
      class="absolute w-full"
    >
      <div
        class="px-2 pt-2 pb-3 rounded-b-lg shadow-sm bg-gray-800 bg-opacity-75"
      >
        <router-link
          v-if="!isLoggedIn"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/"
          >Inicio</router-link
        >
        <router-link
          v-if="!isLoggedIn && $route.name === 'home'"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#clientes"
          >Clientes</router-link
        >
        <router-link
          v-if="!isLoggedIn && $route.name === 'home'"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#about"
          >Acerca de</router-link
        >
        <router-link
          v-if="!isLoggedIn && $route.name === 'home'"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#services"
          >Servicios</router-link
        >
        <router-link
          v-if="!isLoggedIn && $route.name === 'home'"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#contact"
          >Contacto</router-link
        >
        <router-link
          v-if="isLoggedIn"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/dashboard"
          >Dashboard</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/users"
          >Usuarios</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/clients"
          >Clientes</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          :to="{ name: 'invoices', params: { userId: user.id } }"
          >Mis facturas</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/tickets"
          >Tickets</router-link
        >
        <router-link
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/messages"
          >Correos</router-link
        >
        <router-link
          v-if="!isLoggedIn"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white border border-gray-400 hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/login"
          >Iniciar Sesión</router-link
        >
        <router-link
          v-if="!isLoggedIn"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white border border-gray-400 hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/register"
          >Registrarse</router-link
        >
        <router-link
          v-if="isLoggedIn"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          :to="{ name: 'profile', params: { userId: user.id } }"
          >Mi Perfil</router-link
        >
        <!-- <a
          v-if="
            isLoggedIn &&
            (userRole === roles.superadmin || userRole === roles.admin)
          "
          href="#"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          role="menuitem"
          >(Gestión de usuarios) User Management</a
        > -->
        <a
          href="#"
          v-if="isLoggedIn"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          role="menuitem"
          @click="logout"
          >Cerrar sesión</a
        >
      </div>
    </div>
  </div>
</template>
<script>
import { roles } from "../roles";

export default {
  name: "Navbar",
  data() {
    return {
      isOpen: false,
      showNavbar: true,
      lastScrollPosition: 0,
      isOpenDropdown: false,
      roles: roles,
    };
  },
  computed: {
    isLoggedIn: function () {
      return this.$store.getters.isLoggedIn;
    },
    user: function () {
      return this.$store.getters.userData;
    },
    userRole: function () {
      return this.$store.getters.userRole;
    },
  },
  methods: {
    logout: function () {
      this.$store.dispatch("destroyToken").then((response) => {
        this.isOpen = false;
        this.isOpenDropdown = false;
        this.$router.push({ name: "login" });
      });
    },
    onScroll() {
      const currentScrollPosition =
        window.pageYOffset || document.documentElement.scrollTop;
      if (currentScrollPosition < 0) {
        return;
      }
      if (Math.abs(currentScrollPosition - this.lastScrollPosition) < 50) {
        if (this.isOpen) this.isOpen = !this.isOpen;
        return;
      }
      this.showNavbar = currentScrollPosition < this.lastScrollPosition;
      this.lastScrollPosition = currentScrollPosition;
    },
  },
  mounted() {
    window.addEventListener("scroll", this.onScroll);
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  },
};
</script>
<style>
#navbar {
  transition: transform 200ms ease-in-out;
}

#navbar.navbar--hidden {
  box-shadow: none;
  transform: translate3d(0, -100%, 0);
}
</style>
