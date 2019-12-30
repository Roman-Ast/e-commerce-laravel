@extends('layouts.app')

@section('title', 'Результаты поиска')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                
                @forelse ($articles as $article)
                    <article class="mb-3">
                        <h2>{{ $article->title }}</h2>

                        <p class="m-0">{{ $article->body }}</body>
                    </article>
                @empty
                    <p>No articles found</p>
                @endforelse
            </div>
        </div>
    </div>
@stop