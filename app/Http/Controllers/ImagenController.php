<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request) {
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . "." . $imagen->extension(); //id unico

        $imagenServidor = Image::make($imagen); // la guardamos en memoria
        $imagenServidor->fit(1000, 1000); //esto cortara la imagen a 1000 x 1000 

        $imagenPath = public_path('uploads') . '/' . $nombreImagen; //la imagen se sube a upload
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
