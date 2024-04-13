@extends('layouts.app')

@section('titulo')
    <?php echo $user->username; ?>
@endsection

@section('contenido')
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

    <section class="pt-16 bg-blueGray-50 mb-5">
        <div class="w-full lg:w-4/12 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full px-4 flex justify-center">
                            <div class="relative">
                                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/instagram.png') }}" alt="image utilisateur"
                                    class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                            </div>
                        </div>
                        <div class="w-full px-4 text-center mt-20">
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="mr-4 p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                        {{ $user->posts->count() }}
                                    </span>
                                    <span class="text-sm text-blueGray-400">Post</span>
                                </div>
                                <div class="mr-4 p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                        {{ $user->followers->count() }}
                                    </span>
                                    <span class="text-sm text-blueGray-400"> @choice('Follower|Followers', $user->followers->count())</span>
                                </div>
                                <div class="lg:mr-4 p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                        {{ $user->followings->count() }}
                                    </span>
                                    <span class="text-sm text-blueGray-400"> Following</span>
                                </div>
                            </div>
                        </div>

                        @auth     
                        @if ($user->id !== auth()->user()->id)    
                            @if (!$user->siguiendo(auth()->user()))
                                
                                            
                        <form method="POST" action="{{ route('users.follow', $user) }}" class="space-y-6">
                           @csrf
                            <input
                              class="w-full py-2 px-4 bg-purple-500 hover:bg-purple-700 rounded-md shadow-lg text-white font-semibold transition duration-200"
                              type="submit"
                              value="Seguir"
                            />
                          </form>
                             @else
                          <form method="POST" action="{{ route('users.unfollow', $user) }}" class="space-y-6">
                            @csrf
                            @method('DELETE')
                             <input
                               class="w-full py-2 px-4 bg-red-500 hover:bg-red-700 rounded-md shadow-lg text-white font-semibold transition duration-200"
                               type="submit"
                               value="Dejar de Seguir"
                             />
                           </form>
                              @endif             
                           @endif  
                        @endauth
                    </div>
                    <div class="text-center mt-12">
                        <div class="flex justify-center items-center gap-2">
                            <h3 class="text-xl font-semibold leading-normal mb-2 text-blueGray-700">
                                {{ $user->username }}
                            </h3>
                            @auth
                                @if ($user->id === auth()->user()->id)
                                <a class="text-gray-500 hover:text-gray-700 cursor-pointer" href="{{ route('perfil.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>                                        
                                </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        <x-listar-post :posts="$posts"/>
        
    </section>
@endsection
