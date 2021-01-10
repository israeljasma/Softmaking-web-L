<template>
  <div
    id="navbar"
    class="fixed md:py-5 md:pl-2 w-full bg-gray-800 bg-opacity-75 md:bg-transparent z-50"
    :class="{ 'navbar--hidden': !showNavbar, 'md:bg-gray-800 bg-opacity-75': isLoggedIn }"
  >
    <nav
      class="relative flex items-center justify-between py-5 pl-2 sm:h-10 lg:justify-start"
    >
      <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
        <div class="flex items-center justify-between w-full md:w-auto">
          <a href="/" aria-label="Home" class="flex flex-row items-center">
            <img
              class="block h-8 w-auto"
              src="imgs/logo-sm.png"
              alt="logo SoftMaking"
            />
            <span
              class="md:hidden text-2xl uppercase font-bold text-center bg-clip-text text-transparent bg-gradient-to-b from-blue-300 via-blue-700 to-blue-900 ml-2"
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
      <div class="hidden md:block md:ml-4 md:pr-2">
        <router-link
          v-if="!isLoggedIn"
          class="ml-2 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          to="/"
          exact
          >Inicio</router-link
        >
        <router-link
          v-if="!isLoggedIn"
          to="#clients"
          class="ml-5 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          >Clientes</router-link
        >
        <router-link
          v-if="!isLoggedIn"
          to="#about"
          class="ml-5 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          >Acerca de</router-link
        >
        <router-link
          v-if="!isLoggedIn"
          to="#services"
          class="ml-5 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          >Servicios</router-link
        >
        <router-link
          to="#contact"
          v-if="!isLoggedIn"
          class="ml-5 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
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
          class="ml-4 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          to="/dashboard"
          >Dashboard</router-link
        >
        <router-link
          v-if="isLoggedIn"
          class="ml-4 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          to="/users"
          >Usuarios</router-link
        >
        <router-link
          v-if="isLoggedIn"
          class="ml-4 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          :to="{ name: 'invoices', params: { id: 1 }}"
          >Facturas</router-link
        >
        <router-link
          v-if="isLoggedIn"
          class="ml-4 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out"
          to="/tickets"
          >Tickets</router-link
        >

        <router-link
          v-if="!isLoggedIn"
          class="ml-4 font-bold border border-gray-400 text-gray-500 hover:text-blue-900 transition duration-150 ease-in-out px-4 py-2 rounded"
          to="/login"
          >Iniciar Sesión</router-link
        >

        <span
          v-else
          class="ml-4 font-bold text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out"
          @click="logout"
          >Cerrar Sesión</span
        >
        <!-- <router-link v-if="isLoggedIn" to="/logout">Cerrar Sesión</router-link> -->
      </div>
    </nav>

    <div v-if="isOpen" id="nav-content" class="absolute w-full">
      <div
        class="px-2 pt-2 pb-3 rounded-b-lg shadow-sm bg-gray-800 bg-opacity-75"
      >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/"
          >Inicio</router-link
        >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#clientes"
          >Clientes</router-link
        >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#about"
          >Acerca de</router-link
        >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#services"
          >Servicios</router-link
        >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="#contact"
          >Contacto</router-link
        >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/dashboard"
          >Dashboard</router-link
        >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white border border-gray-400 hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/login"
          >Iniciar Sesión</router-link
        >
        <router-link
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white border border-gray-400 hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          to="/register"
          >Registrarse</router-link
        >
        <a
          href="#"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          role="menuitem"
          >(Gestión de usuarios) User Management</a
        >
        <router-link
          to="/logout"
          class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          role="menuitem"
          @click="logout"
          >Cerrar sesión</router-link
        >
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Navbar",
  data() {
    return {
      isOpen: false,
      showNavbar: true,
      lastScrollPosition: 0,
    };
  },
  computed: {
    isLoggedIn: function () {
      return this.$store.getters.isLoggedIn;
    },
  },
  methods: {
    logout: function () {
      this.$store.dispatch("destroyToken").then((response) => {
        this.$router.push({ name: "login" });
      });
    },
    onScroll() {
      const currentScrollPosition =
        window.pageYOffset || document.documentElement.scrollTop;
      if (currentScrollPosition < 0) {
        return;
      }
      // Stop executing this function if the difference between
      // current scroll position and last scroll position is less than some offset
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
