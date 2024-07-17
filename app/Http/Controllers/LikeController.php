<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LikeController extends Controller
{
    //Guarda el like
    public function store(Request $request, Post $post){

        
        

        return back();
    }

    //Elimina el like
    public function destroy(Request $request, Post $post){


    }

    
}
