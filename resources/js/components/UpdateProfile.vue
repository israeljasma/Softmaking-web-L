<template>
  <div
    class="bg-white px-6 p-4 mb-4 shadow-sm border border-blue-600 rounded-md"
  >
    <h1 class="text-2xl text-blue-600 font-bold mb-2">Mis datos de perfil</h1>
    <form v-if="user" class="flex flex-col" @submit.prevent="saveChanges">
      <div class="mb-3">
        <label for="name" class="block text-sm font-medium text-gray-700"
          >Nombres</label
        >
        <input
          v-model="user.name"
          type="text"
          name="name"
          id="name"
          required
          autofocus
          class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('name') is-invalid @enderror"
        />
      </div>
      <div class="mb-3">
        <label for="lastname" class="block text-sm font-medium text-gray-700"
          >Apellidos</label
        >
        <input
          v-model="user.lastname"
          type="text"
          name="lastname"
          id="lastname"
          required
          autofocus
          class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('lastname') is-invalid @enderror"
        />
      </div>
      <div class="mb-3">
        <label for="phone" class="block text-sm font-medium text-gray-700"
          >Teléfono</label
        >
          <input
            v-model="user.phone"
            type="text"
            name="phone"
            id="phone"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('phone') is-invalid @enderror"
          />
      </div>
      <div class="mb-3">
        <label for="email" class="block text-sm font-medium text-gray-700"
          >Correo</label
        >
        <input
          v-model="user.email"
          type="email"
          name="email"
          id="email"
          disabled
          autofocus
          class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('email') is-invalid @enderror"
        />
      </div>
      <div class="mb-3">
        <label for="created_at" class="block text-sm font-medium text-gray-700"
          >Estás desde el</label
        >
        <p class="block text-md font-medium text-gray-600">
          <input
            v-model="created_at"
            type="text"
            name="created_at"
            id="created_at"
            disabled
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('created_at') is-invalid @enderror"
          />
        </p>
      </div>
      <button
        class="w-full flex mx-auto items-center justify-center py-2 px-4 mt-2 shadow-sm text-md font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        type="submit"
      >
        <span class="flex"
          ><svg
            v-if="savingProfile"
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
          >Guardar cambios</span
        >
      </button>
    </form>
  </div>
</template>
<script>
export default {
  name: "updateprofile",
  data() {
    return {
      user: null,
      savingProfile: false,
    };
  },
  computed: {
    created_at: function () {
      return Vue.filter("formatDate")(this.user.created_at);
    },
  },
  mounted() {
    axios
      .get("/api/profile")
      .then((res) => {
        this.user = res.data;
        // console.log(res);
      })
      .catch((err) => {
        this.$toasted.error("Ha ocurrido al intentar cargar tus datos");
        // console.log(err);
      });
  },
  methods: {
    saveChanges: function () {
      let editedProfile = new FormData();
      editedProfile.append("name", this.user.name);
      editedProfile.append("lastname", this.user.lastname);
      editedProfile.append("phone", this.user.phone);
      //   editedProfile.append("email", this.user.email);
      editedProfile.append("_method", "PATCH");

      this.savingProfile = false;

      axios
        .post(`/api/profile/update`, editedProfile)
        .then((res) => {
          this.$toasted.success("Se ha actualizado correctamente tus datos");
        })
        .catch((err) => {
          this.$toasted.error("Ha ocurrido un error al actualizar tus datos");
        })
        .finally(() => {
          this.savingProfile = false;
        });
    },
  },
};
</script>
