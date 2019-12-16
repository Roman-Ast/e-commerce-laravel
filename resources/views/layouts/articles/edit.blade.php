@extends('layouts.app')

@section('main')
    <div class="container">
    {!! Form::model($article, ['url' => route('articles.update', $article->id), 'method' => 'PATCH']) !!}
        {!! Form::hidden('author_id', Auth::user()->id, ['id' => 'author_id']) !!}
        {!! Form::hidden('article_id', $article->id, ['id' => 'article_id']) !!}
        {!! Form::hidden('author_name', Auth::user()->name, ['id' => 'author_name']) !!}
        {!! Form::hidden('status', 'опубликованная статья', ['id' => 'status']) !!}
        {!! Form::label('title', "Заголовок") !!}
        {!! Form::text('title', $article->title, ['class' => 'form-control', 'id' => 'article-title']) !!}
        {!! Form::label('title', 'Текст статьи') !!}
        {!! Form::textarea('body', $article->body, ['class' => 'form-control', 'id' => 'article-body']) !!}
        {!! Form::submit('Опубликовать', ['class' => 'btn btn-outline-primary']) !!}
        <button class="btn btn-outline-secondary" id="update-draft">Сохранить как черновик</button>
    {!! Form::close() !!}
    
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