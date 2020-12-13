<div class="container mx-auto mt-5">
    <!-- Success message -->
    @if (Session::has('success'))
        <div class="fixed z-10 inset-0 overflow-y-auto" id="modal-contact">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    ¡El mensaje se ha enviado con éxito!
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">
                                        {{ Session::get('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button type="button" onclick="toggleElement('modal-contact')"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cerrar
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form id="contact-form" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post"
        action="{{ action('ContactUsFormController@createForm') }}">

        @csrf
        <h4 class="text-2xl font-semibold">¿Tienes alguna duda?</h4>
        <p class="leading-relaxed mt-1 mb-4 text-gray-600">Completa el siguiente formulario y nos contactaremos contigo dentro de las 24 horas</p>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
            <input type="text"
                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('name') ? 'error' : '' }}"
                name="name" id="name" required>

            <!-- Error -->
            @if ($errors->has('name'))
                <div class="error">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Correo electrónico</label>
            <input type="email"
                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('email') ? 'error' : '' }}"
                name="email" id="email" required>

            @if ($errors->has('email'))
                <div class="error">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Teléfono</label>
            <input type="text"
                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('phone') ? 'error' : '' }}"
                name="phone" id="phone" required>

            @if ($errors->has('phone'))
                <div class="error">
                    {{ $errors->first('phone') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">Asunto</label>
            <input type="text"
                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('subject') ? 'error' : '' }}"
                name="subject" id="subject" required>

            @if ($errors->has('subject'))
                <div class="error">
                    {{ $errors->first('subject') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Mensaje</label>
            <textarea
                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('message') ? 'error' : '' }}"
                name="message" id="message" rows="4" required></textarea>

            @if ($errors->has('message'))
                <div class="error">
                    {{ $errors->first('message') }}
                </div>
            @endif
        </div>

        <input type="submit" name="send" value="Enviar"
            class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-full shadow-xl text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out">
    </form>
</div>
