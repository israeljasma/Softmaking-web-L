<template>
  <div class="container mx-auto px-6 p-4 my-24">
    <div class="flex justify-between mb-3">
      <h2 class="text-3xl text-blue-700 font-bold">Empresas</h2>
      <router-link
        v-if="userId"
        :to="{ name: 'createBusiness' }"
        class="px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
        >Crear</router-link
      >
    </div>

    <table
      v-if="business.length > 0"
      class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-sm my-5"
    >
      <thead class="text-white">
        <tr
          v-for="(b, index) in business"
          :key="'header-' + index"
          class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
        >
          <th class="p-3 text-left h-12" scope="col">#</th>
          <th class="p-3 text-left h-12" scope="col">Nombre empresa</th>
          <th class="p-3 text-left h-12" scope="col">RUT</th>
          <th class="p-3 text-left h-12" scope="col">Dirección</th>
          <th class="p-3 text-left h-12" scope="col">Teléfono</th>
          <th class="p-3 text-left h-12" scope="col">Correo</th>
          <th class="p-3 text-left h-12" scope="col">Ver</th>
          <th class="p-3 text-left h-12" scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr
          v-for="b in business"
          :key="b.id"
          class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
        >
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ b.id }}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ b.business_name }}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 md:text-center"
            scope="row"
          >
            {{ b.rut }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ b.address }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ b.phone }}
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            {{ b.email }}
          </td>
          <td
            class="border-grey-light border hover:bg-gray-100 p-2 h-12 text-left md:text-center"
          >
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{
                name: 'business',
                params: { businessId: b.id, businessElem: b },
              }"
              >Ver</router-link
            >
          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-2 h-12">
            <router-link
              class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{
                name: 'editBusiness',
                params: { businessId: b.id, businessElem: b },
              }"
              >Editar</router-link
            >
            <router-link
              class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
              :to="{ path: '/' }"
              >Eliminar</router-link
            >
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="p-4 md:p-12 text-center bg-white shadow-sm md:border md:border-blue-600 rounded-md">
      <p class="text-xl">No se encontraron empresas asociadas a este usuario</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "business",
  data() {
    return {
      business: [],
      userId: this.$route.params.userId || null,
    };
  },
  methods: {
    getBusiness: function () {
      if (this.userId) {
        axios
          .get(`/api/users/${this.userId}/business`)
          .then((response) => {
            // console.log(response);
            this.business = response.data.Business;
          })
          .catch((error) => {
            // console.log(error);
          });
      }
    },
  },
  computed: {},
  mounted() {
    this.getBusiness();
  },
};
</script>
<style lang="">
</style>
