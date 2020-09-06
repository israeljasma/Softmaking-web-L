@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Editar Usuario {{ $user->name }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="roles" class="col-md-2 col-form-label text-md-right">Rol</label>
                            <div class="col-md-6">
                                <select id="roles" name="roles" class="form-control">
                                    <option selected disabled>Seleccione rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"  {{ $role->id == $user->roles()->get()->pluck('id')->first() ? 'selected' : ''}}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                    {{-- <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        @foreach ($roles as $role)
                             <div class="form-check">
                                  <input type="checkbox" value="{{ $role->id }}" name="roles[]">
                                      <label>
                                           {{ $role->name }}
                                      </label>
                             </div>
                       @endForeach
                       <button type="submit" class="btn btn-primary">Actualizar</button>
                 </form> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
