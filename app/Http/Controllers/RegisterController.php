<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

  public function index()
  {
    return view('auth.register');
  }

  public function store(Request $request)
  {
    // dd($request);
    
    //Modificar el request
    $request->request->add(['username' => Str::slug($request->username)]);
    //Validacion de formulario
    $validated = $request->validate(
      [
        'name' => 'required|max:20',
        'username' => 'required|alpha_dash|max:20|min:3|unique:users,username',
        'email' => 'required|confirmed|max:60|unique:users|email',
        'password' => 'required|confirmed|min:6|max:62',
      ]
    );

    User::create(
      [
        'name' => $request->name,
        'username' => Str::slug($request->username),
        'email' => $request->email,
        'password' => Hash::make($request->password)
      ]
    );

    //Autenticar usuario
    // auth()->attempt(
    //   [
    //     'email' => $request->email,
    //     'password' => $request->password
    //   ]
    // );

    //Autenticar de otra manera
    auth()->attempt($request->only('email', 'password'));

    // Redireccionar
    //return redirect()->route('posts.index');
    return redirect()->route('posts.index', auth()->user()->username);
  }
}
