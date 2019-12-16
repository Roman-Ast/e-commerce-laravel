@extends('layouts.app')

@section('main')
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
        @if (isset($article->image))
            <div class="card mb-3" >
                <div class="row no-gutters">
                    <div class="col-md-2" style="display:flex;align-items:center;">
                        <img src="{{ asset("/storage/{$article->image}") }}" class="card-img" alt="...">
                    </div>
                  <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->body, 200) }}
                            <a href="{{ route('articles.show', $article->id) }}">далее</a>
                        </p>
                        <div style="display:flex;flex-direction:row;justify-content:space-between;">
                            <p class="card-text">Автор: <i>{{ $article->author_name }}</i></p>
                            @if (Route::getCurrentRoute()->uri == 'myarticles')
                                <p><small class="text-muted">Статус: {{ $article->status }}</small></p>
                            @endif
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
                    </div>
                  </div>
                </div>
            </div>
        @else
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">
                            {{ Str::limit($article->body, 300) }}
                            <a href="{{ route('articles.show', $article->id) }}">далее</a>
                        </p>
                        <div style="display:flex;flex-direction:row;justify-content:space-between;">
                            <p class="card-text">Автор: <i>{{ $article->author_name }}</i></p>
                            @if (Route::getCurrentRoute()->uri == 'myarticles')
                                <p><small class="text-muted">Статус: {{ $article->status }}</small></p>
                            @endif
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
                    </div>
                  </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endsection

@section('submain-header')@endsection

@section('submain')@endsection

@section('sales-header')@endsection

@section('sales')@endsection

@section('news-header')@endsection

@section('news')@endsection

@section('about-header')@endsection

@section('about')@endsection

@section('about-header')@endsection