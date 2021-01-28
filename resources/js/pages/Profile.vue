<template>
  <div
    class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm border border-blue-600 rounded-md"
  >
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Mi Perfil</h2>

    <UpdateProfile />
    <ChangePassword />
  </div>
</template>
<script>
import ChangePassword from "../components/UpdatePassword";
import UpdateProfile from "../components/UpdateProfile";
export default {
  name: "profile",
  components: {
    ChangePassword,
    UpdateProfile,
  },
  data() {
    return {
      savingPassword: false,
    };
  },
};
</script>
