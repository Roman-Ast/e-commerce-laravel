@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->
@section('title', 'Салон бытовой техники')
@if (Session::has('message'))
<div class="alert {{ Session::get('class') }}" style="align-text:center;">
    <div style="display:flex;justify-content:flex-end;" class="close-flash">&times;</div>
    {{ Session::get('message') }} 
</div>
 
@endif

@section('main')
    <div class="imagesWrapper">
        <div class="card mb-3 productCard">
            <div class="row no-gutters">
                <div class="col-md-6">
                
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  data-interval="false">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach(explode(',', $product['image']) as $image)
                            <div class="carousel-item">
                                <img src="{{ $image }}" class="d-block w-100" style="max-height:490px;max-width:400px;" alt="">
                            </div>
                            @endforeach
                            
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="false"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="false"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    
                </div>
                <div class="col-md-6">
                <div class="card-body">
                
                    <h3 class="card-title">{{ strtoupper($product['brand']) }} {{ $product['model'] }}</h3>
                    <h2 class="card-title" style="color:#9f07a9;">{{ $product['price'] }}</h2>
                    <ul class="short-techs">
                        @foreach($productOptions as $option => $value)
                        <li>{{ $option }}: {{ $value }}</li>
                        @endforeach
                    </ul>
                    @if ($rating == 0)
                    <div class="rating" style="margin-bottom:5px;">Средняя оценка: -/5</div>
                    @endif
                    @if ($rating != 0)
                    <div class="rating" style="margin-bottom:5px;">Средняя оценка: {{ $rating }}/5</div>
                    @endif
                    <button class="btn btn-warning" >Добавить в корзину</button>
                </div>
                </div>
            </div>
        </div>
        <div class="extraInfo">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Cras justo odio
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Dapibus ac facilisis in
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Morbi leo risus
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Cras justo odio
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Dapibus ac facilisis in
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Morbi leo risus
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('submain-header')
@endsection

@section('submain')
<div class="options">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Тех. характеристики</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Наличие товара</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Отзывы <small class="text-muted">{{ count($reviews) }}</small></a>
  </li>
  @if (Auth::user()) 
  <li class="nav-item">
    <a class="nav-link" id="add-review-tab" data-toggle="tab" href="#add-review" role="tab" aria-controls="add-review" aria-selected="false">Добавить отзыв</a>
  </li>
  @endif
  @if (!Auth::user())
  <li class="nav-item">
    <a class="nav-link" disabled data-toggle="tooltip" data-placement="left" title="Добавлять отзывы могут только зарегестрированные пользователи">Добавить отзыв</a>
  </li>
  @endif
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    techs
  </div>
  <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
    <div class="reviews-show">
        
            @foreach($reviews as $review)
            <div class="card" style="border-right:1px solid #fff;border-left:1px solid #fff;border-bottom:1px solid #fff;border-top:1px solid #fff;">
                <div class="card-header" style="display:flex;justify-content:space-between;">
                    @if (Auth::user())
                        @if (Auth::user()->name === $review['author_name'])
                        <div style="font-style:italic"><strong>{{ $review['author_name'] }}<small><sup> (Вы)</sup></small></strong></div>
                        @endif
                        @if (Auth::user()->name !== $review['author_name'])
                        <div style="font-style:italic"><strong>{{ $review['author_name'] }}</strong></div>
                        @endif
                    @endif
                    @if (!Auth::user())
                        <div style="font-style:italic"><strong>{{ $review['author_name'] }}</strong></div>
                    @endif
                    <small style="font-size:11px;">Добавлено: {{ $review['created_at'] }}</small>
                </div>
                @if (!Auth::user())
                <div class="card-body" style="background-color:rgba(215,215,215,.2);max-width:100%;border-bottom:1px solid #fff;">
                    <p class="card-text">{{ $review['body'] }}</p>
                </div>
                @endif
                @if (Auth::user())
                    @if ($review['author_name'] === Auth::user()->name)
                        <div class="card-body" style="background-color:rgba(215,215,215,.2);max-width:100%;border-bottom:1px solid #fff;">
                            <p class="card-text">{{ $review['body'] }}</p>
                        </div>
                        
                        <div style="display:flex;justify-content:flex-start;margin-top:5px;">
                            <button class="btn btn-link show-form-edit">Редактировать</button>
                            {!! Form::open(['url' => "/reviews/{$review['id']}/delete", 'method' =>  'PATCH']) !!}
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
                                        <p>Данное действие приведет к полному и безвозвратному удалению отзыва! Вы действительно хотите удалить отзыв?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Подумать еще</button>
                                        {!! Form::submit('Удалить отзыв полностью', ['class' => ' btn btn-danger'])!!}
                                    </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::hidden('product_id', $product['id']) !!}
                            {!! Form::hidden('productType', $product['category']) !!}
                            <button class="modal-show btn btn-sm btn-outline-danger review-delete">Удалить отзыв</button>
                            {!! Form::close() !!}
                        </div>
                        
                        <div class="form-review-edit" style="display:none;flex-direction:column;justify-content:center;">
                            {!! Form::open(['url' => "/reviews/{$review['id']}/update", 'method' =>  'PATCH']) !!}
                            <div class="add-product-rating" style="margin: 0;justify-content:flex-start;">
                                Поставить оценку:
                                <div class="form-check form-check-inline" style="margin-left:10px;">
                                <label class="form-check-label" for="inlineRadio1">1</label>
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value=1>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="inlineRadio2">2</label>
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value=2>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="inlineRadio3">3</label>
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value=3>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="inlineRadio4">4</label>
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio4" value=4>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="inlineRadio5">5</label>
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio5" value=5 checked>
                                </div>
                            </div>
                            {!! Form::textarea('body', $review['body'], ['rows' => '6']) !!}
                            {!! Form::hidden('product_id', $product['id']) !!}
                            {!! Form::hidden('productType', $product['category']) !!}
                            <div style="display:flex;justify-content:flex-start;">
                            {!! Form::submit('Обновить отзыв', ['class' => 'btn btn-sm btn-outline-primary'])!!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        
                    @endif
                    @if ($review['author_name'] !== Auth::user()->name)
                        <div class="card-body" style="background-color:rgba(215,215,215,.2);max-width:100%;border-bottom:1px solid #fff;">
                            <p class="card-text">{{ $review['body'] }}</p>
                        </div>
                    @endif
                @endif
            </div>
            @endforeach

    </div>
    
  </div>
  <div class="show-more-reviews">
        <img src="/images/arrow-down.png">
    </div>
  
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">availability</div>
  <div class="tab-pane fade" id="add-review" role="tabpanel" aria-labelledby="add-review-tab">
  
        @if (Auth::user())
        
        
        <div style="display:flex;flex-direction:column;align-items:center;">
            <div>
            {!! Form::open(['url' => url('reviews/create'), 'class' => 'row', 'style' => 'display:flex;flex-direction:column']) !!}

            <div class="add-product-rating">
                Поставить оценку:
                <div class="form-check form-check-inline" style="margin-left:10px;">
                 <label class="form-check-label" for="inlineRadio1">1</label>
                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value=1>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value=2>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value=3>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio4" value=4>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio5" value=5 checked>
                </div>
            </div>
            {!! Form::hidden('productType', $product['category']) !!}
            {!! Form::hidden('product_id', $product['id']) !!}
            {!! Form::hidden('author_id', Auth::user()->id) !!}
            {!! Form::hidden('author_name', Auth::user()->name) !!}
            {!! Form::textarea('body', null, ['rows' => '5', 'cols' => '100', 'style' => 'overflow: auto;']) !!}
            </div>
            <div style="display:flex;justify-content:flex-start;">
                {!! Form::submit('Оставить отзыв', ['class' => 'btn btn-primary'])!!}
                {!! Form::close()!!}
            </div>
            
        </div>
        
        @endif
  </div>
</div>
</div>

@endsection

<!--

-->



