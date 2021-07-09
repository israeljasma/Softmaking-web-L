<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Correos</h2>

    <table
      v-if="messages.length > 0"
      class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-md overflow-hidden sm:shadow-sm my-5"
    >
      <thead class="text-white">
        <tr
          v-for="(message, index) in messages"
          :key="'header-' + index"
          class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-md sm:rounded-none mb-2 sm:mb-0"
        >
          <th class="p-3 text-left h-12" scope="col">#</th>
          <th class="p-3 text-left h-12" scope="col">Nombre</th>
          <th class="p-3 text-left h-12" scope="col">Correo</th>
          <th class="p-3 text-left h-12" scope="col">Teléfono</th>
          <th class="p-3 text-left h-12" scope="col">Asunto</th>
          <th class="p-3 text-left h-24 md:h-12" scope="col">Mensajes</th>
          <th class="p-3 text-left h-12" scope="col">Enviado el</th>
        </tr>
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr
          v-for="message in messages"
          :key="message.id"
          class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
        >
          <td
            class="border-gray-200 border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ message.id }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            {{ message.name }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            {{ message.email }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            {{ message.phone }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12 overflow-auto">
            {{ message.subject }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-24 md:h-12 overflow-auto leading-5">
            {{ message.message }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12 overflow-auto leading-4">
            {{ message.created_at | formatDate }}
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="p-4 md:p-12 text-center bg-white shadow-sm md:border md:border-blue-600 rounded-md">
      <p class="text-xl">No se encontraron mensajes/correos por el momento.</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "messages",
  components: {  },
  data() {
    return {
      messages: [],
    };
  },
  methods: {
    getMessages: function () {
      axios
        .get("api/contactadmin")
        .then((response) => {
          this.messages = response.data;
        })
        .catch((error) => {
            this.$toasted.error(
                "Ha ocurrido un error al cargar los mensajes o correos"
            );
        })
    },
  },
  computed: {},
  mounted() {
    this.getMessages();
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
