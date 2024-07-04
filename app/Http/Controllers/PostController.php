<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller
{

    public function index(User $user){

        //dd($user);
        return view('layouts.dashboard', [ 'user' => $user]);
    }
    
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        
        //Validacion
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:30|unique:users',
            'imagen' => 'required',
            'user_id' => 'required|confirmed|min:6',
        ]);
    }
}
