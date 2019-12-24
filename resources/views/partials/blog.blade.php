
<div class="news-header header">
    <img src="/images/news.png">
    <h4>Блог</h4>
</div>

<div class="news container">
    @if (isset($articles))
        @foreach ($articles as $article)
            <div class="card mb-3 card-scale" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset("/storage/{$article->image}") }}" class="w-100">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">
                                {{ Str::limit($article->body, 120) }}
                                <a href="/articles/{{ $article->id }}">далее</a>
                            </p>
                                    
                            <div style="font-family:'Roboto';display:flex;justify-content:space-between;">
                                @if (!empty($comments))
                                    @if (array_key_exists($article->id, $comments))
                                        Комментарии: {{ $comments[$article->id] }}
                                    @else
                                        Комментарии:  -
                                    @endif
                                @endif
                                    
                                    @if (array_key_exists($article->id, $likes))
                                        <div style="font-family:'Roboto';"><img src="/images/like.png"> {{ $likes[$article->id]}}</div>
                                    @endif
                                        
                                    </div>
                                    
                                    <p>
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
                        </div>
                    @endforeach
                @endif
            </div>
