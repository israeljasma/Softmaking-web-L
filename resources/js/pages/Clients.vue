<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <div class="flex justify-between mb-3">
      <h2 class="text-3xl text-blue-700 font-bold">Clientes</h2>
      <router-link
        :to="{ name: 'createClient' }"
        class="px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
        >Crear</router-link
      >
    </div>

    <table
      v-if="clients.length > 0"
      class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-md overflow-hidden sm:shadow-sm my-5"
    >
      <thead class="text-white">
        <tr
          v-for="(client, index) in clients"
          :key="'header-' + index"
          class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-md sm:rounded-none mb-2 sm:mb-0"
        >
          <th class="p-3 text-left h-12" scope="col">#</th>
          <th class="p-3 text-left h-12" scope="col">Nombre</th>
          <th class="p-3 text-left h-12" scope="col">Descripción</th>
          <th class="p-3 text-left h-12" scope="col">URL logo</th>
          <th class="p-3 text-left h-12" scope="col">URL Sitio</th>
          <!-- <th class="p-3 text-left h-12" scope="col">Creado el</th> -->
          <th class="p-3 text-left h-12" scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr
          v-for="client in clients"
          :key="client.id"
          class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
        >
          <td
            class="border-gray-200 border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ client.id }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            {{ client.name }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12 overflow-ellipsis overflow-auto">
            {{ client.description }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
              <img class="w-24 md:w-48" :src="'/storage/' + client.url_logo" :alt="client.name">
          </td>
          <td
            class="border-gray-200 border hover:bg-gray-100 p-2 h-12 overflow-auto"
          >
            {{ client.url_site }}
          </td>
          <!-- <td
            class="border-gray-200 border hover:bg-gray-100 p-2 h-12 overflow-auto leading-4"
          >
            {{ client.created_at | formatDate }}
          </td> -->
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'editClient', params: { clientId: client.id, clientElem: client } }"
              >Editar</router-link
            >
            <a
              class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              @click="deleteClient(client)"
              >Eliminar</a
            >
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="p-4 md:p-12 text-center bg-white shadow-sm md:border md:border-blue-600 rounded-md">
      <p class="text-xl">No se encontraron clientes</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "clients",
  components: {},
  data() {
    return {
      clients: [],
    };
  },
  methods: {
    getClients: function () {
      axios
        .get("api/clients")
        .then((response) => {
          this.clients = response.data;
        })
        .catch((error) => {
            this.$toasted.error(
              "Ha ocurrido un error al cargar los clientes"
            );
        });
    },
    deleteClient: function (client) {
        Vue.swal({
            title: '¿Estás seguro que deseas remover al cliente?',
            text: 'Al realizar esta acción, ya no será posible recuperarlo',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/clients/${client.id}`, client).then( (res) => {
                        Vue.swal(
                            'Eliminado!',
                            'El cliente ha sido removido de la Base de Datos',
                            'success'
                        ).then( () => {
                            // this.$router.go(0);
                            this.getClients()
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
    this.getClients();
  },
};
</script>
<style lang="css">
html,
body {
  height: 100%;
}

@media (min-width: 640px) {
  table {
    display: inline-table !important;
  }

  thead tr:not(:first-child) {
    display: none;
  }
}

td:not(:last-child) {
  border-bottom: 0;
}

th:not(:last-child) {
  border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}
</style>
