@extends('layouts.app')

@section('main')
<div class="container">
    <div><a href="{{ route('articles.create') }}">Добавить статью в блог</a></div>
    @foreach ($articles as $article)
        @if (isset($article->image))
            <div class="card mb-3" >
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <img src="..." class="card-img" alt="...">
                    </div>
                  <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->body, 200) }}<a href="{{ route('articles.show', $article->id) }}">далее</a></p>
                      <p class="card-text"><small class="text-muted">{{ $article->updated_at }}</small></p>
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
                        <p class="card-text">{{ Str::limit($article->body, 300) }}<a href="{{ route('articles.show', $article->id) }}">далее</a></p>
                        <div style="display:flex;flex-direction:row;justify-content:space-between;">
                            <p class="card-text">Автор: <i>{{ $article->author_name }}</i></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    
                                </small>
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