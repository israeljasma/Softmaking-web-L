<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Usuarios</h2>

    <table
      v-if="users.length > 0"
      class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-sm my-5"
    >
      <thead class="text-white">
        <tr
          v-for="(user, index) in users"
          :key="'header-' + index"
          class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
        >
          <th class="p-3 text-left h-12" scope="col">#</th>
          <th class="p-3 text-left h-12" scope="col">Nombre</th>
          <th class="p-3 text-left h-12" scope="col">Correo</th>
          <th class="p-3 text-left h-12" scope="col">Facturas</th>
          <th class="p-3 text-left h-12" scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr
          v-for="user in users"
          :key="user.id"
          class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
        >
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ user.id }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ user.name }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ user.email }}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 text-left md:text-center"
          >
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'invoices', params: { userId: user.id } }"
              >Ver</router-link
            >
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            <!-- <button type="button" class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg" href="#" @click.stop="toggleModal(user.id)"
              >Editar</button
            >
            <button type="button" class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg" href="#" @click.stop="toggleModal(user.id)"
              >Eliminar</button
            > -->
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'invoices', params: { userId: user.id } }"
              >Editar</router-link
            >
            <router-link
              class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'invoices', params: { userId: user.id } }"
              >Eliminar</router-link
            >
          </td>
          <user-profile-modal
            :show="showModal(user.id)"
            @close="toggleModal(user.id)"
          />
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import UserProfileModal from "../components/EditUserModal";
export default {
  name: "users",
  components: { UserProfileModal },
  data() {
    return {
      activeModal: 0,
      users: [],
    };
  },
  methods: {
    getUsers: function () {
      axios
        .get("api/users")
        .then((response) => {
        //   console.log(response);
          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    showModal: function (id) {
      return this.activeModal === id;
    },
    toggleModal: function (id) {
      if (this.activeModal !== 0) {
        this.activeModal = 0;
        return false;
      }
      this.activeModal = id;
    },
  },
  computed: {},
  mounted() {
    this.getUsers();
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
