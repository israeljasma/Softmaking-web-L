<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Tickets</h2>

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
              :to="{
                name: 'ticket',
                params: { ticketId: ticket.id, ticketElem: ticket },
              }"
              >Ver</router-link
            >
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
            // console.log(response);
            this.tickets = response.data;
          })
          .catch((error) => {
            // console.log(error);
          });
      }
  },
  computed: {},
  mounted() {
    this.getTickets();
  },
};
</script>
<style lang="">
</style>
