@extends('layouts.app')

@section('titulo')
    Crea una nueva publicacion
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />    
@endpush

    
@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2  bg-white p-6 rounded-lg shadow-lg mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo"class="mb-2 block uppercase text-gray-500 font-bold">Título</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Título de la publicación" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" value={{ old('titulo')}}>
                    @error('titulo')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion"class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea type="text" id="descripcion" name="descripcion" placeholder="Descripción de la publicación" class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion')}}</textarea>
                    @error('descripcion')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="hidden" name="imagen">
                    @error('imagen')
                    <p class="ml-2 text-red-600 rounded-lg text-sm p-1 font-italic">{{ $message }}</p>
                    @enderror
                </div>


                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-slate-700  transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>

    </div>
@endsection