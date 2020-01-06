@extends('layouts.app')

@section('title', 'Блог')

@section('content')

@include('partials.navbar')

<div class="container">
    @if (Session::has('success_message'))

        <div class="alert {{ Session::get('class') }}" style="align-text:center;">
            <div style="display:flex;justify-content:flex-end;" class="close-flash">
                &times;
            </div>
            {{ Session::get('success_message') }}
        </div>

    @endif 

    @if (Route::getCurrentRoute()->uri == 'myarticles')
        <h1>Мои статьи</h1>
    @else
        <h1>Блог</h1>
    @endif

    <div style="width: 100%;display:flex;justify-content:flex-end;margin-bottom:10px;" >
        @if (Auth::user())
            <a href="{{ route('articles.create') }}" class="btn btn-outline-secondary">Добавить статью в блог</a>
        @else
            <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Чтобы написать в блог, войдите или зарегестрируйтесь.">
                    Добавить статью в блог
              </button>
        @endif
        
    </div>
    @foreach ($articles as $article)
        
            <div class="card mb-3" >
                <div class="row no-gutters">
                    @if (isset($article->image))
                        <div class="col-md-2" style="display:flex;align-items:flex-start;">
                            <img src="{{ asset("/storage/{$article->image}") }}" class="card-img" alt="...">
                        </div>
                    @else
                        <div class="col-md-2" style="display:flex;align-items:flex-start;">
                            <img src="{{ asset("/images/no-photo.png") }}" class="card-img" alt="...">
                        </div>
                    @endif
                  <div class="col-md-10">
                    <div class="card-body">
                        <div style="display:flex;justify-content:space-between;">
                            <p class="card-text text-muted">Автор: <i>{{ $article->author_name }}</i></p>
                             <p class="card-text">
                                @if (isset($timeExpired[$article->id]))
                                    @foreach ($timeExpired[$article->id] as $key => $value)
                                        <small class="text-muted">
                                            Обновлено {{ $value }} {{ $key }}
                                        </small>
                                    @endforeach
                                @else
                                    <small class="text-muted">
                                        Обновлено только что
                                    </small>
                                @endif
                            </p>
                        </div>
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">
                            {{ Str::limit($article->body, 200) }}
                            <a href="{{ route('articles.show', $article->id) }}">далее</a>
                        </p>
                        <div style="display:flex;flex-direction:row;justify-content:space-between;">
                            <small style="font-style:italic;margin-right:10px;" class="text-muted">
                                @if (!empty($comments))
                                    @if (array_key_exists($article->id, $comments))
                                        Комментарии: {{ $comments[$article->id] }}
                                    @else
                                        Комментарии:  -
                                    @endif
                                @endif
                            </small>

                            
                            @if (array_key_exists($article->id, $likes))
                                <div><img src="/images/like.png"> {{ $likes[$article->id]}}</div>
                            @endif

                            @if (Route::getCurrentRoute()->uri == 'myarticles')
                                <p><small class="text-muted">Статус: {{ $article->status }}</small></p>
                            @endif

                        </div>
                    </div>
                  </div>
                </div>
            </div>
        
    @endforeach
</div>
<div class="links container">
    {{ $articles->links() }}
</div>

@include('partials.footer')

@endsection