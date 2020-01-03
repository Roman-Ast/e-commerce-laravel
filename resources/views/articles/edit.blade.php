@extends('layouts.app')

@section('title', 'Редактировать статью')

@section('content')
 @include('partials.navbar')
    <div class="container" style="min-height:calc(100vh - 155px);">
    {!! Form::model($article, ['url' => route('articles.update', $article->id), 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
        {!! Form::hidden('author_id', Auth::user()->id, ['id' => 'author_id']) !!}
        {!! Form::hidden('article_id', $article->id, ['id' => 'article_id']) !!}
        {!! Form::hidden('author_name', Auth::user()->name, ['id' => 'author_name']) !!}
        {!! Form::hidden('status', 'опубликованная статья', ['id' => 'status']) !!}
        {!! Form::label('title', "Заголовок") !!}
        <div>
            {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 100, 'id' => 'article-title', 'required' => true]) !!}
            <input type="file" name="image" id="image">
        </div>
        {!! Form::label('title', 'Текст статьи') !!}
        {!! Form::textarea('body', $article->body, ['class' => 'form-control', 'id' => 'article-body']) !!}
        {!! Form::submit('Опубликовать', ['class' => 'btn btn-outline-primary']) !!}
        <button class="btn btn-outline-secondary" id="update-draft">Сохранить как черновик</button>
    {!! Form::close() !!}
    
    </div>

    @include('partials.footer')
@endsection