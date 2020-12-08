@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo Ticket</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">Titulo</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-2 col-form-label text-md-right">Categoria</label>

                            <div class="col-md-6">
                                <select id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="" required autofocus>
                                    <option selected disabled>Seleccione categoria</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="priority" class="col-md-2 col-form-label text-md-right">Prioridad</label>

                            <div class="col-md-6">
                                <select id="priority" type="priority" class="form-control @error('priority') is-invalid @enderror" name="priority" value="" required autofocus>>
                                    <option selected disabled>Seleccione prioridad</option>
                                    <option value="low">Bajo</option>
                                    <option value="medium">Medio</option>
                                    <option value="high">Alto</option>
                                </select>

                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-2 col-form-label text-md-right">Mensaje</label>

                            <div class="col-md-6">
                                <textarea id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="" required autofocus></textarea>

                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @csrf
                        {{ method_field('POST') }}
                        {{-- Archivos, falta configurar --}}
                        {{-- <div class="form-group row">
                            <label for="file" class="col-md-2 col-form-label text-md-right">Archivo</label>
                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control-file @error('file') is-invalid @enderror" name="file" value="" required autofocus>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection