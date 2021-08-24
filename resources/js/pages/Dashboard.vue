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
                class="grid md:grid-flow-col mx-auto border border-blue-600 rounded-md divide-y md:divide-y-0 divide-blue-500 md:divide-x md:divide-blue-500"
                v-if="counts"
            >
                <div
                    class="flex flex-1 flex-col justify-center items-center h-36 mx-4 md:mx-0 md:my-4"
                    v-for="[key, value] in Object.entries(counts)"
                    :key="'count-' + key"
                >
                    <h1
                        class="text-2xl text-blue-500 font-bold mb-3 capitalize"
                    >
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
                this.counts = res.data.counts[0];
            });
        }
    }
};
</script>
<style></style>
