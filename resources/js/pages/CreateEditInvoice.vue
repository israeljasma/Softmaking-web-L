<template>
  <div
    class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm md:border md:border-blue-600 rounded-md"
  >
    <h1 v-if="!editMode" class="text-3xl text-blue-700 font-bold mb-3">
      Crear nueva factura
    </h1>
    <h1 v-else class="text-3xl text-blue-700 font-bold mb-3">Editar factura</h1>

    <form
      @submit.prevent="saveInvoice"
      enctype="multipart/form-data"
      class="flex flex-col"
    >
      <div class="flex flex-col gap-4">
        <div class="mb-2">
          <label for="name" class="block text-sm font-medium text-gray-700"
            >Nombre</label
          >
          <input
            v-model="invoice.name"
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
            v-model="invoice.description"
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
          <label for="date" class="block text-sm font-medium text-gray-700"
            >Fecha</label
          >
          <input
            v-model="invoice.date"
            type="date"
            name="date"
            id="date"
            required
            autofocus
            class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
          />
        </div>
        <div class="mb-2">
          <label for="file" class="block text-sm font-medium text-gray-700"
            >Archivo</label
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
              accept=".pdf"
              @change="selectFile"
              autofocus
            />
          </label>
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
          >Crear factura</span
        >
      </button>
    </form>

    <div v-if="editMode && typeof invoice.file !== 'object'" class="my-4">
      <hr />
      <h1 class="text-2xl text-gray-700 font-bold my-2 text-center">
        Vista previa del archivo
      </h1>
      <div class="w-full" style="--aspect-ratio: 16/9">
        <iframe :src="'/storage/' + invoice.file" frameborder="0"></iframe>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "CreateEditInvoice",
  props: ["invoiceId", "invoiceElem"],
  data() {
    return {
      editMode: false,
      userId: this.$route.params.userId || null,
      invoice: {
        name: null,
        description: null,
        date: new Date().toISOString().substr(0, 10),
        file: null,
      },
      msg: null,
      saving: false,
    };
  },
  mounted() {
    if (this.invoiceElem) {
      const { name, description, date, file } = this.invoiceElem;
      this.invoice = { name, description, date, file };
      this.editMode = true;
    } else {
      if (this.invoiceId) {
        this.getInvoice();
      }
    }
  },
  methods: {
    getInvoice: function () {
      axios
        .get(`/api/users/${this.userId}/invoices/${this.invoiceId}`)
        .then((res) => {
          if (res.data.invoice.length > 0) {
            this.invoice = res.data.invoice[0];
            this.editMode = true;
          } else {
            this.msg = "No se ha encontrado la factura";
          }
        })
        .catch((err) => {
          this.$toasted.error(
            "No se ha encontrado la factura que estabas buscando"
          );
        });
    },
    saveInvoice: function () {
      if (this.invoiceId && this.editMode) {
        let editedInvoice = new FormData();
        editedInvoice.append("name", this.invoice.name);
        editedInvoice.append("description", this.invoice.description);
        editedInvoice.append("date", this.invoice.date);
        editedInvoice.append("file", this.invoice.file);
        editedInvoice.append("_method", "PATCH");

        this.saving = true;

        axios
          .post(
            `/api/users/${this.userId}/invoices/${this.invoiceId}`,
            editedInvoice
          )
          .then((res) => {
            this.$toasted.success("Se ha actualizado correctamente la factura");
          })
          .catch((err) => {
            this.$toasted.error(
              "Ha ocurrido un error al actualizar los datos de la factura"
            );
          })
          .finally(() => {
            this.saving = false;
          });
      } else {
        let newInvoice = new FormData();
        newInvoice.append("name", this.invoice.name);
        newInvoice.append("description", this.invoice.description);
        newInvoice.append("date", this.invoice.date);
        newInvoice.append("file", this.invoice.file);

        this.saving = true;

        axios
          .post(`/api/users/${this.userId}/invoices`, newInvoice)
          .then((res) => {
            this.$toasted.success("Se ha guardado correctamente la factura");
          })
          .catch((err) => {
            this.$toasted.error("Ha ocurrido un error al guardar la factura");
          })
          .finally(() => {
            this.saving = false;
          });
      }
    },
    selectFile: function (e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.invoice.file = files[0];
      //   console.log(e);
    },
  },
};
</script>
<style lang="">
</style>
