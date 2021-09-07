<template>
  <div
    class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm border border-blue-600 rounded-md"
  >
    <h2 class="text-3xl text-blue-600 font-bold mb-3">Mi Perfil</h2>
    <UpdateProfile v-if="user" :user="user" />
    <CreateEditBusiness v-if="user" :user="user" />
    <ChangePassword />
  </div>
</template>
<script>
import ChangePassword from "../components/UpdatePassword";
import UpdateProfile from "../components/UpdateProfile";
import CreateEditBusiness from "../components/CreateEditBusiness";

export default {
  name: "profile",
  components: {
    ChangePassword,
    UpdateProfile,
    CreateEditBusiness,
  },
  mounted() {
    axios
      .get("/api/profile")
      .then((res) => {
        this.user = res.data;
      })
      .catch((err) => {
        this.showSwalToast("Ha ocurrido al intentar cargar tus datos", "error", 3000)
      });
  },
  data() {
    return {
      savingPassword: false,
      user: null
    };
  },
};
</script>
