<template>
  <div>
    <div class="relative h-full bg-white overflow-hidden">
      <div class="max-w-screen-xl mx-auto">
        <div
          class="relative h-screen z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"
        >
          <svg
            class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
            fill="currentColor"
            viewBox="0 0 100 100"
            preserveAspectRatio="none"
          >
            <polygon points="50,0 100,0 50,100 0,100" />
          </svg>

          <div class="w-full h-screen absolute -z-10">
            <img
              class="object-cover w-full h-full lg:hidden"
              src="imgs/home-bg.jpg"
              alt="Imagen de fondo del Hero Section"
              style="filter: brightness(0.3)"
            />
          </div>

          <main class="pt-64 mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8">
            <div class="sm:text-center lg:text-left">
              <h2
                class="text-4xl tracking-tight leading-10 font-bold text-gray-200 lg:text-gray-900 sm:text-3xl md:text-5xl sm:leading-none lg:text-6xl"
              >
                Creando ideas
                <br class="xl:hidden" />
                <span
                  class="font-bold text-center mb-6 bg-clip-text text-transparent bg-gradient-to-b from-blue-500 to-blue-700"
                  >entregando soluciones</span
                >
              </h2>
              <p
                class="mt-3 text-base text-gray-300 lg:text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0"
              >
                Somos una empresa emprendedora en el área de la informática
                conformada por profesionales titulados de la PUCV
              </p>
              <div
                class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"
              >
                <div class="rounded-md shadow">
                  <a
                    href="#clients"
                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10"
                  >
                    Saber más
                  </a>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
      <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img
          class="h-56 w-full object-cover hidden lg:block sm:h-72 md:h-96 lg:w-full lg:h-full transition animate-zoominout"
          src="imgs/login-bg.jpg"
          alt="Imagen de fondo del Hero Section"
          style="filter: brightness(0.5)"
        />
      </div>
    </div>

    <section id="clients" class="container mx-auto my-8 pt-8 pb-8 md:pb-24">
      <h1
        class="text-4xl font-bold text-center mb-6 bg-clip-text text-transparent bg-gradient-to-b from-blue-500 to-blue-700"
      >
        Algunos de nuestros clientes
      </h1>
      <div
        class="grid md:grid-flow-col gap-2 w-full justify-center items-center px-16 md:px-4"
      >
        <a
          href="https://nuevacapmar.cl"
          target="_blank"
          rel="noreferrer"
          class="mx-auto"
          ><img
            class="w-auto h-auto inline-block"
            src="imgs/clients/capmar-logo.png"
            alt="logo de Capmar"
        /></a>
        <a
          href="https://rk3.cl/"
          target="_blank"
          rel="noreferrer"
          class="mx-auto"
          ><img
            class="w-auto h-auto inline-block"
            src="imgs/clients/rk3-logo.png"
            alt="logo de RK3"
        /></a>
        <a
          href="https://vyvingenieria.cl/"
          target="_blank"
          rel="noreferrer"
          class="mx-auto"
          ><img
            class="w-auto h-auto inline-block"
            src="imgs/clients/v&v-logo.png"
            alt="logo de v&v"
            style="filter: contrast(0.9)"
        /></a>
        <a
          href="https://condimentosjeit.cl/"
          target="_blank"
          rel="noreferrer"
          class="mx-auto"
          ><img
            class="w-auto h-auto inline-block md:w-11/12"
            src="imgs/clients/jeit-logo.png"
            alt="logo de JEIT"
        /></a>
        <a
          href="https://www.redcruzdelmar.cl"
          target="_blank"
          rel="noreferrer"
          class="mx-auto"
          ><img
            class="w-auto h-auto inline-block"
            src="imgs/clients/ambcruzmar-logo.png"
            alt="logo de ambulancias Cruz del Mar"
        /></a>
      </div>
    </section>

    <section
      id="about"
      class="mx-auto mb-12 md:mb-48 py-48 px-12 rounded-lg relative"
    >
      <div
        class="absolute w-full h-full transform skew-y-3 bg-gray-100 shadow-sm top-0 right-0 -z-10"
      ></div>
      <div class="relative">
        <h1
          class="text-3xl md:text-5xl font-bold text-center mb-6 bg-clip-text text-transparent bg-gradient-to-b from-blue-500 to-blue-700 z-10"
        >
          ¡Tenemos lo que necesitas!
        </h1>
        <h1
          class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-gray-100 absolute -z-10"
        >
          ¡Tenemos lo que necesitas!
        </h1>
      </div>
      <p class="text-xl text-center mx-4 md:mx-56">
        En Softmaking buscamos soluciones eficientes y durables para que las
        necesidades de hoy sean las oportunidades del mañana. Nuestra sociedad
        actualmente demanda respuestas rápidas para sus problemas y nosotros
        estamos preparados para entregarlas.
      </p>
    </section>

    <section id="services" class="container mx-auto my-12 md:my-48">
      <div class="relative">
        <h1
          class="text-3xl md:text-5xl font-bold text-center mb-6 bg-clip-text text-transparent bg-gradient-to-b from-blue-500 to-blue-700"
        >
          Actividades de la empresa
        </h1>
        <h1
          class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-indigo-100 absolute -z-10"
        >
          Actividades de la empresa
        </h1>
      </div>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="p-2 sm:p-10 text-center cursor-pointer mx-auto">
          <div
            class="py-16 max-w-sm rounded overflow-hidden shadow-lg transition duration-500 ease-in-out bg-gradient-to-b from-gray-700 to-gray-800 hover:bg-gradient-to-t hover:from-gray-800 hover:bg-gray-700 transform hover:scale-105"
          >
            <div class="space-y-10">
              <div
                class="bg-white rounded-full w-16 h-16 mx-auto flex shadow-lg"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="text-gray-800 w-8 mx-auto"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  />
                </svg>
              </div>

              <div class="px-6 py-4 h-48">
                <div class="space-y-5 text-gray-100">
                  <div class="font-bold text-xl mb-2">Desarrollos</div>
                  <p class="text-base">
                    Proyectos innovadores, escalables y de alto impacto ·
                    Aplicaciones web · Aplicaciones móviles · Consultoria ·
                    Integración de sistemas · Administración y mantenimiento de
                    sistemas.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="p-2 sm:p-10 text-center cursor-pointer mx-auto">
          <div
            class="py-16 max-w-sm rounded overflow-hidden shadow-lg transition duration-500 ease-in-out bg-gradient-to-b from-blue-600 to-blue-700 hover:bg-gradient-to-t hover:from-blue-700 hover:bg-blue-600 transform hover:scale-105"
          >
            <div class="space-y-10">
              <div
                class="bg-white rounded-full w-16 h-16 mx-auto flex shadow-lg"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="text-blue-700 w-8 mx-auto"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"
                  />
                </svg>
              </div>
              <div class="px-6 py-4 h-48">
                <div class="space-y-5 text-white">
                  <div class="font-bold text-xl mb-2">Soporte Técnico</div>
                  <p class="text-base">
                    Brindamos <b>Soporte Técnico</b> ya sea a productos
                    desarrollados por nosotros como a equipos de empresa y
                    pymes.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section
      id="contact"
      class="mx-auto px-4 md:px-12 py-12 md:py-48 bg-gradient-to-l from-gray-700 to-gray-800"
    >
      <div class="relative">
        <h1
          class="text-3xl md:text-5xl font-bold text-center mb-6 bg-clip-text text-transparent bg-gradient-to-b from-blue-500 to-blue-700"
        >
          Mantengámonos en contacto
        </h1>
        <h1
          class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-gray-100 absolute -z-10"
        >
          Mantengámonos en contacto
        </h1>
      </div>
      <div class="grid md:grid-cols-2 gap-2">
        <p class="text-xl text-gray-100 text-justify px-8 pt-6 mb-4">
          ¿Listo para comenzar tu próximo proyecto con nosotros? ¡Eso es genial!
          ¡Llámenos o envíenos un correo electrónico y nos pondremos en contacto
          con usted lo antes posible!
        </p>
        <FormContact />
      </div>
    </section>

    <!-- <section class="mx-auto px-4 md:px-12 py-12 md:py-48 bg-gray-300">
      <div class="relative">
        <h1
          class="text-3xl md:text-5xl font-bold text-center text-blue-700 mb-6"
        >
          Equipo de trabajo
        </h1>
        <h1
          class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-gray-100 absolute -z-10"
        >
          Equipo de trabajo
        </h1>
        <div
          class="grid grid-flow-col gap-2 w-full justify-center items-center px-16 md:px-4"
        >
          <div>Integrante 1</div>
          <div>Integrante 2</div>
          <div>Integrante 3</div>
        </div>
      </div>
    </section> -->

    <section class="mx-auto px-4 md:px-12 py-12 md:py-48 bg-gray-100">
      <div class="relative">
        <h1
          class="text-3xl md:text-5xl font-bold text-center mb-6 bg-clip-text text-transparent bg-gradient-to-b from-blue-500 to-blue-700"
        >
          Puedes seguirnos en nuestras redes sociales
        </h1>
        <h1
          class="w-full hidden md:block inset-x-0 -top-24 text-6xl font-medium leading-none text-center text-gray-100 absolute -z-10"
        >
          Nuestras redes sociales
        </h1>
        <div
          class="grid grid-flow-col gap-5 w-full justify-center items-center px-16 md:px-4"
        >
          <a
            href="https://www.facebook.com/SoftMaking-229644924623946/"
            target="_blank"
            rel="noreferrer"
            class="border transform hover:scale-105 border-blue-800 text-blue-800 hover:text-blue-600 hover:border-blue-600 rounded-full w-12 h-12 flex justify-center items-center shadow-md"
            ><svg
              aria-hidden="true"
              focusable="false"
              data-prefix="fab"
              data-icon="facebook-f"
              class="svg-inline--fa fa-facebook-f fa-w-10 w-6 h-6"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 320 512"
            >
              <path
                fill="currentColor"
                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
              ></path></svg
          ></a>
          <a
            href="https://twitter.com/SoftMakingSpA"
            target="_blank"
            rel="noreferrer"
            class="border transform hover:scale-105 border-blue-400 text-blue-400 hover:text-blue-500 hover:border-blue-500 rounded-full w-12 h-12 flex justify-center items-center shadow-md"
            ><svg
              aria-hidden="true"
              focusable="false"
              data-prefix="fab"
              data-icon="twitter"
              class="svg-inline--fa fa-twitter fa-w-16 w-6 h-6"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <path
                fill="currentColor"
                d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
              ></path></svg
          ></a>
          <a
            href="https://www.linkedin.com/company/softmaking"
            target="_blank"
            rel="noreferrer"
            class="border transform hover:scale-105 border-blue-500 text-blue-500 hover:text-blue-600 hover:border-blue-600 rounded-full w-12 h-12 flex justify-center items-center shadow-md"
            ><svg
              aria-hidden="true"
              focusable="false"
              data-prefix="fab"
              data-icon="linkedin-in"
              class="svg-inline--fa fa-linkedin-in fa-w-14 w-6 h-6"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 448 512"
            >
              <path
                fill="currentColor"
                d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"
              ></path></svg
          ></a>
        </div>
      </div>
    </section>

    <footer class="bg-gray-800 text-white">
      <div class="container mx-auto py-4">
        <div class="flex flex-col sm:flex-row mx-4">
          <div class="flex-1 my-2">
            <h1 class="font-bold uppercase text-xl mb-2">Servicios</h1>
            <ol class="ml-1">
              <li>Desarrollo Web</li>
              <li>Desarrollo de software</li>
              <li>Aplicaciones móviles</li>
              <li>Soporte técnico</li>
            </ol>
          </div>
          <div class="flex-1 my-2">
            <h1 class="font-bold uppercase text-xl mb-2">Softmaking</h1>
            <p class="ml-1">
              Softmaking es una empresa que facilita, mejora y optimiza la
              gestión y los procesos de negocio de las pequeñas y medianas
              empresas además de las grandes empresas con soluciones y servicios
              informáticos de calidad. Aportamos identidad, calidad y beneficio
              a nuestros clientes, generando a su vez valor para los empleados y
              para el conjunto de la sociedad.
            </p>
          </div>
        </div>
        <hr class="border-gray-50 border-opacity-50 my-3" />
        <p class="text-center pt-4">
          Desarrollado por
          <a href="#" class="font-bold uppercase">Softmaking</a>© 2020
        </p>
      </div>
    </footer>
  </div>
</template>
<script>
import FormContact from "../components/FormContact";
export default {
  name: "Home",
  components: {
    FormContact,
  },
  data() {
    return {};
  },
  mounted() {},
};
</script>
<style>
</style>
