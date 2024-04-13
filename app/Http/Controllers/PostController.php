<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth', except: ['show', 'index']),
        ];
    }
    //
    public function index(User $user)
    {
        //latest es para ordenar las publicaciones de la mas nueva a la mas antigua
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);


        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {  // este publica una vista
        return view('posts.create');
    }

    public function store(Request $request)
    {  // este guarda en la base de datos
        $validated = $request->validate(
            [
                'titulo' => 'required|max:255',
                'descripcion' => 'required|max:1500',
                'imagen' => 'required',
            ]
        );

        $request->user()->posts()->create(
            [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $request->imagen,
                'user_id' => auth()->user()->id
            ]
        );

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post) {
        Gate::authorize('delete', $post);
        $post->delete();

        //eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
            
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
