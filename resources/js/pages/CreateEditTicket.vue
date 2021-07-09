<template>
    <!-- TODO: En la API/Backend no hay funcion asignada para editar/eliminar ticket -->
    <div
        v-if="!msg"
        class="container mx-auto bg-white px-6 p-4 my-24 shadow-sm md:border md:border-blue-600 rounded-md"
    >
        <h1 v-if="!editMode" class="text-3xl text-blue-700 font-bold mb-3">
            Agregar nuevo ticket
        </h1>
        <h1 v-else class="text-3xl text-blue-700 font-bold mb-3">
            Editar ticket
        </h1>

        <form
            @submit.prevent="saveTicket"
            enctype="multipart/form-data"
            class="flex flex-col"
        >
            <div class="flex flex-col gap-4">
                <div class="mb-2">
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Titulo</label
                    >
                    <input
                        v-model="ticket.title"
                        type="text"
                        name="title"
                        id="title"
                        required
                        autofocus
                        class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
                    />
                </div>

                <div class="mb-2" v-if="categories">
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                        >Categoría</label
                    >
                    <select
                        class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border border-gray-300 rounded-md"
                        :required="true"
                        v-model="ticket.category"
                    >
                        <option disabled value="">Escoger categoría</option>
                        <option
                            v-for="c in categories"
                            :key="c.id"
                            :value="c.id"
                            >{{ c.name }}</option
                        >
                    </select>
                </div>

                <div class="mb-2">
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Prioridad</label
                    >
                    <input
                        v-model="ticket.priority"
                        type="text"
                        name="priority"
                        id="priority"
                        required
                        autofocus
                        class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
                    />
                </div>

                <div class="mb-2">
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                        >Mensaje</label
                    >
                    <textarea
                        v-model="ticket.message"
                        type="text"
                        name="message"
                        id="message"
                        required
                        autofocus
                        rows="4"
                        class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
                    />
                </div>

                <button
                    class="inline-flex justify-center py-2 px-4 mt-2 border border-transparent shadow-sm text-md font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    type="submit"
                >
                    <span v-if="editMode" class="flex">
                        <svg
                            v-if="saving"
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path></svg
                        >Guardar cambios</span
                    >
                    <span v-else class="flex"
                        ><svg
                            v-if="saving"
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path></svg
                        >Agregar ticket</span
                    >
                </button>
            </div>
        </form>
    </div>
    <div
        v-else
        class="container mx-auto px-6 md:p-12 my-24 text-center bg-white md:border md:border-blue-600 shadow-sm rounded-md"
    >
        <p class="text-xl">
            {{ msg }}
        </p>
    </div>
</template>
<script>
export default {
    name: "CreateEditTicket",
    props: ["ticketId", "ticketElem"],
    data() {
        return {
            editMode: false,
            categories: [],
            ticket: {
                title: null,
                category: null,
                priority: null,
                message: null
            },
            img: null,
            msg: null,
            saving: false
        };
    },
    mounted() {
        this.getCategories();
        if (this.ticketElem) {
            const { title, category, priority, message } = this.ticketElem;
            this.ticket = { title, category, priority, message };
            this.ticket.category = category.id;
            this.editMode = true;
        } else {
            if (this.ticketId) {
                this.getTicket();
            }
        }
    },
    methods: {
        getCategories: function() {
            axios
                .get(`/api/categories`)
                .then(res => {
                    this.categories = res.data;
                })
                .catch(err => {
                    this.$toasted.error(
                        "Hubo un error al cargar las categorías"
                    );
                });
        },
        getTicket: function() {
            axios
                .get(`/api/tickets/${this.ticketId}`)
                .then(res => {
                    this.ticket = res.data;
                    this.editMode = true;
                })
                .catch(err => {
                    this.msg = "No se ha encontrado el ticket";
                    this.$toasted.error(
                        "No se ha encontrado el ticket que estabas buscando"
                    );
                });
        },
        saveTicket: function() {
            if (this.ticketId && this.editMode) {
                let editedTicket = new FormData();
                editedTicket.append("title", this.ticket.title);
                editedTicket.append("category", this.ticket.category);
                editedTicket.append("priority", this.ticket.priority);
                editedTicket.append("message", this.ticket.message);
                editedTicket.append("_method", "PATCH");

                this.saving = true;

                axios
                    .post(`/api/tickets/${this.ticketId}`, editedTicket)
                    .then(res => {
                        this.$toasted.success(
                            "Se ha actualizado correctamente los datos del ticket"
                        );
                    })
                    .catch(err => {
                        this.$toasted.error(
                            "Ha ocurrido un error al actualizar los datos del ticket"
                        );
                    })
                    .finally(() => {
                        this.saving = false;
                        this.$router.push({ name: "tickets" });
                    });
            } else {
                let newTicket = new FormData();
                newTicket.append("title", this.ticket.title);
                newTicket.append("category", this.ticket.category);
                newTicket.append("priority", this.ticket.priority);
                newTicket.append("message", this.ticket.message);

                this.saving = true;
                axios
                    .post(`/api/tickets`, newTicket)
                    .then(res => {
                        this.$toasted.success(
                            "Se ha guardado correctamente el ticket"
                        );
                    })
                    .catch(err => {
                        this.$toasted.error(
                            "Ha ocurrido un error al guardar el ticket"
                        );
                    })
                    .finally(() => {
                        this.saving = false;
                        this.$router.push({ name: "tickets" });
                    });
            }
        }
    }
};
</script>
