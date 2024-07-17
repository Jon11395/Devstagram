<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class PerfilController extends Controller
{
    public function index(){

        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            'username' => ['required','unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'regex:/\w*$/', 'not_in:twitter,editar-perfil,login,register'],
            'email' => ['required','unique:users,email,'.auth()->user()->id, 'email', 'max:60'],
        ]);

        if($request->imagen){

            $manager = new ImageManager(new Driver());
 
            $imagen = $request->file('imagen');
    
            //generar un id unico para las imagenes
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            //guardar la imagen al servidor
            $imagenServidor = $manager->read($imagen);
            //agregamos efecto a la imagen con intervention
            $imagenServidor->resizeCanvas(1000, 1000);
            // la unidad de mide en PX 1= 1pixiel
    
            //agregamos la imagen a la  carpeta en public donde se guardaran las imagenes
            $imagenesPath = public_path('perfiles') . '/' . $nombreImagen;
            //Una vez procesada la imagen entonces guardamos la imagen en la carpeta que creamos
            $imagenServidor->save($imagenesPath);
        }


        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();


        // Cambiar la contraseña
        if($request->password || $request->new_password){
            $request->validate([
                'password' => 'required|min:6',
                'new_password' => 'required|min:6'
            ]);

 
            if(Hash::check($request->password, $usuario->password)){
                $usuario->password = Hash::make($request->new_password);
                $usuario->save();
            } else {
                return back()->with('mensaje', 'Su contraseña no es válida');
            }
            
        }

        //Redirecionar
        return redirect()->route('posts.index', $usuario->username);

    }
}
