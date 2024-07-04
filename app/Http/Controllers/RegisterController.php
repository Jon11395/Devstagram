<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|min:3|max:30|unique:users',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Autenticar
        /*
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        */

        //Otra forma de Autenticar
        auth()->attempt($request->only('email', 'password'));

        //Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);

    }

}
