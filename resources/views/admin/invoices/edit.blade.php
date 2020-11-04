@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Factura</div>

                <div class="card-body">
                    <form action="{{ route('admin.invoices.update', [$user, $invoiceUser->id]) }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $invoiceUser->name }}" required autofocus>

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
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $invoiceUser->description }}" required autofocus>

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
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $invoiceUser->date }}" required autofocus>

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
                                <input id="file" type="file" class="form-control-file @error('file') is-invalid @enderror" name="file" value="{{asset('storage/'.$invoiceUser->file)}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <iframe src="{{asset('storage/'.$invoiceUser->file)}}" frameborder="0"></iframe>
                        </div>

                        
                        @csrf
                        {{ method_field('PUT') }}
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                    {{-- <iframe src="{{asset('storage/'.$invoiceUser->file)}}" frameborder="0"></iframe> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
