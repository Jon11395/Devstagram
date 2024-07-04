@extends('layouts.app')

@section('titulo')
    Inicia Sesion en Devstagram
@endsection
    
@section('contenido')
    <div class="md:flex md:justify-center md:gap-5 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen login usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form method="post" action=" {{ route('login') }} "  novalidate>
                @csrf
                @if (session('mensaje'))
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ session('mensaje') }}</p>
                @endif
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
                    <input type="checkbox" name="remember"> <label class="text-gray-500 text-sm">Mantener mi sesión abierta</label>
                </div>
                <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-slate-700  transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection