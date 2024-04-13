@extends('layouts.app')

@section('titulo')
    Crea una nueva publicaion
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush


@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 px-10">
            <div class="flex flex-col items-center justify-center h-screen">
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">Crear Publicacion</h2>
                    <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col">
                        @csrf

                        @if (session('message'))
                            <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ session('message') }}</p>
                        @endif

                        @error('titulo')
                            <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ $message }}</p>
                        @enderror
                        @error('descripcion')
                            <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ $message }}</p>
                        @enderror
                        @error('imagen')
                            <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ $message }}</p>
                        @enderror

                        <input id="titulo" name="titulo" type="text"
                            class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1  focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('titulo') border-red-500 @enderror"
                            placeholder="Titulo de la publicacion" value="{{ old('titulo') }}">

                        <textarea id="descripcion" name="descripcion"
                            class="bg-gray-100 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1  focus:ring-fuchsia-600 transition ease-in-out duration-150 @error('descripcion') border-red-500 @enderror"
                            placeholder="Descripcion de la publicacion"> {{ old('descripcion') }}
                        </textarea>

                        <div class="mb-5">
                            <input 
                                name="imagen" 
                                type="hidden"
                                value="{{ old('imagen') }}" />
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
