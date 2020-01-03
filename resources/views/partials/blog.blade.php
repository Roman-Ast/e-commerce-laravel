<div style="border-top: 1px solid #ddd;width:100%;background-color:#F8F9FA;margin-top:100px;">
    <div class="from-blog">
        <div class="from-blog-title">
            <div style="width:70%;margin-bottom:20px;margin-top:20px;">
                <h3 style="margin-bottom:40px;;display:flex;justify-content:center;">
                    <a href="{{ route('articles.index') }}" class="text-dark" style="font-weight:600;">Наш Блог</a>
                </h3>
                <p>
                    Равным образом укрепление и развитие структуры играет важную роль в формировании форм 
                    развития. Значимость этих проблем настолько очевидна, что рамки и место обучения кадров
                </p>
            </div>
        </div>
        @if (isset($articles))
        <div class="from-blog-articles">
        
            @foreach ($articles as $article)
                <div class="card card-scale" style="width: 18rem;">
                    @if (isset($article->image))
                    <img src="{{ asset("/storage/{$article->image}") }}" class="card-img-top" alt="{{ $article->title }}">
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title" style="font-family:'Roboto';font-weight:600;">{{ $article->title }}</h5>
                        <p class="card-text">
                            {{ Str::limit($article->body, 40) }}
                            <a href="/articles/{{ $article->id }}">далее</a>
                        </p>
                        <div style="font-family:'Roboto';display:flex;justify-content:flex-end;flex-wrap:nowrap;">
                                
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
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
