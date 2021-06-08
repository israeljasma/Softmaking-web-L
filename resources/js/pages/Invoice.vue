<template>
  <div
    v-if="invoice"
    class="container mx-auto bg-white my-24 shadow-md md:border md:border-blue-600 rounded-md"
  >
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Factura {{ invoice.id }}
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles de la factura</p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Nombre</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ invoice.name }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Descripción</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ invoice.description }}
          </dd>
        </div>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Fecha</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ invoice.date }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Documento de la factura
          </dt>
        </div>
        <div class="mt-1 text-sm text-gray-900 aspect-w-16 aspect-h-16">
          <iframe
            width="1600"
            height="900"
            :src="'/storage/' + invoice.file"
            frameborder="0"
          ></iframe>
            <!-- class="w-full h-auto relative" -->
        </div>
      </dl>
    </div>
  </div>
  <div v-else class="container mx-auto px-6 p-4 my-24">
    <div
      class="p-4 md:p-12 text-center bg-white shadow-md rounded-md md:border md:border-blue-600"
    >
      <p class="text-xl">No existe esta factura en este usuario</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "invoice",
  props: ["invoiceElem"],
  data() {
    return {
      invoice: this.invoiceElem || null,
      userId: this.$route.params.userId || null,
      invoiceId: this.$route.params.invoiceId || null,
    };
  },
  methods: {
    getInvoice: function () {
      if (this.userId && this.invoiceId && !this.invoice) {
        axios
          .get(`/api/users/${this.userId}/invoices/${this.invoiceId}`)
          .then((response) => {
            this.invoice = response.data.invoice[0];
          })
          .catch((error) => {
            // console.log(error);
          });
      }
    },
  },
  computed: {},
  mounted() {
    this.getInvoice();
  },
};
</script>
