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
            <div class="article-title"><h1>{{ $article->title }}</h1></div>
            <div class="article-body"><p> {{ $article->body }}</p></div>
        

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