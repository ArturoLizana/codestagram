@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection


@section('contenido')
    <div
        class="max-w-md mx-auto relative overflow-hidden z-10 bg-white p-8 rounded-lg shadow-md before:w-24 before:h-24 before:absolute before:bg-purple-500 before:rounded-full before:-z-10 before:blur-2xl after:w-32 after:h-32 after:absolute after:bg-sky-400 after:rounded-full after:-z-10 after:blur-xl after:top-24 after:-right-12">
        <h2 class="text-2xl text-sky-900 font-bold mb-6">Update Your Profile</h2>

        <form method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data">
            @csrf
            @error('username')
                <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ $message }}</p>
            @enderror
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600" for="username">User Name</label>
                <input 
                id="username" 
                name="username" 
                placeholder="User Name"
                type="text" 
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('username') border-red-500 @enderror"     
                value="{{ old('username') }}"
                />
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600" for="username">Imagen Perfil</label>
                <input 
                id="imagen" 
                name="imagen"
                type="file" 
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-1 focus:ring-fuchsia-600 transition ease-in-out duration-150 text-sm text-gray-500
                file:me-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-600 file:text-white
                hover:file:bg-blue-700
                file:disabled:opacity-50 file:disabled:pointer-events-none
                dark:file:bg-blue-500
                dark:hover:file:bg-blue-400"     
                value="{{ old('username') }}"
                accept=".jpg, .png, .jpeg,"
                />
            </div>
            

            <div class="flex justify-end">
                <button
                    class="[background:linear-gradient(144deg,#af40ff,#5b42f3_50%,#00ddeb)] text-white px-4 py-2 font-bold rounded-md hover:opacity-80"
                    type="submit">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
@endsection
