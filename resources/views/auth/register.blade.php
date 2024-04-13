@extends('layouts.app')

@section('titulo')
    Registrate en Codestagram
@endsection

@section('contenido')
    <div class="md:flex p-4 md:justify-center items-center md:gap-10">
        <div class="flex justify-center bg-center p-4">
            <img class="w-full max-w-xs rounded-lg" src="{{ asset('img/dev.jpg') }}"
                alt="Image d'enregistrement de l'utilisateur">
        </div>

        <div class=" flex flex-col items-center justify-center">
            <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Sign Up</h2>
                <form action="{{ route('register') }}" method="POST" class="flex flex-col" >
                    @csrf
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center"> {{$message}} </p>
                    @enderror
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{$message}}</p>
                    @enderror
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{$message}}</p>
                    @enderror
                    @error('email_confirmation')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{$message}}</p>
                    @enderror
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{$message}}</p>
                    @enderror
                    @error('password_confirmation')
                        <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{$message}}</p>
                    @enderror
                    <div class="flex space-x-4 mb-4">

                        <input id="name" name="name" placeholder="First Name"
                            class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 w-1/2 focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('name') border-red-500 @enderror"
                            type="text" 
                            value="{{old ('name')}}"/>

                        <input id="username" name="username" placeholder="User Name"
                            class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 w-1/2 focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('username') border-red-500 @enderror"
                            type="text" value="{{old ('username')}}"/>
                    </div>
                    <input id="email" name="email" placeholder="Email"
                        class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('email') border-red-500 @enderror"
                        type="email" value="{{old ('email')}}"/>
                    <input id="email_confirmation" name="email_confirmation" placeholder="Confirm Email"
                        class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4  focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('confirm_email') border-red-500 @enderror"
                        type="email" value="{{old ('email')}}"/>
                    <input id="password" name="password" placeholder="Password"
                        class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4  focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('password') border-red-500 @enderror"
                        type="password" />
                    <input id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"
                        class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4  focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('password_confirmation') border-red-500 @enderror"
                        type="password" />

                    <p class="text-gray-700 mt-4">
                        Already have an account?
                        <a class="text-sm text-blue-500 -200 hover:underline mt-4" href=" {{route('login')}} ">Login</a>
                    </p>
                    <button
                        class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150"
                        type="submit">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
