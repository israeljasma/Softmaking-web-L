<template>
  <div>
    <modal :show="show" @close="close">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, temporibus?Commodi, cumque ad sapiente nemo iusto officiis laboriosam repellat adipisci.</p>
    </modal>
  </div>
</template>

<script>
import Modal from "./_templates/Modal";
export default {
  props: ["show"],
  components: { Modal },
  methods: {
    close: function () {
      this.$emit("close");
    },
  },
};
</script>
