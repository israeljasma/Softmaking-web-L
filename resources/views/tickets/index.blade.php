@extends('layouts.app')

@section('content')
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Tickets</h2>
    <a href="{{ route('ticket.create') }}"><button type="submit"
        class="px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg md:px-10">Crear</button></a>
    
    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-sm my-5">
        <thead class="text-white">
            {{-- @foreach ($tickets as $ticket) --}}
                <tr class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left h-12" scope="col">#</th>
                    <th class="p-3 text-left h-12" scope="col">Nombre</th>
                    <th class="p-3 text-left h-12" scope="col">Descripción</th>
                    <th class="p-3 text-left h-12" scope="col">Fecha</th>
                    <th class="p-3 text-left h-12" scope="col">Ver</th>
                    <th class="p-3 text-left h-12" scope="col">Descargar</th>
                    <th class="p-3 text-left h-12" scope="col">Acciones</th>
                </tr>
            {{-- @endforeach --}}
        </thead>
    </table>
    <tbody class="flex-1 sm:flex-none">
        @foreach ($tickets as $ticket)
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="border-grey-light border hover:bg-gray-100 p-3 h-12" scope="row">{{ $ticket->id }}</td>
            </tr>
        @endforeach
    </tbody>
@endsection