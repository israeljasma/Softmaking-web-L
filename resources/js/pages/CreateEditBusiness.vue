<template>
  <div
    class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm md:border md:border-blue-600 rounded-md"
  >
    <h1 v-if="!editMode" class="text-3xl text-blue-700 font-bold mb-3">
      Crear nueva empresa
    </h1>
    <h1 v-else class="text-3xl text-blue-700 font-bold mb-3">Editar empresa</h1>

    <form
      @submit.prevent="saveBusiness"
      enctype="multipart/form-data"
      class="flex flex-col"
    >
      <div class="flex flex-col gap-4">
        <div class="mb-2">
          <label for="business_name" class="block text-sm font-medium text-gray-700"
            >Nombre</label
          >
          <input
            v-model="business.business_name"
            type="text"
            name="business_name"
            id="business_name"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
        <div class="mb-2">
          <label for="rut" class="block text-sm font-medium text-gray-700"
            >RUT</label
          >
          <input
            v-model="business.rut"
            type="text"
            name="rut"
            id="rut"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
        <div class="mb-2">
          <label for="address" class="block text-sm font-medium text-gray-700"
            >Dirección</label
          >
          <input
            v-model="business.address"
            type="text"
            name="address"
            id="address"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
        <div class="mb-2">
          <label for="phone" class="block text-sm font-medium text-gray-700"
            >Teléfono</label
          >
          <input
            v-model="business.phone"
            type="text"
            name="phone"
            id="phone"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
        <div class="mb-2">
          <label for="email" class="block text-sm font-medium text-gray-700"
            >Correo</label
          >
          <input
            v-model="business.email"
            type="email"
            name="email"
            id="email"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>

      </div>
      <button
        class="inline-flex justify-center py-2 px-4 mt-2 border border-transparent shadow-sm text-md font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        type="submit"
      >
        <span v-if="editMode" class="flex"
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
          >Crear empresa</span
        >
      </button>
    </form>
  </div>
</template>
<script>
export default {
  name: "CreateEditbusiness",
  props: ["businessId", "businessElem"],
  data() {
    return {
      editMode: false,
      userId: this.$route.params.userId || null,
      business: {
        business_name: null,
        rut: null,
        address: null,
        phone: null,
        email: null
      },
      msg: null,
      saving: false,
    };
  },
  mounted() {
    if (this.businessElem) {
      const { business_name, rut, address, phone, email } = this.businessElem;
      this.business = { business_name, rut, address, phone, email };
      this.editMode = true;
    } else {
      if (this.businessId) {
        this.getBusiness();
      }
    }
  },
  methods: {
    getBusiness: function () {
      axios
        .get(`/api/users/${this.userId}/business/${this.businessId}`)
        .then((res) => {
          if (res.data.length > 0) {
            this.business = res.data;
            this.editMode = true;
          } else {
            this.msg = "No se ha encontrado la empresa";
            this.showSwalToast("No se ha encontrado la empresa", "error", 3000)
          }
        })
        .catch((err) => {
            this.showSwalToast("No se ha encontrado la empresa", "error", 3000)
        });
    },
    saveBusiness: function () {
      if (this.businessId && this.editMode) {
        let editedBusiness = new FormData();
        editedBusiness.append("business_name", this.business.business_name);
        editedBusiness.append("rut", this.business.rut);
        editedBusiness.append("address", this.business.address);
        editedBusiness.append("phone", this.business.phone);
        editedBusiness.append("email", this.business.email);
        editedBusiness.append("user_id", this.userId);
        editedBusiness.append("_method", "PATCH");

        this.saving = true;

        axios
          .post(
            `/api/users/${this.userId}/business/${this.businessId}`,
            editedBusiness
          )
          .then((res) => {
            this.showSwalToast("Se ha actualizado correctamente la empresa", "success", 2000)
          })
          .catch((err) => {
            this.showSwalToast("Ha ocurrido un error al actualizar los datos de la empresa", "error", 3000)
          })
          .finally(() => {
            this.saving = false;
          });
      } else {
        let newBusiness = new FormData();
        newBusiness.append("business_name", this.business.business_name);
        newBusiness.append("rut", this.business.rut);
        newBusiness.append("address", this.business.address);
        newBusiness.append("phone", this.business.phone);
        newBusiness.append("email", this.business.email);
        newBusiness.append("user_id", this.userId);

        this.saving = true;

        axios
          .post(`/api/users/${this.userId}/business`, newBusiness)
          .then((res) => {
            this.showSwalToast("Se ha guardado correctamente la empresa", "success", 2000)
          })
          .catch((err) => {
            this.showSwalToast("Ha ocurrido un error al guardar la empresa", "error", 3000)
          })
          .finally(() => {
            this.saving = false;
          });
      }
    }
  },
};
</script>
