@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Facturas</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Ver</th>
                            <th scope="col">Descargar</th>
                            <th scope="col">Aciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <th scope="row">#</th>
                                    <td>{{ $invoice->name }}</td>
                                    <td>{{ $invoice->description }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td><a href="{{ route('admin.invoices.show', [$user, $invoice->id]) }}"><button type="button" class="btn btn-primary float-left">Ver</button></a></td>
                                    <td><a href=""><button type="button" class="btn btn-primary float-left">Descargar</button></a></td>
                                    <td>
                                        
                                        <a href="{{ route('admin.invoices.edit', [$user, $invoice->id]) }}"><button type="button" class="btn btn-primary float-left">Editar</button></a>
                                        
                                        <form action="{{ route('admin.invoices.destroy', [$user, $invoice->id]) }}" method="POST" class="float-left">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                    {{-- <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td><a href="{{ route('admin.invoices.index', $user) }}"><button type="button" class="btn btn-primary float-left">Ver</button></a></td>
                                    <td>                                           
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Editar</button></a>
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
                    <a href="{{ route('admin.invoices.create', $user) }}"><button type="submit" class="btn btn-primary">Crear</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
