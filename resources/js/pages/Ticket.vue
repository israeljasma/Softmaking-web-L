<template>
    <!-- TODO: Falta ver como asignar tickets a clientes para poder agregar comentario o modificaciones de este -->
    <div
        v-if="ticket"
        class="container mx-auto bg-white px-6 p-4 my-24 shadow-md rounded-md md:border md:border-blue-600"
    >
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Ticket {{ ticket.ticket_id }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Detalles del ticket
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div
                    class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                    <dd
                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                    >
                        {{ ticket.title }}
                    </dd>
                </div>
                <div
                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Usuario</dt>
                    <dd
                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                    >
                        <router-link
                            class="text-blue-600 underline"
                            :to="{
                                name: 'user',
                                params: {
                                    userId: ticket.user.id,
                                    userElem: ticket.user
                                }
                            }"
                            >{{ ticket.user.name }}
                            {{ ticket.user.lastname }}</router-link
                        >
                        ({{ ticket.user.email }})
                    </dd>
                </div>
                <div
                    class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Estado</dt>
                    <dd
                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                    >
                        {{ ticket.status }}
                    </dd>
                </div>
                <div
                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Categoría</dt>
                    <dd
                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                    >
                        {{ ticket.category.name }}
                    </dd>
                </div>
                <div
                    class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Prioridad</dt>
                    <dd
                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                    >
                        {{ ticket.priority }}
                    </dd>
                </div>
                <div
                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Mensaje</dt>
                    <dd
                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                    >
                        {{ ticket.message }}
                    </dd>
                </div>
                <div
                    class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">Fecha</dt>
                    <dd
                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                    >
                        {{ ticket.created_at | formatDate }}
                    </dd>
                </div>
                <div
                    class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                >
                    <dt class="text-sm font-medium text-gray-500">
                        Comentarios
                    </dt>
                    <dd
                        v-if="ticket.comments.length > 0"
                        class="flex flex-col h-44 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 space-y-3 p-3 border border-gray-200 bg-white rounded overflow-y-auto"
                    >
                        <div class="flex sticky top-0 z-50">
                            <a
                                class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg ml-auto"
                                @click="addComment(ticket)"
                                >Agregar comentario</a
                            >
                        </div>
                        <div
                            v-for="comment in ticket.comments"
                            :key="comment.id"
                            class="p-3 border border-gray-200 bg-gray-50 rounded"
                        >
                            <span
                                class="text-gray-600 uppercase tracking-wider"
                                >{{ comment.user.name }}</span
                            >
                            <p class="mb-2">{{ comment.comment }}</p>
                            <span class="text-xs text-gray-400">{{
                                comment.created_at | formatDate
                            }}</span>
                        </div>
                    </dd>
                    <dd
                        v-else
                        class="flex flex-col mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 space-y-3 p-3 border border-gray-200 rounded"
                    >
                        <a
                            class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg mx-auto text-center"
                            @click="addComment(ticket)"
                            >Agregar comentario</a
                        >
                        <p class="text-center text-gray-300">
                            No hay comentarios en este ticket
                        </p>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    <div v-else class="container mx-auto px-6 p-4 my-24">
        <div
            class="p-4 md:p-12 text-center bg-white md:border md:border-blue-600 shadow-sm rounded-md"
        >
            <p class="text-xl">No existe este ticket</p>
        </div>
    </div>
</template>
<script>
export default {
    name: "ticket",
    props: ["ticketElem"],
    data() {
        return {
            ticket: this.ticketElem || null,
            ticketId: this.$route.params.ticketId || null
        };
    },
    methods: {
        addComment: function() {
            this.$swal({
                title: "Comentario",
                input: "text",
                inputPlaceholder: "Escribe tu comentario aquí",
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: "Confirmar",
                cancelButtonText: "Cancelar",
                preConfirm: value => {
                    if (!value) {
                        this.$swal.showValidationMessage(
                            "No puede enviar un comentario en blanco"
                        );
                    }
                }
            }).then(result => {
                if (result.isConfirmed) {
                    let comment = {
                        ticket_id: this.ticket.id,
                        comment: result.value
                    };
                    axios
                        .post(`/api/tickets/comment`, comment)
                        .then(result => {
                            this.$swal(
                                "Enviado",
                                "Se ha guardado el comentario con éxito",
                                "success"
                            );
                            this.ticket.comments.unshift(result.data.comment);
                        })
                        .catch(err => {
                            this.$swal(
                                "Cancelado",
                                "Ha ocurrido un error al intentar guardar el comentario",
                                "error"
                            );
                        });
                }
            });
        },
        getTicket: function() {
            if (this.ticketId) {
                axios
                    .get(`/api/tickets/${this.ticketId}`)
                    .then(response => {
                        this.ticket = response.data.ticket;
                    })
                    .catch(error => {
                        this.$toasted.error(
                            "Ha ocurrido un error al cargar el ticket"
                        );
                    });
            }
        }
    },
    computed: {},
    mounted() {
        this.getTicket();
    }
};
</script>
