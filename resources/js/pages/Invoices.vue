<template>
  <div class="container mx-auto bg-white px-6 p-4 my-24 shadow-lg rounded-sm">
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Facturas</h2>

    <ul v-if="invoices">
      <pre>{{ invoices }}</pre>
    </ul>
  </div>
</template>
<script>
export default {
  name: "invoices",
  data() {
    return {
      invoices: [],
      user: this.$route.params.id || null,
    };
  },
  methods: {
    getInvoices: function () {
      if (this.user) {
        axios
          .get(`/api/users/${this.user}/invoices`, {
            //   headers: {
            //     Authorization: "Bearer " + localStorage.getItem('access_token')
            //   },
          })
          .then((response) => {
            console.log(response);
            this.invoices = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
  computed: {},
  mounted() {
    console.log(this.user);
    this.getInvoices();
  },
};
</script>
<style lang="">
</style>
