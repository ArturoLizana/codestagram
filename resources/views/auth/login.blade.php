@extends('layouts.app')

@section('titulo')
    Inicia sesion en Codestagram
@endsection

@section('contenido')
    <div class="md:flex p-4 md:justify-center items-center md:gap-10">
        <div class="flex justify-center bg-center p-4">
            <img class="w-full max-w-xs rounded-lg" src="{{ asset('img/dev2.png') }}" alt="Image login de l'utilisateur">
        </div>

        <div class="flex flex-col items-center justify-center p-4">
            <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Login</h2>
                <form method="POST" action="{{ route('login') }}" class="flex flex-col">
                    @csrf

                    @if (session('message'))
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ session('message') }}</p>
                    @endif

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ $message }}</p>
                    @enderror
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ $message }}</p>
                    @enderror

                    <input id="email" name="email" type="email"
                        class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1  focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('email') border-red-500 @enderror"
                        placeholder="Email address" value="{{ old('email') }}">

                    <input id="password" name="password" type="password"
                        class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1  focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('password') border-red-500 @enderror"
                        placeholder="Password">

                    <div class="flex items-center justify-between flex-wrap">
                        <label class="text-sm text-gray-700 cursor-pointer">
                            <input type="checkbox" name="remember" class="mr-2">
                            Remember me
                        </label>
                        <a href="#" class="text-sm text-blue-500 hover:underline mb-0.5">Forgot password?</a>
                        <p class="text-gray-700 mt-4"> Don't have an account? <a href="{{ route('register') }}"
                                class="text-sm text-blue-500 -200 hover:underline mt-4">Signup</a></p>
                    </div>
                    <button type="submit"
                        class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
