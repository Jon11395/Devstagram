<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        //dd($request);
        //dd($request->get('name'));

        //Validacion

        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|min:3|max:30|unique:users',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required',
        ]);
    }

}
