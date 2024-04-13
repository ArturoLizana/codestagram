@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto md:flex">

        <div class="md:w-1/2 p-6">
            <img class="rounded-lg mb-4" src="{{ asset('uploads') . '/' . $post->imagen }} "
                alt="Imagen del post {{ $post->titulo }}">

            <div class="flex justify-start items-center gap-4">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>

            <div>
                <p class="font-bold"> {{ $post->user->username }} </p>
                <p class="text-sm text-gray-500"> {{ $post->created_at->diffForHumans() }} </p>
                <p class="mt-5"> {{ $post->descripcion }} </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                            class="bg-gradient-to-r from-red-500 to-red-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-red-600 hover:to-red-600 transition ease-in-out duration-150">Eliminar
                            Publicacion</button>
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-6">
            <div class="shadow bg-white p-5 mb-5">

                @auth

                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold ">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-md p-2 text-center">{{ $message }}</p>
                        @enderror
                        <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">


                            @if ($post->comentarios->count())
                                @foreach ($post->comentarios as $comentario)
                                    <!-- component -->
                                    <div class="flex justify-center relative top-1/3">

                                        <!-- This is an example component -->
                                        <div
                                            class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
                                            <div class="relative flex gap-4">
                                                <img src="{{ $comentario->user->imagen ? asset('perfiles') . '/' . $comentario->user->imagen : asset('img/instagram.png') }}"
                                                    class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20"
                                                    alt="" loading="lazy">
                                                <div class="flex flex-col w-full">
                                                    <div class="flex flex-row justify-between">
                                                        <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">
                                                            {{ $comentario->user->username }}
                                                        </p>
                                                        <a class="text-gray-500 text-xl"
                                                            href="{{ route('posts.index', $comentario->user) }}"><i
                                                                class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                    <p class="text-gray-400 text-sm">
                                                        {{ $comentario->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <p class="-mt-4 text-gray-500"> {{ $comentario->comentario }} </p>
                                        </div>

                                    </div>
                                @endforeach
                            @else
                                <p class="p-10 text-center">No hay comentarios</p>
                            @endif
                        </div>
                        <div class="bg-white border border-slate-200 grid grid-cols-6 gap-2 rounded-xl p-2 text-sm">
                            <h1 class="text-center text-slate-200 text-xl font-bold col-span-6">Send Feedback</h1>
                            <textarea id="comentario" name="comentario" placeholder="Your feedback..."
                                class="bg-slate-100 text-slate-600 h-28 placeholder:text-slate-600 placeholder:opacity-50 border border-slate-200 col-span-6 resize-none outline-none rounded-lg p-2 duration-300 focus:border-slate-600"></textarea>

                            <span class="col-span-2"></span>
                            <button
                                class="bg-slate-100 stroke-slate-600 border border-slate-200 col-span-6 flex justify-center items-end  rounded-lg p-2 duration-300 hover:border-slate-600 hover:text-white focus:stroke-blue-200 focus:bg-blue-400">
                                <svg fill="none" viewBox="0 0 24 24" height="30px" width="30px"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                                        d="M7.39999 6.32003L15.89 3.49003C19.7 2.22003 21.77 4.30003 20.51 8.11003L17.68 16.6C15.78 22.31 12.66 22.31 10.76 16.6L9.91999 14.08L7.39999 13.24C1.68999 11.34 1.68999 8.23003 7.39999 6.32003Z">
                                    </path>
                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                                        d="M10.11 13.6501L13.69 10.0601"></path>
                                </svg>
                            </button>

                        </div>
                    </form>

                @endauth

            </div>
        </div>

    </div>
@endsection
