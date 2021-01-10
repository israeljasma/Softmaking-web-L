<template>
  <div class="w-full h-screen bg-white">
    <Navbar />
    <main class="flex items-start justify-center w-full h-screen">
      <router-view></router-view>
    </main>
  </div>
</template>
<script>
import Navbar from "./Navbar";

export default {
  name: "App",
  components: {
    Navbar,
  },
};
</script>
<style lang="">
</style>
