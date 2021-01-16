<template>
  <div
    v-if="ticket"
    class="container mx-auto bg-white px-6 p-4 my-24 shadow-lg rounded-sm"
  >
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Ticket {{ ticket.ticket_id }}
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles del ticket</p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Nombre</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ ticket.title }}
          </dd>
        </div>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Estado</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ ticket.status }}
          </dd>
        </div>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Prioridad</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ ticket.priority }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Mensaje</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ ticket.message }}
          </dd>
        </div>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Fecha</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ ticket.created_at }}
          </dd>
        </div>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
        >
          <dt class="text-sm font-medium text-gray-500">Comentarios</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <p class="py-3" v-for="comment in ticket.comments" :key="comment.id">
                {{ comment.comment }}
            </p>
          </dd>
        </div>
      </dl>
    </div>
  </div>
  <div v-else class="container mx-auto px-6 p-4 my-24">
    <div class="p-4 md:p-12 text-center bg-white shadow-lg rounded-sm">
      <p class="text-xl">No existe este ticket</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "ticket",
  props: ["ticketElem"],
  data() {
    return {
      ticket: this.ticketElem || null,
      ticketId: this.$route.params.ticketId || null,
    };
  },
  methods: {
    getTicket: function () {
      if (this.ticketId) {
        axios
          .get(`/api/tickets/${this.ticketId}`)
          .then((response) => {
            // console.log(response);
            this.ticket = response.data.ticket;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
  computed: {},
  mounted() {
    // console.log(this.ticketId);
    this.getTicket();
  },
};
</script>
