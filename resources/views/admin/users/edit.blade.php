@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Editar Usuario {{ $user->name }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <select id="roles" name="roles" class="form-control">
                            <option selected disabled>Seleccione rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
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
