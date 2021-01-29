<template>
  <div class="bg-white px-6 p-4 shadow-md border border-blue-600 rounded-sm">
    <h1 class="text-2xl text-blue-700 font-bold mb-2">Cambiar contraseña</h1>
    <form class="flex flex-col" @submit.prevent="saveChanges">
      <!-- <div class="mb-3">
        <label for="password" class="block text-sm font-medium text-gray-700"
          >Actual contraseña</label
        >
        <input
          v-model="password_old"
          type="password"
          name="password_old"
          id="password_old"
          required
          autofocus
          class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('name') is-invalid @enderror"
        />
      </div> -->
      <div class="mb-3">
        <label
          for="password_new"
          class="block text-sm font-medium text-gray-700"
          >Nueva contraseña</label
        >
        <input
          v-model="password_new"
          type="password"
          name="password_new"
          id="password_new"
          required
          autofocus
          class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('name') is-invalid @enderror"
        />
      </div>
      <div class="mb-3">
        <label
          for="password_confirmation"
          class="block text-sm font-medium text-gray-700"
          >Confirmar contraseña</label
        >
        <input
          v-model="password_confirmation"
          type="password"
          name="password_confirmation"
          id="password_confirmation"
          required
          autofocus
          class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('name') is-invalid @enderror"
        />
      </div>
      <div
        v-if="errorMsg"
        class="bg-red-100 border-t border-b border-red-500 text-dark-700 px-4 py-3 mb-5"
        role="alert"
      >
        <h1 class="text-md font-bold mb-2">Corrija los siguientes errores:</h1>
        <p
          v-for="(err, index) in errorMsg"
          :key="'err-' + index"
          class="text-sm ml-1"
        >
          - {{ err.join(", ") }}
        </p>
      </div>
      <button
        class="w-full flex mx-auto items-center justify-center py-2 px-4 mt-2 shadow-sm text-md font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        type="submit"
      >
        <span class="flex"
          ><svg
            v-if="savingPassword"
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
          >Actualizar contraseña</span
        >
      </button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "updatepassword",
  data() {
    return {
      //   password_old: null,
      password_new: null,
      password_confirmation: null,
      savingPassword: false,
      errorMsg: null,
    };
  },
  mounted() {},
  methods: {
    saveChanges: function () {
      this.savingPassword = false;

    //   if (this.password_new === this.password_confirmation) {
        axios
          .put(`/api/profile/password`, {
            password: this.password_new,
            password_confirmation: this.password_confirmation,
          })
          .then((res) => {
            this.$toasted.success(
              "Se ha actualizado correctamente tu contraseña"
            );
          })
          .catch((err) => {
            const { data } = err.response;
            this.errorMsg = data;

            this.$toasted.error(
              "Ha ocurrido un error al actualizar tu contraseña"
            );
          })
          .finally(() => {
            this.savingPassword = false;
          });
    //   }
    },
  },
};
</script>
