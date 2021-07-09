<template>
    <div
        class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm border border-blue-600 rounded-md"
    >
        <h2 class="text-3xl text-blue-700 font-bold mb-3">Dashboard</h2>
        <!-- TODO: Hacer algo a lo mejor de analitica para rellenar la seccion DASHBOARD -->

        <div v-if="userRole === roles.superadmin || userRole === roles.admin">
            <h2 class="text-2xl text-blue-700 font-bold mb-1">Resumen</h2>
            <p class="mb-3">
                Esto es un resumen de la cantidad de elementos existentes en las
                principales tablas de la Base de Datos.
            </p>

            <div
                class="w-full flex gap-1 justify-between mx-auto"
                v-if="counts"
            >
                <div
                    class="bg-blue-600 flex flex-col justify-center items-center border-2 border-blue-600 rounded-md w-40 h-40"
                    v-for="[key, value] in Object.entries(counts)"
                    :key="'count-' + key"
                >
                    <h1 class="text-2xl text-white font-bold mb-3 capitalize">
                        {{ key }}
                    </h1>
                    <p class="text-3xl text-center font-extrabold">
                        {{ value }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { roles } from "../roles";

export default {
    name: "dashboard",
    data() {
        return {
            counts: [],
            roles
        };
    },
    computed: {
        isLoggedIn: function() {
            return this.$store.getters.isLoggedIn;
        },
        userRole: function() {
            return this.$store.getters.userRole;
        }
    },
    mounted() {
        if (
            this.userRole === roles.superadmin ||
            this.userRole === roles.admin
        ) {
            axios.get("api/report").then(res => {
                console.log(res.data.counts);
                this.counts = res.data.counts[0];
            });
        }
    }
};
</script>
<style></style>
