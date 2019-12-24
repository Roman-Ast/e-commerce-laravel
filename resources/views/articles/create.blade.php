@extends('layouts.app')

@section('content')

    @include('partials.navbar')
<div class="container">
    {!! Form::open(['url' => route('articles.store'), 'enctype' => 'multipart/form-data']) !!}
        {!! Form::hidden('author_id', Auth::user()->id, ['id' => 'author_id']) !!}
        {!! Form::hidden('author_name', Auth::user()->name, ['id' => 'author_name']) !!}
        {!! Form::hidden('status', 'опубликованная статья', ['id' => 'status']) !!}
        {!! Form::label('title', "Заголовок") !!}
        <div>
            {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 100, 'id' => 'article-title', 'required' => true]) !!}
            <input type="file" name="image" id="image">
        </div>
        {!! Form::label('title', 'Текст статьи') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'article-body', 'required' => true]) !!}
        {!! Form::submit('Опубликовать', ['class' => 'btn btn-outline-primary']) !!}
        <button class="btn btn-outline-secondary" id="save-as-draft">Сохранить как черновик</button>
    {!! Form::close() !!}
    
</div>

@include('partials.navbar')

@endsection
