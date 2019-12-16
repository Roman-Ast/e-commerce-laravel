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
        <h1>{{ $article->title }}</h1>
        <p> {{ $article->body }}</p>
        @if (Auth::user()->name === $article->author_name)
        <div style="display:flex;flex-direction:row;justify-content:flex-start;">
            {!! Form::model($article, ['url' => route('articles.edit', $article->id), 'method' => 'GET']) !!}
            {!! Form::submit('Редактировать', ['class' => 'btn btn-outline-primary']) !!}
            {!! Form::close() !!}
            {!! Form::model($article, ['url' => route('articles.destroy', $article->id), 'method' => 'DELETE']) !!}
            {!! Form::submit('Удалить', ['class' => 'btn btn-outline-danger']) !!}
            {!! Form::close() !!}
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