<template>
  <div
    class="container mx-auto bg-white px-6 p-4 mb-6 shadow-sm md:border md:border-blue-600 rounded-md"
    v-if="business.length > 0"
  >
    <h1 v-if="!editMode" class="text-3xl text-blue-700 font-bold mb-3">
      Crear nueva empresa
    </h1>
    <h1 v-else class="text-3xl text-blue-700 font-bold mb-3">
      Editar empresas
    </h1>
    <form
      v-for="(b, index) in business"
      :key="index"
      @submit.prevent="saveBusiness(b)"
      enctype="multipart/form-data"
      class="flex flex-col"
    >
      <div class="flex flex-col gap-4">
        <div class="mb-2 mt-2">
          <div class="flex justify-between">
            <h1 class="text-xl text-blue-700 font-bold mb-3">
              {{ b.business_name }}
            </h1>
            <button
              type="button"
              @click.self="deleteBusiness(b, index)"
              class="bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md text-white"
            >
              Borrar
            </button>
          </div>
          <label
            for="business_name"
            class="block text-sm font-medium text-gray-700"
            >Nombre</label
          >
          <input
            v-model="b.business_name"
            type="text"
            name="business_name"
            :id="`business_name-${index}`"
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
            v-model="b.rut"
            type="text"
            name="rut"
            :id="`rut-${index}`"
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
            v-model="b.address"
            type="text"
            name="address"
            :id="`address-${index}`"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
        <div class="mb-2">
          <label for="phone_b" class="block text-sm font-medium text-gray-700"
            >Teléfono</label
          >
          <input
            v-model="b.phone"
            type="text"
            name="phone"
            :id="`phone_b-${index}`"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
        <div class="mb-2">
          <label for="email_b" class="block text-sm font-medium text-gray-700"
            >Correo</label
          >
          <input
            v-model="b.email"
            type="email"
            name="email"
            :id="`email_b-${index}`"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
      </div>
      <button
        class="inline-flex justify-center py-2 px-4 mt-2 mb-4 border border-transparent shadow-sm text-md font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        type="submit"
      >
        <span v-if="editMode && b.id" class="flex"
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
      <hr />
    </form>
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
      class="flex bg-green-500 hover:bg-green-700 mt-4 py-2 px-4 rounded-md text-white ml-auto"
      @click="addBusiness"
    >
      Añadir empresa
    </button>
  </div>
</template>
<script>
export default {
  name: "CreateEditbusiness",
  props: ["user"],
  data() {
    return {
      editMode: false,
      business: {
        business_name: null,
        rut: null,
        address: null,
        phone: null,
        email: null,
      },
      msg: null,
      saving: false,
      errorMsg: null,
    };
  },
  mounted() {
    this.getBusiness();
  },
  methods: {
    deleteBusiness: function (b, index) {
      this.$swal({
        title:
          "<h1 class='text-xl text-blue-700 font-bold mb-3'>¿Estás seguro que deseas remover esta empresa?</h1>",
        text: "No puedes revertir tu acción",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar empresa",
        cancelButtonText: "No, conservarla",
        showCloseButton: true,
        showLoaderOnConfirm: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete(`/api/users/${this.user.id}/business/${b.id}`)
            .then((result) => {
              this.$swal(
                "Eliminado",
                "Ha eliminado con éxito esta empresa",
                "success"
              );
              this.business.splice(index, 1);
            })
            .catch((err) => {
              this.$swal(
                "Cancelado",
                "Ha ocurrido un error al intentar eliminar la empresa",
                "error"
              );
            });
        } else {
          this.$swal("Cancelado", "No se ha hecho ningún cambio", "info");
        }
      });
    },
    addBusiness: function () {
      this.business.push({
        business_name: null,
        rut: null,
        address: null,
        phone: null,
        email: null,
      });
    },
    getBusiness: function () {
      axios
        .get(`/api/users/${this.user.id}/business`)
        .then((res) => {
          console.log(res);
          if (res.data.Business.length > 0) {
            this.business = res.data.Business;
            this.editMode = true;
          } else {
            this.msg = "No se ha encontrado la empresa";
          }
        })
        .catch((err) => {
          this.$toasted.error(
            "No se ha encontrado la empresa que estabas buscando"
          );
        });
      console.log(this.business);
    },
    saveBusiness: function (e) {
      if (this.editMode && e.id) {
        let editedBusiness = new FormData();
        editedBusiness.append("business_name", e.business_name);
        editedBusiness.append("rut", e.rut);
        editedBusiness.append("address", e.address);
        editedBusiness.append("phone", e.phone);
        editedBusiness.append("email", e.email);
        editedBusiness.append("user_id", this.user.id);
        editedBusiness.append("_method", "PATCH");

        this.saving = true;

        axios
          .post(`/api/users/${this.user.id}/business/${e.id}`, editedBusiness)
          .then((res) => {
            this.$toasted.success("Se ha actualizado correctamente la empresa");
          })
          .catch((err) => {
            this.$toasted.error(
              "Ha ocurrido un error al actualizar los datos de la empresa"
            );
          })
          .finally(() => {
            this.saving = false;
          });
      } else {
        let newBusiness = new FormData();
        newBusiness.append("business_name", e.business_name);
        newBusiness.append("rut", e.rut);
        newBusiness.append("address", e.address);
        newBusiness.append("phone", e.phone);
        newBusiness.append("email", e.email);
        newBusiness.append("user_id", this.user.id);

        this.saving = true;

        axios
          .post(`/api/users/${this.user.id}/business`, newBusiness)
          .then((res) => {
            this.$toasted.success("Se ha guardado correctamente la empresa");
            e.id = res.data.id;
            // console.log(res.data.id)
          })
          .catch((err) => {
            this.errorMsg = err.response.data || [];
            this.$toasted.error("Ha ocurrido un error al guardar la empresa");
          })
          .finally(() => {
            this.saving = false;
          });
      }
    },
  },
};
</script>
