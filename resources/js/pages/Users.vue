<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Usuarios</h2>

    <table
      v-if="users.length > 0"
      class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-md overflow-hidden sm:shadow-sm my-5"
    >
      <thead class="text-white">
        <tr
          v-for="(user, index) in users"
          :key="'header-' + index"
          class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-md sm:rounded-none mb-2 sm:mb-0"
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
            class="border-gray-200 border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ user.id }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            {{ user.name }}
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            {{ user.email }}
          </td>
          <td
            class="border-gray-200 border hover:bg-gray-100 p-2 h-12 text-left md:text-center"
          >
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'invoices', params: { userId: user.id } }"
              >Ver factura</router-link
            >
          </td>
          <td class="border-gray-200 border hover:bg-gray-100 p-2 h-12">
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'user', params: { userId: user.id, userElem: user } }"
              >Ver</router-link
            >
              <!-- TODO: crear vista para modificar usuarios -->
            <!-- <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ name: 'invoices', params: { userId: user.id } }"
              >Editar</router-link
            > -->
            <a
              class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              @click="deleteUser(user)"
              >Eliminar</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  name: "users",
  data() {
    return {
      users: [],
    };
  },
  methods: {
    getUsers: function () {
      axios
        .get("api/users")
        .then((response) => {
          this.users = response.data;
        })
        .catch((error) => {
            this.$toasted.error(
                "Ha ocurrido un error al cargar los usuarios"
            );
        });
    },
    deleteUser: function (user) {
      Vue.swal({
        title: '¿Estás seguro que deseas eliminar el usuario?',
        text: 'Al realizar esta acción, ya no será posible recuperar el usuario',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'No, cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/users/${user.id}`, user).then( (res) => {
                Vue.swal(
                    'Eliminado!',
                    'El usuario ha sido eliminada',
                    'success'
                ).then( () => {
                    // this.$router.go(0);
                    this.getUsers()
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
