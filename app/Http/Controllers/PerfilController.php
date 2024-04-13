<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $validated = $request->validate(
            [
                'username' => ['required', 'alpha_dash', 'max:20', 'min:3', 'unique:users,username,' . auth()->user()->id]
            ]
        );

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); //id unico

            $imagenServidor = Image::make($imagen); // la guardamos en memoria
            $imagenServidor->fit(1000, 1000); //esto cortara la imagen a 1000 x 1000 

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen; //la imagen se sube a upload
            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //ridericcionar usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}
