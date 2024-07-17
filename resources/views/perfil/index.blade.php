@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection
    
@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" enctype="multipart/form-data" method="POST" class="mt-10 md:mt-0" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="username"class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value={{ auth()->user()->username }}>
                    @error('username')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email"class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Usuario" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value={{ auth()->user()->email }}>
                    @error('email')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen"class="mb-2 block uppercase text-gray-500 font-bold">Imagen perfil</label>
                    <input type="file" id="imagen" name="imagen" accept=".jpg, .jpeg, .png" class="border p-3 w-full rounded-lg" value="">
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                    @if (session('mensaje'))
                        <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ session('mensaje') }}</p>
                    @endif
                </div>
                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseña</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Contraseña" class="border p-3 w-full rounded-lg ">
                    @error('new_password')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                    
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-slate-700  transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection