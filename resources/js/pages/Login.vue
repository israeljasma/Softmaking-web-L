<template>
  <div class="container">
    <div class="md:h-screen flex justify-center items-center px-6 my-24 md:my-0">
      <div class="w-full xl:w-3/4 lg:w-11/12 flex">
        <div
          class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
          style="background-image: url('imgs/login-bg.jpg')"
        ></div>
        <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
          <h3 class="pt-4 text-2xl text-center font-semibold">
            Iniciar Sesión
          </h3>
          <form
            class="px-2 md:px-8 pt-6 pb-8 mb-4 bg-white rounded"
            method="POST"
            @submit.prevent="login"
          >
            <div class="mb-4">
              <label
                class="block mb-2 text-sm font-bold text-gray-700"
                for="email"
              >
                Correo electrónico
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('email') is-invalid @enderror"
                id="email"
                type="email"
                name="email"
                v-model="email"
                required
                autocomplete="email"
                autofocus
              />
            </div>
            <div class="mb-4">
              <label
                class="block mb-2 text-sm font-bold text-gray-700"
                for="password"
              >
                Contraseña
              </label>
              <input
                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror"
                id="password"
                type="password"
                name="password"
                v-model="password"
                required
                autocomplete="current-password"
              />

              <div
                v-if="error"
                class="bg-red-100 border-t border-b border-red-500 text-dark-700 px-4 py-3"
                role="alert"
              >
                <p class="text-sm">{{ error }}</p>
              </div>
            </div>
            <div class="mb-4">
              <input
                class="mr-2 leading-tight"
                type="checkbox"
                name="remember"
                id="remember"
              />
              <label class="text-sm" for="remember"> Recuérdame </label>
            </div>

            <div class="mb-6 text-center">
              <button
                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                type="submit"
              >
                Iniciar Sesión
              </button>
            </div>
            <hr class="mb-6 border-t" />
            <div class="text-center">
              <router-link
                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                to="/register"
                >Registrarse</router-link
              >
            </div>
            <div class="text-center">
              <router-link
                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                to="/forgot-password"
                >¿Olvidó su cotraseña?</router-link
              >
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      error: null,
    };
  },
  methods: {
    login() {
      this.$store
        .dispatch("retrieveToken", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          this.$router.push({ name: "dashboard" });
        })
        .catch((error) => {
          const { message } = error.response.data;
          this.error = message;
        });
    },
  },
};
</script>
