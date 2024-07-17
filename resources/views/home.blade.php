@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection
    
@section('contenido')
    
    @if ($posts->count())
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
            @foreach ($posts as $post)
                <div class="m-9">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img class="rounded-2xl" src="{{ asset('uploads').'/'. $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                    <div class="mx-2 mt-1 text-sm flex flex-row flex-nowra justify-between text-end">
                        <div>
                            <div class="flex">
                                @auth
                                    <livewire:like-post :post="$post" />
                                @endauth
                            </div>
                            
                            <p class="mb-1 text-gray-500 text-start"> {{ $post->descripcion }} </p>
                        </div>
                        <div class="mt-0.5">
                            <a class="font-bold hover:underline" href=" {{ route('posts.index',  $post->user->username )}}"> {{ $post->user->username }}</a>
                            <p class="text-sm text-gray-500"> {{ $post->created_at->diffForHumans() }} </p>
                        </div>
                    </div>
                    

                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-center">No hay publicaciones</p>
    @endif

@endsection