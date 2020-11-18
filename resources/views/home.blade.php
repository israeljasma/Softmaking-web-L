@extends('layouts.app')

@section('content')

    <div class="w-full bg-white shadow-sm">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
        <a href="{{ route('user.invoices.index') }}"><button type="submit"
            class="px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-700 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:text-lg md:px-10">Facturas</button></a>
    </div>

@endsection
