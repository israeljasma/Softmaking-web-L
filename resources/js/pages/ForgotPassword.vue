<template>
  <div
    class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm md:border md:border-blue-600 rounded-md"
  >
    <h2 class="text-3xl text-center text-blue-700 font-bold mb-3">
      Restablecer contraseña
    </h2>
    <form
      autocomplete="off"
      @submit.prevent="requestResetPassword"
      method="post"
      class="flex flex-col"
    >
      <div class="flex flex-col gap-4">
        <div class="mb-2">
          <label for="email" class="block text-sm font-medium text-gray-700"
            >Correo electrónico</label
          >
          <input
            v-model="email"
            type="email"
            name="email"
            id="email"
            placeholder="user@example.com"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('name') is-invalid @enderror"
          />
        </div>
        <button
          type="submit"
          class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-md font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
          <span class="flex">
            <svg
              v-if="sending"
              class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
              ></circle>
              <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              ></path></svg
            >Enviar enlace de recuperación de contraseña
          </span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      has_error: false,
      sending: false,
    };
  },
  methods: {
    requestResetPassword() {
      this.sending = true;
      axios
        .post("api/password/email", { email: this.email })
        .then((res) => {
          this.showSwalToast("Enlace para restablecer la contraseña enviado a su correo electrónico", "error", 3000)
        })
        .catch((err) => {
          this.showSwalToast(
            "Ha ocurrido un error al intentar enviar en enlace para restablecer la contraseña"
          , "error", 3000)
        })
        .finally(() => {
          this.sending = false;
        });
    },
  },
};
</script>
