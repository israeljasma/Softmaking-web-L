<template>
  <div
    v-if="user"
    class="container mx-auto bg-white my-24 shadow-md md:border md:border-blue-600 rounded-md"
  >
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Usuario {{ user.id }}
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles del usuario</p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Nombre</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ user.name }} {{ user.lastname }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Correo</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ user.email }}
          </dd>
        </div>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ user.phone || "No registra número de teléfono" }}
          </dd>
        </div>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Creó la cuenta el</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ user.created_at | formatDate }}
          </dd>
        </div>

      </dl>
    </div>
  </div>
  <div v-else class="container mx-auto px-6 p-4 my-24">
    <div
      class="p-4 md:p-12 text-center bg-white shadow-md rounded-md md:border md:border-blue-600"
    >
      <p class="text-xl">No existe información de este usuario</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "User",
  props: ["userElem"],
  data() {
    return {
      user: this.userElem || null,
      userId: this.$route.params.userId || null,
    };
  },
  methods: {
    getUser: function () {
      if (this.userId && !this.user) {
        axios
          .get(`/api/users/${this.userId}`)
          .then((response) => {
            this.user = response.data;
          })
         .catch((error) => {
            this.showSwalToast("Ha ocurrido un error al cargar el usuario", "error", 3000)
        });
      }
    },
  },
  computed: {},
  mounted() {
    this.getUser();
  },
};
</script>
