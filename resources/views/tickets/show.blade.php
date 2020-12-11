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

                        <div class="form-group row">
                            <label for="comment" class="col-md-2 col-form-label text-md-right">Comentarios:</label>

                            @foreach ($comments as $comment)
                                <div class="panel panel-@if($ticket->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
                                    <div class="panel panel-heading">
                                        {{ $comment->user->name }}
                                        <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                                    </div>
                        
                                    <div class="panel panel-body">
                                        {{ $comment->comment }}        
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="comment-form">
                            <form action="{{ route('comment.store') }}" method="POST">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                <div class="form-group row">
                                    <label for="comment" class="col-md-2 col-form-label text-md-right">Nuevo comentario</label>
        
                                    <div class="col-md-6">
                                        <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="" required autofocus></textarea>
        
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $comment }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @csrf
                                {{ method_field('POST') }}
                                <button type="submit" class="btn btn-primary">Agregar comentario</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection