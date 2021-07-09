<template>
  <div
    v-if="!msg"
    class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm md:border md:border-blue-600 rounded-md"
  >
    <h1 v-if="!editMode" class="text-3xl text-blue-700 font-bold mb-3">
      Agregar nuevo cliente
    </h1>
    <h1 v-else class="text-3xl text-blue-700 font-bold mb-3">Editar cliente</h1>

    <form
      @submit.prevent="saveClient"
      enctype="multipart/form-data"
      class="flex flex-col"
    >
      <div class="flex flex-col gap-4">
        <div class="mb-2">
          <label for="name" class="block text-sm font-medium text-gray-700"
            >Nombre</label
          >
          <input
            v-model="client.name"
            type="text"
            name="name"
            id="name"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>

        <div class="mb-2">
          <label for="description" class="block text-sm font-medium text-gray-700"
            >Descripción</label
          >
          <textarea
            v-model="client.description"
            type="text"
            name="description"
            id="description"
            required
            autofocus
            rows="4"
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>

        <div class="mb-2">
          <label for="url_site" class="block text-sm font-medium text-gray-700"
            >Enlace del sitio web</label
          >
          <input
            v-model="client.url_site"
            type="text"
            name="url_site"
            id="url_site"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>

        <div class="mb-2">
          <label for="file" class="block text-sm font-medium text-gray-700"
            >Imagen o logo del sitio web</label
          >
          <label
            class="w-full flex flex-col items-center p-4 text-gray-400 rounded-lg shadow-sm tracking-wide uppercase border border-gray-400 cursor-pointer bg-gray-100 hover:bg-gray-400 hover:text-white overflow-auto"
          >
            <svg
              class="w-8 h-8"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
              />
            </svg>
            <input
              type="file"
              name="file"
              accept="image/*"
              @change="selectFile"
              autofocus
            />
          </label>
        </div>
        <button
          class="inline-flex justify-center py-2 px-4 mt-2 border border-transparent shadow-sm text-md font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          type="submit"
        >
          <span v-if="editMode" class="flex">
            <svg
              v-if="saving"
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
          <span v-else class="flex"
            ><svg
              v-if="saving"
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
            >Agregar cliente</span
          >
        </button>

        <div v-if="img || client.url_logo" class="my-4">
          <hr />
          <h1 class="text-2xl text-gray-700 font-bold my-2 text-center">
            Vista previa de la imagen
          </h1>
          <img
            class="w-full h-64 object-contain"
            v-if="editMode && typeof client.url_logo !== 'object'"
            :src="'/storage/' + client.url_logo"
            :alt="client.name"
          />

          <img
            class="w-full h-64 object-contain"
            v-if="img"
            :src="img"
            alt="Imagen del cliente"
          />
        </div>
      </div>
    </form>
  </div>
  <div
    v-else
    class="container mx-auto px-6 md:p-12 my-24 text-center bg-white md:border md:border-blue-600 shadow-sm rounded-md"
  >
    <p class="text-xl">
      {{ msg }}
    </p>
  </div>
</template>
<script>
export default {
  name: "CreateEditClient",
  props: ["clientId", "clientElem"],
  data() {
    return {
      editMode: false,
      client: {
        name: null,
        description: null,
        url_site: null,
        url_logo: null,
      },
      img: null,
      msg: null,
      saving: false,
    };
  },
  mounted() {
    if (this.clientElem) {
      const { name, description, url_site, url_logo } = this.clientElem;
      this.client = { name, description, url_site, url_logo };
      this.editMode = true;
    } else {
      if (this.clientId) {
        this.getClient();
      }
    }
  },
  methods: {
    getClient: function () {
      axios
        .get(`/api/clients/${this.clientId}`)
        .then((res) => {
          this.client = res.data;
          this.editMode = true;
        })
        .catch((err) => {
          this.msg = "No se ha encontrado el cliente";
          this.$toasted.error(
            "No se ha encontrado el cliente que estabas buscando"
          );
        });
    },
    saveClient: function () {
      if (this.clientId && this.editMode) {
        let editedClient = new FormData();
        editedClient.append("name", this.client.name);
        editedClient.append("description", this.client.description);
        editedClient.append("url_site", this.client.url_site);
        editedClient.append("url_logo", this.client.url_logo);
        editedClient.append("_method", "PATCH");

        this.saving = true;

        axios
          .post(`/api/clients/${this.clientId}`, editedClient)
          .then((res) => {
            this.$toasted.success(
              "Se ha actualizado correctamente los datos del cliente"
            );
          })
          .catch((err) => {
            this.$toasted.error(
              "Ha ocurrido un error al actualizar los datos del cliente"
            );
          })
          .finally(() => {
            this.saving = false;
            this.$router.push({ name: 'clients'})
          });
      } else {
        let newClient = new FormData();
        newClient.append("name", this.client.name);
        newClient.append("description", this.client.description);
        newClient.append("url_site", this.client.url_site);
        newClient.append("url_logo", this.client.url_logo);

        this.saving = true;

        axios
          .post(`/api/clients`, newClient)
          .then((res) => {
            this.$toasted.success("Se ha guardado correctamente el cliente");
          })
          .catch((err) => {
            this.$toasted.error("Ha ocurrido un error al guardar el cliente");
          })
          .finally(() => {
            this.saving = false;
            this.$router.push({ name: 'clients'})
          });
      }
    },
    selectFile: function (e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.client.url_logo = files[0];
      this.createImage(files[0]);
    },
    createImage: function (file) {
      let reader = new FileReader();

      reader.onload = (e) => {
        // this.client.url_logo = e.target.result;
        this.img = e.target.result;
      };
      reader.readAsDataURL(file);
    },
  },
};
</script>
<style lang="">
</style>
