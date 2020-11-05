@extends('layouts.app')

@section('content')
    <div class="flex justify-center px-6 my-12">
        <div class="w-full xl:w-3/4 lg:w-11/12 flex">
            <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                style="background-image: url('https://images.unsplash.com/photo-1551739440-5dd934d3a94a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80')">
            </div>
            <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                <h3 class="pt-4 text-2xl text-center font-semibold">{{ __('Register') }}</h3>
                <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                            {{ __('Name') }}
                        </label>
                        <input
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('name') is-invalid @enderror"
                            id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                            {{ __('E-Mail Address') }}
                        </label>
                        <input
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('email') is-invalid @enderror"
                            id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            autofocus />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                            {{ __('Password') }}
                        </label>
                        <input
                            class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror"
                            id="password" type="password" name="password" required autocomplete="current-password"/>

                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="password-confirm">
                            {{ __('Confirm Password') }}
                        </label>
                        <input
                            class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"/>
                    </div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-100 border-t border-b border-red-500 text-dark-700 px-4 py-3 mb-3" role="alert">
                                <p class="text-sm">{{ $error }}</p>
                            </div>
                        @endforeach
                    @endif

                    <div class="mb-6 text-center">
                        <button
                            class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                            type="submit">
                            {{ __('Register') }}
                        </button>
                    </div>
                    <hr class="mb-6 border-t hidden" />
                </form>
            </div>
        </div>
    </div>
@endsection
