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
}
