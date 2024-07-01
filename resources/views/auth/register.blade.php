@extends('layouts.app')

@section('titulo')
    Registrate
@endsection
    
@section('contenido')
    <div class="md:flex md:justify-center md:gap-5 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="imgen registro usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="/register" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name"class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value={{ old('name')}}>
                    @error('name')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Usuario</label>
                    <input type="text" id="username" name="username" placeholder="Usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value={{ old('username')}}>
                    @error('username')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value={{ old('email')}}>
                    @error('email')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" value={{ old('password')}}>
                    @error('password')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Contraseña" class="border p-3 w-full rounded-lg " value={{ old('password_confirmation')}}>
                </div>

                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-slate-700  transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection