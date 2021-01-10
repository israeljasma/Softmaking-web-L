<template>
  <div class="container mx-auto bg-white px-6 p-4 my-24 shadow-lg rounded-sm">
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Dashboard</h2>

    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae est facilis
      perspiciatis asperiores, veniam voluptas reiciendis quas voluptates
      repudiandae similique porro libero sapiente iure doloremque inventore.
      Quos, earum iste. Perspiciatis!
    </p>
  </div>
</template>
<script>
export default {
  name: "dashboard",
  data() {
    return {};
  },
  computed: {
    isLoggedIn: function () {
      return this.$store.getters.isLoggedIn;
    },
  },
  mounted() {
    console.log(this.$store.getters.isLoggedIn);
  },
};
</script>
<style>
</style>
