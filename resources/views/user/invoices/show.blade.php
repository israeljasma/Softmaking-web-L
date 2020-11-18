@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Factura</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">Nombre:</label>
    
                        <div class="col-md-6">
                            <label id="name" class="col-form-label text-md-right">{{ $invoiceUser->name }}</label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label text-md-right">Descripción:</label>

                        <div class="col-md-6">
                            <label id="description" class="col-form-label text-md-right">{{ $invoiceUser->description }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="date" class="col-md-2 col-form-label text-md-right">Fecha:</label>

                        <div class="col-md-6">
                            <label id="date" class="col-form-label text-md-right">{{ $invoiceUser->date }}</label>
                        </div>
                    </div>
                    <iframe src="{{asset('storage/'.$invoiceUser->file)}}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection