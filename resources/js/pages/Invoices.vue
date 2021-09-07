<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <div class="flex justify-between mb-3">
      <h2 class="text-3xl text-blue-700 font-bold">Facturas</h2>
      <router-link
        v-if="userId"
        :to="{ name: 'createInvoice' }"
        class="px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
        >Crear</router-link
      >
    </div>

    <table
      v-if="invoices.length > 0"
      class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-sm my-5"
    >
      <thead class="text-white">
        <tr
          v-for="(invoice, index) in invoices"
          :key="'header-' + index"
          class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
        >
          <th class="p-3 text-left h-12" scope="col">#</th>
          <th class="p-3 text-left h-12" scope="col">Nombre</th>
          <th class="p-3 text-left h-12" scope="col">Descripción</th>
          <th class="p-3 text-left h-12" scope="col">Fecha</th>
          <th class="p-3 text-left h-12" scope="col">Ver</th>
          <th class="p-3 text-left h-12" scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr
          v-for="invoice in invoices"
          :key="invoice.id"
          class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
        >
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ invoice.id }}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ invoice.name }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12 overflow-ellipsis md:overflow-clip overflow-auto">
            {{ invoice.description }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ invoice.date }}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 text-left md:text-center"
          >
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{
                name: 'invoice',
                params: { invoiceId: invoice.id, invoiceElem: invoice },
              }"
              >Ver</router-link
            >
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{
                name: 'editInvoice',
                params: { invoiceId: invoice.id, invoiceElem: invoice },
              }"
              >Editar</router-link
            >
            <a
              class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              @click="deleteInvoice(invoice)"
              >Eliminar</a
            >
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="p-4 md:p-12 text-center bg-white shadow-sm md:border md:border-blue-600 rounded-md">
      <p class="text-xl">No se encontraron facturas asociadas a este usuario</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "invoices",
  data() {
    return {
      invoices: [],
      userId: this.$route.params.userId || null,
    };
  },
  methods: {
    getInvoices: function () {
      if (this.userId) {
        axios
          .get(`/api/users/${this.userId}/invoices`)
          .then((response) => {
            this.invoices = response.data.invoices;
          })
          .catch((error) => {
            this.showSwalToast("Ha ocurrido un error al cargar las facturas", "error", 3000)
          });
      }
    },
    deleteInvoice: function (invoice) {
      Vue.swal({
        title: '¿Estás seguro que deseas eliminar la factura?',
        text: 'Al realizar esta acción, ya no será posible recuperar la factura',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'No, cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/users/${this.userId}/invoices/${invoice.id}`, invoice).then( (res) => {
                Vue.swal(
                    'Eliminado!',
                    'La factura ha sido eliminada',
                    'success'
                ).then( () => {
                    // this.$router.go(0);
                    this.getInvoices()
                } )
          } ).catch( (err) => {
                Vue.swal(
                    'Ha ocurrido un error',
                    'Por favor, inténtelo nuevamente',
                    'error'
                )
          } )
        } else if (result.dismiss === Vue.swal.DismissReason.cancel) {
          Vue.swal(
            'Ha cancelado la operación',
            'Tranquilo, no ha pasado nah :)',
            'error'
          )
        }
      })
    }
  },
  computed: {},
  mounted() {
    this.getInvoices();
  },
};
</script>
