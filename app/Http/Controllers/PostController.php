<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller
{

    public function index(User $user){

        $posts = Post::where('user_id', $user->id)->latest()->paginate(15);

        return view('layouts.dashboard', [ 
            'user' => $user,
            'posts' => $posts
        ]);
    }
    
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        
        //Validacion
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);


        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        //otra forma de crear registros
        /*
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = $request->auth()->user()->id;
        $post->save();
        */

        //otra forma de crear registros (debe existir las relaciones en los modelos(hasMany, BelongstO...))
         /*
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        */

        return redirect()->route('posts.index', auth()->user()->username);

    }

    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){

        Gate::allows('delete', $post);
        $post->delete();

        //Eliminar tambien la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
