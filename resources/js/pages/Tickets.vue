<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <div class="flex justify-between mb-3">
        <h2 class="text-3xl text-blue-700 font-bold mb-3">Tickets</h2>
        <router-link
            :to="{ name: 'createTicket' }"
            class="px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
            >Crear</router-link
        >
    </div>
    <table
      v-if="tickets.length > 0"
      class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-sm my-5"
    >
      <thead class="text-white">
        <tr
          v-for="(ticket, index) in tickets"
          :key="'header-' + index"
          class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
        >
          <th class="p-3 text-left h-12" scope="col">Ticket</th>
          <th class="p-3 text-left h-12" scope="col">Categoría</th>
          <th class="p-3 text-left h-12" scope="col">Título</th>
          <th class="p-3 text-left h-12" scope="col">Estado</th>
          <th class="p-3 text-left h-12" scope="col">Última actualización</th>
          <th class="p-3 text-left h-12" scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr
          v-for="ticket in tickets"
          :key="ticket.id"
          class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
        >
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ ticket.ticket_id }}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ ticket.category_id }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ ticket.title }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ ticket.status }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ ticket.updated_at | formatDate}}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 text-left md:text-center"
          >
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'ticket', params: { ticketId: ticket.id } }"
              >Ver</router-link
            >
            <!-- TODO: a la espera que se creen estos ENDPOINTS-->
            <!-- <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{
                name: 'editTicket',
                params: { ticketId: ticket.id, ticketElem: ticket },
              }"
              >Editar</router-link
            > -->
            <!-- <a
              class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              @click="deleteTicket(ticket)"
              >Eliminar</a
            > -->
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="container mx-auto px-6 md:p-12 text-center bg-white md:border md:border-blue-600 shadow-sm rounded-md">
      <p class="text-xl">
        No se encontraron tickets creados
      </p>
    </div>
  </div>
</template>
<script>
export default {
  name: "tickets",
  data() {
    return {
      tickets: [],
    };
  },
  methods: {
    getTickets: function () {
        axios
          .get(`/api/tickets`)
          .then((response) => {
            this.tickets = response.data;
          })
          .catch((error) => {
            this.showSwalToast("Ha ocurrido un error al cargar los tickets", "error", 3000)
          });
      },
    deleteClient: function (ticket) {
        Vue.swal({
            title: '¿Estás seguro que deseas eliminar el ticket?',
            text: 'Al realizar esta acción, ya no será posible recuperarlo',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/tickets/${ticket.id}`, ticket).then( (res) => {
                        Vue.swal(
                            'Eliminado!',
                            'El ticket ha sido eliminado',
                            'success'
                        ).then( () => {
                            // this.$router.go(0);
                            this.getTickets()
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
    this.getTickets();
  },
};
</script>
