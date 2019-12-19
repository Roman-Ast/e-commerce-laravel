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
        @if ($errors->any())
        <div class="alert alert-warning">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
            @if (Auth::user())
                <div class="like-article">
                    {!! Form::hidden('article_id', $article->id, ['id' => 'article_id']) !!}
                    {!! Form::hidden('user_id', Auth::user()->id, ['id' => 'user_id']) !!}
                    {!! Form::hidden('user_id', Auth::user()->id) !!}
    
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
            @else
            <div class="like-article">
                <div id="" data-toggle="tooltip" data-placement="top" title="Чтобы ваше мнение было учтено - зарегестрируйтесь">
                    @if ($likes > 0)
                        <img src="/images/like.png">
                    @endif
                </div>
                <div id="dynamicLikesCount">
                    @if ($likes > 0)
                        {{ $likes }}
                    @endif
                </div>
            </div>
            @endif
           
            
        @if (Auth::user())
          
        @if (Auth::user()->name === $article->author_name)
        <div style="display:flex;flex-direction:row;justify-content:flex-start;">
            {!! Form::model($article, ['url' => route('articles.edit', $article->id), 'method' => 'GET']) !!}
            {!! Form::submit('Редактировать', ['class' => 'btn  btn-sm btn-outline-primary']) !!}
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
                            <p>Данное действие приведет к полному и безвозвратному удалению! Вы действительно этого хотите?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Подумать еще</button>
                            {!! Form::submit('Удалить статью полностью', ['class' => ' btn btn-danger'])!!}
                        </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <button class="modal-show btn btn-outline-danger btn-sm review-delete">Удалить</button>
        </div>
    @endif

    @endif 
    </div>
    @if (!empty($comments->toArray()))
        <h5 class="container">Комментарии</h5>
    @else
        <h5 class="container">Комментарии<small class="text-muted">(пока нет)</small></h5>
    @endif
    <div class="comments-container container" >
        @if (Auth::user())
            {!! Form::open(['url' => route('comments.store'), 'style' => 'display:flex;flex-direction:column;align-items:flex-end;']) !!}
            {!! Form::hidden('article_id', $article->id) !!}
            {!! Form::hidden('author_id', Auth::user()->id ?? '') !!}
            {!! Form::hidden('author_name', Auth::user()->name ?? '') !!}
            {!! Form::textarea('body', null, ['id' => 'comment-body', 'rows' => 1, 'placeholder' => 'оставьте комментарий', 'style' => 'border-right:0;border-left:0;border-top:0;border:bottom:1px solid #eee;width:100%;']) !!}
            <div style="height:50px;">
                {!! Form::submit('Оставить комментарий', ['id' => 'send-comment', 'class' => 'btn btn-sm btn-outline-success', 'style' => 'display:none;width:170px;']) !!}
                <button class="btn btn-sm btn-outline-secondary" id="cancel-comment" style="display:none;">Отмена</button>
            </div>
            {!! Form::close() !!}
        @endif

        <div class="comments-display" style="margin-top:20px;">
                
            @foreach ($comments as $comment)
            <div class="comment-container">
                <div style="font-style:italic;font-weight:600;display:flex;justify-content:sflex-start;margin-top:5px;">
                    {{ $comment->author_name }}
                    <small class="text-muted" style="margin-left:5px;">{{ $comment->updated_at }}</small>
                </div>
                <div style="font-family:'Roboto';border-bottom:1px solid #ccc;width:100%;min-height:50px;display:flex;align-items:flex-end;">
                    {{ $comment->body }}
                </div>
                @if (Auth::user())
                    @if (Auth::user()->name === $comment->author_name)
                        <div class="accordion accordion-comment" id="accordionExample">
                            <div class="card" style="border:1px solid #fff;">
                                <div style="border:1px solid #fff;" class="" id="headingOne">
                                    <button class="btn btn-outline-primary btn-sm" type="button" data-toggle="collapse" data-target="#edit-comment" aria-expanded="true" aria-controls="collapseOne">
                                        Редактировать
                                    </button>
                                    <button class="modal-show btn btn-sm btn-outline-danger review-delete">Удалить</button>  
                                </div>
                                <div class="modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Предупреждение</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="close-modal">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Данное действие приведет к полному и безвозвратному удалению! Вы действительно хотите этого?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Подумать еще</button>
                                                {!! Form::model($comment, ['url' => route('comments.destroy', $comment->id), 'method' => 'DELETE']) !!}
                                                {!! Form::submit('Удалить отзыв полностью', ['class' => ' btn btn-danger'])!!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="edit-comment" class="collapse" aria-labelledby="edit-comment" data-parent="#accordionExample">
                                    {!! Form::model($comment, ['url' => route('comments.update', $comment->id), 'method' => 'PATCH', 'style' => 'display:flex;flex-direction:column;align-items:flex-end']) !!}
                                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 2]) !!}
                                        {!! Form::submit('Изменить', ['class' => 'btn btn-outline-success btn-sm', 'style' => 'width:150px;']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            
                        </div>
                    @endif
                @endif
            </div>
            @endforeach
            
            
        </div>
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