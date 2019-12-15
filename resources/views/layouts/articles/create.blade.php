@extends('layouts.app')

@section('main')
<div class="container">
    {!! Form::open(['url' => route('articles.store')]) !!}
        {!! Form::hidden('author_id', Auth::user()->id) !!}
        {!! Form::hidden('author_name', Auth::user()->name) !!}
        {!! Form::label('title', "Заголовок") !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'article-title']) !!}
        {!! Form::label('title', 'Текст статьи') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'article-body']) !!}
        {!! Form::submit('Сохранить как черновик', ['class' => 'btn btn-outline-secondary']) !!}
        {!! Form::submit('Опубликовать', ['class' => 'btn btn-outline-primary']) !!}
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