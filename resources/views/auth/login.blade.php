@extends('layouts.app')

@section('content')
    <div class="flex justify-center px-6 my-12">
        <div class="w-full xl:w-3/4 lg:w-11/12 flex">
            <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                style="background-image: url('https://images.unsplash.com/photo-1536412597336-ade7b523ecfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80')">
            </div>
            <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                <h3 class="pt-4 text-2xl text-center font-semibold">{{ __('Login') }}</h3>
                <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="POST" action="{{ route('login') }}">
                    @csrf
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
                            id="password" type="password" name="password" required autocomplete="current-password" />

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="bg-red-100 border-t border-b border-red-500 text-dark-700 px-4 py-3"
                                    role="alert">
                                    <p class="text-sm">{{ $error }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="mb-4">
                        <input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }} />
                        <label class="text-sm" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="mb-6 text-center">
                        <button
                            class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                            type="submit">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <hr class="mb-6 border-t" />
                    <div class="text-center">
                        <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                            href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </div>
                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
