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

        <div class="container">
            <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                Автор: {{ $article->author_name }}
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
            @if (isset($article->image))
                <div class="" style="width:100%;">
                    <img src="{{ asset("/storage/{$article->image}") }}" style="width:100%;">
                </div>
            @endif
            <div class="article-title">
                <h1>{{ $article->title }}</h1>
            </div>
            <div class="article-body">
                <p> {{ $article->body }}</p>
            </div>
            
            <div class="like-article">
                    {!! Form::hidden('article_id', $article->id, ['id' => 'article_id']) !!}
                    {!! Form::hidden('user_id', Auth::user()->id, ['id' => 'user_id']) !!}
                @if (Auth::user())
                    {!! Form::hidden('user_id', Auth::user()->id) !!}
                @endif
                
                <div id="to-like">
                    @if ($likedByMe)
                        <img src="/images/like-inactive.png" style="display:none;">
                        <img src="/images/like.png">
                    @else
                        <img src="/images/like-inactive.png">
                        <img src="/images/like.png" style="display:none;">
                    @endif
                </div>
                <div id="dynamicLikesCount">
                    @if ($likes > 0)
                        {{ $likes }}
                    @endif
                </div>
            </div>
            

        @if (Auth::user()->name === $article->author_name)
        <div style="display:flex;flex-direction:row;justify-content:flex-start;">
            {!! Form::model($article, ['url' => route('articles.edit', $article->id), 'method' => 'GET']) !!}
            {!! Form::submit('Редактировать', ['class' => 'btn btn-outline-primary']) !!}
            {!! Form::close() !!}
            {!! Form::model($article, ['url' => route('articles.destroy', $article->id), 'method' => 'DELETE']) !!}
            <div class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Предупреждение</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Данное действие приведет к полному и безвозвратному удалению статьи! Вы действительно этого хотите?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Подумать еще</button>
                            {!! Form::submit('Удалить статью полностью', ['class' => ' btn btn-danger'])!!}
                        </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <button class="modal-show btn btn-outline-danger review-delete">Удалить</button>
        </div>
    @endif
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