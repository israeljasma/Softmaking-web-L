<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('imgs/logo-sm.png') }}">

    <title>SOFTMAKING</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body>
    <div id="app">
        <!--
      Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
      Read the documentation to get started: https://tailwindui.com/documentation
    -->
        <div class="relative h-full bg-white overflow-hidden">
            <div class="max-w-screen-xl mx-auto">
                <div
                    class="relative h-screen z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                        fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <polygon points="50,0 100,0 50,100 0,100" />
                    </svg>

                    <div class="relative py-5 pl-4">
                        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
                            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                                <div class="flex items-center justify-between w-full md:w-auto">
                                    <a href="{{ url('/') }}" aria-label="Home">
                                        <img class="block h-8 w-auto" src="{{ asset('imgs/logo-sm.png') }}"
                                            alt="logo SoftMaking">
                                    </a>
                                    <div class="-mr-2 flex items-center md:hidden">
                                        <button type="button" onclick="toggleMenu()"
                                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                            id="main-menu" aria-label="Main menu" aria-haspopup="true">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6h16M4 12h16M4 18h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:block md:ml-4 md:pr-2">
                                <a href="#"
                                    class="font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">Clientes</a>
                                <a href="#"
                                    class="ml-6 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">Acerca
                                    de</a>
                                <a href="#"
                                    class="ml-6 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">Servicios</a>
                                <a href="#"
                                    class="ml-6 font-bold text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">Contacto</a>
                                <a href="{{ route('login') }}"
                                    class="ml-6 font-bold text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">{{ __('Login') }}</a>
                                <a href="{{ route('register') }}"
                                    class="ml-6 font-bold text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">{{ __('Register') }}</a>
                            </div>
                        </nav>
                    </div>

                    <!--
            Mobile menu, toggle classes based on menu state.   
            Menu open: "block", Menu closed: "hidden"
        -->
                    <div id="nav-content" class="hidden sm:hidden">
                        <div class="px-2 pt-2 pb-3 bg-blue-700">
                            @guest
                                <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                    href="#clientes">Clientes</a>
                                <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                    href="#about">Acerca de</a>
                                <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                    href="#services">Servicios</a>
                                <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                    href="#contact">Contacto</a>
                                <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white border border-gray-400 hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white border border-gray-400 hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                @can('manage-users')
                                    <a href="{{ route('admin.users.index') }}"
                                        class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                        role="menuitem">(Gestión de usuarios) User Management</a>
                                @endcan
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                                            document.getElementById('logout-form').submit();"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-100 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                    role="menuitem">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    </div>

                    <main class="mt-48 mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8">
                        <div class="sm:text-center lg:text-left">
                            <h2
                                class="text-4xl tracking-tight leading-10 font-bold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
                                Creando ideas
                                <br class="xl:hidden">
                                <span class="text-blue-700">entregando soluciones</span>
                            </h2>
                            <p
                                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Somos una empresa emprendedora en el área de la informática conformada por profesionales
                                titulados de la PUCV
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="#"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                                        Saber más
                                    </a>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                    src="https://images.unsplash.com/photo-1590314524895-c5983ed24e75?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
                    alt="">
            </div>
        </div>

        <section class="container mx-auto my-8 py-8">
            <h1 class="text-4xl font-bold text-center text-blue-700 mb-6">Algunos de nuestros clientes</h1>
            <div class="flex flex-col md:flex-row w-full justify-center items-center px-16 md:px-4">
                <img class="w-auto h-auto md:w-1/4 inline-block"
                    src="https://softmaking.cl/assets/img/clients/logo_capmar.png" alt="logo de capmar">
                <img class="w-auto h-auto md:w-1/4 inline-block"
                    src="https://softmaking.cl/assets/img/clients/rk3-logo.png" alt="logo de rk3">
                <img class="w-auto h-auto md:w-1/4 inline-block"
                    src="https://softmaking.cl/assets/img/clients/v&v-logo.png" alt="logo de v&v">
                <img class="w-auto h-auto md:w-1/6 inline-block"
                    src="https://softmaking.cl/assets/img/clients/jeit-logo.png" alt="logo de jeit">
            </div>
        </section>

        <section class="container mx-auto mb-12 md:mb-48">
            <div class="relative">
                <h1 class="text-5xl font-bold text-center text-blue-700 mb-6 z-10">¡Tenemos lo que necesitas!</h1>
                <h1
                    class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-gray-100 absolute -z-10">
                    ¡Tenemos lo que necesitas!</h1>
            </div>
            <p class="text-xl text-justify mx-4">En SoftMaking buscamos soluciones eficientes y durables para que las
                necesidades de hoy sean las oportunidades del mañana. Nuestra sociedad actualmente demanda respuestas
                rápidas para sus problemas y nosotros estamos preparados para entregarlas.</p>
        </section>

        <section class="container mx-auto my-12 md:my-48">
            <div class="relative">
                <h1 class="text-5xl font-bold text-center text-blue-700 mb-6">Actividades de la empresa</h1>
                <h1
                    class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-gray-100 absolute -z-10">
                    Actividades de la empresa</h1>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                <div class="p-2 sm:p-10 text-center cursor-pointer mx-auto">
                    <div
                        class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500  bg-white">
                        <div class="space-y-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-700 w-24 mx-auto" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>

                            <div class="px-6 py-4">
                                <div class="space-y-5">
                                    <div class="font-bold text-xl mb-2">Desarrollos</div>
                                    <p class="text-gray-700 text-base">
                                        Proyectos innovadores, escalables y de alto impacto · Aplicaciones web ·
                                        Aplicaciones móviles · Consultoria · Integración de sistemas · Administración y
                                        mantenimiento de sistemas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-2 sm:p-10 text-center cursor-pointer mx-auto">
                    <div
                        class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500  bg-white">
                        <div class="space-y-10">
                          <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-700 w-24 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                          </svg>

                            <div class="px-6 py-4">
                                <div class="space-y-5">
                                    <div class="font-bold text-xl mb-2">Soporte Técnico</div>
                                    <p class="text-gray-700 text-base">
                                        Brindamos Soporte técnico ya sea a productos desarrollados por nosotros como a
                                        equipos de empresa y pymes.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container mx-auto my-12 md:my-48">
            <div class="relative">
                <h1 class="text-5xl font-bold text-center text-blue-700 mb-6">Mantengámonos en contacto</h1>
                <h1
                    class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-gray-100 absolute -z-10">
                    Mantengámonos en contacto</h1>
            </div>
            <p class="text-xl text-justify mx-4">¿Listo para comenzar tu próximo proyecto con nosotros? ¡Eso es genial!
                ¡Llámenos o envíenos un correo electrónico y nos pondremos en contacto con usted lo antes posible!</p>
        </section>

    </div>
    <script>
        function toggleMenu() {
            console.log("clik")
            document.getElementById("nav-content").classList.toggle("hidden");
        }

    </script>
</body>
<script src="{{ mix('js/app.js') }}"></script>

</html>
