<template>
  <div class="w-full mx-auto h-screen bg-white">
    <Navbar />
    <main class="flex items-start justify-center w-full h-screen">
      <transition name="fade" mode="out-in">
        <keep-alive :exclude="exclude">
          <router-view></router-view>
        </keep-alive>
      </transition>
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
  data() {
    return {
      exclude: [
        "invoices",
        "invoice",
        "ticket",
        "CreateEditInvoice",
        "CreateEditClient",
      ],
    };
  },
};
</script>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
