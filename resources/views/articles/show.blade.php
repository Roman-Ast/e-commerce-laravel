@extends('layouts.app')

@section('title', $article->title )

@section('content')

    @include('partials.navbar')

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
                <div class="" style="border:1px solid #ccc;border-radius:5px;width:100%;max-height:400px;display:flex;justify-content:center;">
                    <img src="{{ asset("/storage/{$article->image}") }}" class="w-100">
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
            <div style="height:30px;">
                {!! Form::submit('Оставить комментарий', ['id' => 'send-comment', 'class' => 'btn btn-sm btn-outline-success', 'style' => 'display:none;width:170px;']) !!}
                <button class="btn btn-sm btn-outline-secondary" id="cancel-comment" style="display:none;">Отмена</button>
            </div>
            {!! Form::close() !!}
        @endif

        <div class="comments-display" >
                
            @foreach ($comments as $comment)
            <div class="comment-container" style="width:60%;margin-bottom:10px;">
                <div class="comment-title" style="">
                    <div>
                        {{ $comment->author_name }}
                        <small class="text-muted" style="margin-left:5px;">{{ $comment->updated_at }}</small>
                    </div>
                @if (Auth::user())    
                    @if (Auth::user()->name === $comment->author_name)
                        <div class="comment-menu-show">
                            <img src="/images/dots-menu.png">
                        </div>
                        <div class="comment-menu">
                            <button class="btn btn-sm btn-link btn-link refactor-form-show">
                                Редактировать
                            </button>
                            <button class="btn btn-sm btn-link btn-link comment-delete">
                                Удалить
                            </button>
                        </div>
                        <div class="modal" id="form-comment-delete">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Осторожно!</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="form-comment-delete-close">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        Вы действительно хотите удалить комментарий?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-sm btn-secondary form-comment-delete-close">Подумать еще</button>
                                        {!! Form::model($comment, ['url' => route('comments.destroy', $comment->id), 'method' => 'DELETE', 'style' => 'display:flex;align-items:center;']) !!}
                                        {!! Form::submit('Подтвердить', ['class' => ' btn btn-danger btn-sm'])!!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                
                </div>
                <div style="min-height:30px;width:100%;display:flex;align-items:flex-end;">
                    {{ $comment->body }}
                </div>
                <div style="display:flex;margin-top:10px;">
                    <!--<div class="comment-like" style="display:flex;">
                        <img src="/images/thums-up-inactive.png" class="thumbsUp">
                        <div class="text-muted" style="justify-content:center;display:flex;width:20px;"></div>
                    </div>-->
                    @if (Auth::user())
                        <div class="comment-reply-form-show" style="font-family:'Roboto'">ответить</div>
                    @endif
                </div>
                
                @if (Auth::user())
                    @if (Auth::user()->name === $comment->author_name)
                    <div class="edit-comment" style="display:none;">
                        {!! Form::model($comment, ['url' => route('comments.update', $comment->id), 'method' => 'PATCH', 'style' => 'display:flex;flex-direction:column;align-items:flex-end']) !!}
                            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 2]) !!}
                            {!! Form::submit('Изменить', ['class' => 'btn btn-outline-success btn-sm', 'style' => 'width:150px;']) !!}
                        {!! Form::close() !!}
                    </div>
                    @endif
                @endif
                <div style="height:70px;display:none;" class="comment-reply-form">
                    {!! Form::open(['url' => route('subcomments.store'), 'style' => 'display:flex;flex-direction:column;align-items:flex-end;']) !!}
                    {!! Form::hidden('comment_id', $comment->id) !!}
                    {!! Form::hidden('author_id', Auth::user()->id ?? '') !!}
                    {!! Form::hidden('author_name', Auth::user()->name ?? '') !!}
                    {!! Form::textarea('sub-comment-body', null, ['class' => 'sub-comment-body', 'rows' => 1, 'placeholder' => 'напишите ответ', 'style' => 'border-right:0;border-left:0;border-top:0;border:bottom:1px solid #eee;width:100%;']) !!}
                    <div>
                        {!! Form::submit('ответить', ['class' => 'text-muted sub-comment-send btn btn-outline-success btn-sm' ]) !!}
                        <button class="sub-comment-cancel btn btn-outline-secondary btn-sm">отмена</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div>

                    @if (!empty($subComments[$comment->id]))
                        <div class="comment-replies-show" class="text-muted" style="font-family:'Roboto'">
                          Показать {{ count($subComments[$comment->id]) }} ответов
                        </div>
                    @endif

                    <div class="comment-replies" style="display:none;width:100%;">
                        <ul style="list-style-type:none;">
                            @foreach ($subComments[$comment->id] as $subComment)
                                
                                <li>
                                    <div style="display:flex;justify-content:space-between;position:relative;">
                                        <div>
                                            <b><i>{{ $subComment['author_name'] }}</i></b>
                                            <small class="text-muted">{{ $subComment['updated_at'] }}</small>
                                        </div>
                                        @if ( Auth::user())
                                            
                                        @if ($subComment['author_name'] === Auth::user()->name)
                                        <div class="comment-menu-show">
                                            <img src="/images/dots-menu.png">
                                        </div>
                                        <div class="comment-menu">
                                            <button class="btn btn-sm btn-link btn-link refactor-form-show">
                                                    Редактировать
                                            </button>
                                            <button class="btn btn-sm btn-link btn-link subcomment-delete">
                                                    Удалить
                                            </button>
                                            <div class="modal form-subcomment-delete">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="exampleModalLongTitle">Осторожно!</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="form-subcomment-delete-close">&times;</span>
                                                              </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Вы действительно хотите удалить ответ?
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-sm btn-secondary form-subcomment-delete-close">Подумать еще</button>
                                                                {!! Form::model($subComment, ['url' => route('subcomments.destroy', $subComment['id']), 'method' => 'DELETE', 'style' => 'display:flex;align-items:center;']) !!}
                                                                {!! Form::hidden('article_id', $article->id) !!}
                                                                {!! Form::hidden('subcomment_id', $subComment['id']) !!}
                                                                {!! Form::submit('Подтвердить', ['class' => ' btn btn-danger btn-sm'])!!}
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                    <div style="font-family:'Roboto'">{{ $subComment['body'] }}</div>
                                    <div class="edit-comment" style="display:none;">
                                        {!! Form::model($subComment, ['url' => route('subcomments.update', $subComment['id']), 'method' => 'PATCH', 'style' => 'display:flex;flex-direction:column;align-items:flex-end']) !!}
                                            {!! Form::hidden('article_id', $article->id) !!}
                                            {!! Form::hidden('subcomment_id', $subComment['id']) !!}
                                            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 1]) !!}
                                            {!! Form::submit('Изменить', ['class' => 'btn btn-outline-success btn-sm', 'style' => 'width:150px;']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            
            
        </div>
    </div>
    </div>
    <div style="height:100px;"></div>
    @include('partials.footer')
@endsection