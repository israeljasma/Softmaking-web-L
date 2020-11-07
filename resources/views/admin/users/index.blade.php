@extends('layouts.app')

@section('content')
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Usuarios</h2>

    {{ Breadcrumbs::render('users') }}

    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-sm my-5">
        <thead class="text-white">
            @foreach ($users as $user)
                <tr class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left h-12" scope="col">#</th>
                    <th class="p-3 text-left h-12" scope="col">Nombre</th>
                    <th class="p-3 text-left h-12" scope="col">Email</th>
                    <th class="p-3 text-left h-12" scope="col">Rol</th>
                    <th class="p-3 text-left h-12" scope="col">Facturas</th>
                    <th class="p-3 text-left h-12" scope="col">Acciones</th>
                </tr>
            @endforeach
        </thead>
        <tbody class="flex-1 sm:flex-none">
            @foreach ($users as $user)
                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12" scope="row">{{ $user->id }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">{{ $user->name }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">{{ $user->email }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">{{ implode(
                            ',',
                            $user->roles()->get()->pluck('name')->toArray(),
                        ) }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12 text-left md:text-center"><a
                            class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
                            href="{{ route('admin.invoices.index', $user) }}">Ver</a></td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 h-12">
                        <div class="flex justify-start md:justify-center">
                            @can('edit-users')
                                <a class="px-3 md:py-1 mr-2 border border-transparent text-base rounded text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg"
                                    href="{{ route('admin.users.edit', $user->id) }}">Editar</a>
                            @endcan

                            @can('delete-users')
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit"
                                        class="px-3 md:py-1 border border-transparent text-base rounded text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-500 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg">Eliminar</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
