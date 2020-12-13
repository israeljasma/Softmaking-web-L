@extends('layouts.app')

@section('content')
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Crear factura</h2>
    {{ Breadcrumbs::render('user', $user) }}
    <div class="container mx-auto bg-white px-4 py-5 sm:p-6">
        @if (session('status'))
            <div class="bg-red-100 border-t border-b border-green-500 text-dark-700 px-4 py-3" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('admin.invoices.store', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('POST') }}
            <div class="flex flex-col gap-4">
                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" required autofocus
                        class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('name') is-invalid @enderror">
                </div>
                <div class="">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <input type="text" name="description" id="description" required autofocus
                        class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('description') is-invalid @enderror">
                </div>
                <div class="">
                    <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="date" id="date" required autofocus
                        class="mt-1 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md @error('date') is-invalid @enderror">
                </div>
                <div class="">
                    <label for="file" class="block text-sm font-medium text-gray-700">Archivo</label>
                    <label
                        class="w-full flex flex-col items-center p-4 bg-white text-gray-400 rounded-lg shadow-sm tracking-wide uppercase border border-gray-400 cursor-pointer hover:bg-gray-600 hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <input type="file" name="file" required autofocus />
                    </label>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="bg-red-100 border-t border-b border-red-500 text-dark-700 px-4 py-3" role="alert">
                            <p class="text-sm">{{ $error }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="pt-3 bg-gray-50 text-right">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Crear factura
                </button>
            </div>
        </form>

       {{--  <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('admin.invoices.store', $user) }}" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="" required autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                            name="description" value="" required autofocus>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-md-2 col-form-label text-md-right">Fecha</label>

                    <div class="col-md-6">
                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                            value="" required autofocus>

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                @csrf
                {{ method_field('POST') }}
                <div class="form-group row">
                    <label for="file" class="col-md-2 col-form-label text-md-right">Archivo</label>
                    <div class="col-md-6">
                        <input id="file" type="file" class="form-control-file @error('file') is-invalid @enderror"
                            name="file" value="" required autofocus>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div> --}}

    </div>
@endsection
