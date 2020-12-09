@extends('layouts.app')

@section('content')
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Ticket</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $ticket->title }}</div>
    
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="ticket_id" class="col-md-2 col-form-label text-md-right">Numero de ticket:</label>
        
                            <div class="col-md-6">
                                <label id="ticket_id" class="col-form-label text-md-right">{{ $ticket->ticket_id }}</label>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="priority" class="col-md-2 col-form-label text-md-right">Prioridad:</label>
    
                            <div class="col-md-6">
                                <label id="priority" class="col-form-label text-md-right">{{ $ticket->priority }}</label>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="status" class="col-md-2 col-form-label text-md-right">Estado:</label>
    
                            <div class="col-md-6">
                                <label id="status" class="col-form-label text-md-right">{{ $ticket->status }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="created_at" class="col-md-2 col-form-label text-md-right">Fecha de creación:</label>
    
                            <div class="col-md-6">
                                <label id="created_at" class="col-form-label text-md-right">{{ $ticket->created_at }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="updated_at" class="col-md-2 col-form-label text-md-right">Última actualización:</label>
    
                            <div class="col-md-6">
                                <label id="updated_at" class="col-form-label text-md-right">{{ $ticket->updated_at->diffForHumans() }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-2 col-form-label text-md-right">Mensaje:</label>
    
                            <div class="col-md-6">
                                <label id="message" class="col-form-label text-md-right">{{ $ticket->message }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection