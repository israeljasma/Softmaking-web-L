<template>
  <div class="relative">
    <div
      class="fixed z-10 inset-0 overflow bg-gray-800 bg-opacity-75"
      id="modal-contact"
      v-if="showModal"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div
                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10"
              >
                <svg
                  class="h-6 w-6 text-green-600"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                  ></path>
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3
                  class="text-lg leading-6 font-medium text-gray-900"
                  id="modal-headline"
                >
                  ¡El mensaje se ha enviado con éxito!
                </h3>
                <div class="mt-2">
                  <p class="text-sm leading-5 text-gray-500">
                    {{ msg }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
              <button
                type="button"
                @click="toggleModal('modal-contact')"
                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
              >
                Cerrar
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <form
      id="contact-form"
      class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
      method="post"
      @submit.prevent="submitForm"
    >
      <h4 class="text-2xl font-semibold">¿Tienes alguna duda?</h4>
      <p class="leading-relaxed mt-1 mb-4 text-gray-600">
        Completa el siguiente formulario y nos contactaremos contigo dentro de
        las 24 horas
      </p>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name"
          >* Nombre</label
        >
        <input
          type="text"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="contact.name"
          name="name"
          id="name"
          placeholder="Nombre del cliente"
          required
        />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email"
          >* Correo electrónico</label
        >
        <input
          type="email"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="contact.email"
          name="email"
          id="email"
          placeholder="example@domain.com"
          required
        />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone"
          >* Teléfono</label
        >
        <input
          type="text"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="contact.phone"
          name="phone"
          id="phone"
          placeholder="569987654321"
          required
        />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="subject"
          >* Asunto</label
        >
        <input
          type="text"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="contact.subject"
          name="subject"
          id="subject"
          placeholder="Título del mensaje"
          required
        />
      </div>

      <div class="mb-3">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="message"
          >* Mensaje</label
        >
        <textarea
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="contact.message"
          name="message"
          id="message"
          rows="4"
          placeholder="Contenido del mensaje"
          required
        ></textarea>
      </div>

      <div
        v-if="errorMsg"
        class="bg-red-100 border-t border-b border-red-500 text-dark-700 px-4 py-3 mb-5"
        role="alert"
      >
        <h1 class="text-md font-bold mb-2">Corrija los siguientes errores:</h1>
        <p
          v-for="(err, index) in errorMsg"
          :key="'err-' + index"
          class="text-sm ml-1"
        >
          - {{ err.join(", ") }}
        </p>
      </div>

      <button
        type="submit"
        name="send"
        class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-full shadow-xl text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out"
      >
        <svg
          v-if="sending"
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
          ></path>
        </svg>
        Enviar
      </button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "FormContact",
  data() {
    return {
      contact: {
        name: "test",
        email: "test@domain.com",
        phone: "56998765432",
        subject: "test",
        message: "test message",
      },
      errorMsg: "",
      msg: "",
      showModal: false,
      sending: false,
    };
  },
  methods: {
    resetData: function () {
      this.contact = {
        name: "",
        email: "",
        phone: "",
        subject: "",
        message: "",
      };
      this.showModal = false;
      this.msg = "";
    },
    toggleModal: function (element) {
      const modal = document.getElementById(`${element}`);
      modal && modal.classList.toggle("hidden");
      this.resetData();
    },
    submitForm: function () {
      this.sending = true;
      axios
        .post("api/contact", this.contact)
        .then((response) => {
          //   console.log(response);
          this.showModal = true;
          this.msg = response.data.message;
        })
        .catch((err) => {
          //   console.log(err.response.data);
          this.errorMsg = err.response.data || [];
        })
        .finally(() => {
          this.sending = false;
        });
    },
  },
};
</script>
