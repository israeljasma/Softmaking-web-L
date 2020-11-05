@extends('layouts.app')

@section('content')

    <h2 class="text-3xl text-blue-700 font-bold mb-3">Facturas</h2>

    <nav class="text-black font-bold mb-8" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ url('/home') }}">Home</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('admin.users.index') }}">Users</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li>
                <a href="#" class="text-gray-500" aria-current="page">Invoices</a>
            </li>
        </ol>
    </nav>

    <a href="{{ route('admin.invoices.create', $user) }}"><button type="submit"
            class="px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg md:px-10">Crear</button></a>

    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-sm my-5">
        <thead class="text-white">
            @foreach ($invoices as $invoice)
                <tr class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left h-12" scope="col">#</th>
                    <th class="p-3 text-left h-12" scope="col">Nombre</th>
                    <th class="p-3 text-left h-12" scope="col">Descripción</th>
                    <th class="p-3 text-left h-12" scope="col">Fecha</th>
                    <th class="p-3 text-left h-12" scope="col">Ver</th>
                    <th class="p-3 text-left h-12" scope="col">Descargar</th>
                    <th class="p-3 text-left h-12" scope="col">Acciones</th>
                </tr>
            @endforeach
        </thead>
        <tbody class="flex-1 sm:flex-none">
            @foreach ($invoices as $invoice)
                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12" scope="row">{{ $invoice->id }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">{{ $invoice->name }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">{{ $invoice->description }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">{{ $invoice->date }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12"><a class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
                            href="{{ route('admin.invoices.show', [$user, $invoice->id]) }}">Ver</a></td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12 text-left md:text-center"><a href="#" class="px-3 py-1 border border-transparent text-base rounded text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg">Descargar</a></td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">
                        <div class="flex justify-start md:justify-center">
                            <a class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
                                href="{{ route('admin.invoices.edit', [$user, $invoice->id]) }}">Editar</a>
                            <form action="{{ route('admin.invoices.destroy', [$user, $invoice->id]) }}" method="POST"
                                class="float-left">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit"
                                    class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg">Eliminar</button>
                            </form>
                        </div>

                    </td>
                    {{-- <td>{{ implode(
                            ',',
                            $user->roles()->get()->pluck('name')->toArray(),
                        ) }}</td>
                    <td><a href="{{ route('admin.invoices.index', $user) }}"><button type="button"
                                class="btn btn-primary float-left">Ver</button></a></td>
                    <td>
                        @can('edit-users')
                        <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button"
                                class="btn btn-primary float-left">Editar</button></a>
                        @endcan

                        @can('delete-users')
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        @endcan
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
