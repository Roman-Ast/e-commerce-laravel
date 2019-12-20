@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->
@section('title', 'Салон бытовой техники') 


@section('main')
@if (Session::has('message'))

<div class="alert {{ Session::get('class') }}" style="align-text:center;">
    <div style="display:flex;justify-content:flex-end;" class="close-flash">
        &times;
    </div>
    {{ Session::get('message') }}
</div>

@endif 
<div class="imagesWrapper">
    <div class="card mb-3 productCard">
        <div class="row no-gutters">
            <div class="col-md-6">
                <div
                    id="carouselExampleIndicators"
                    class="carousel slide"
                    data-ride="carousel"
                    data-interval="false"
                >
                    <ol class="carousel-indicators">
                        <li
                            data-target="#carouselExampleIndicators"
                            data-slide-to="0"
                            class="active"
                        ></li>
                        <li
                            data-target="#carouselExampleIndicators"
                            data-slide-to="1"
                        ></li>
                        <li
                            data-target="#carouselExampleIndicators"
                            data-slide-to="2"
                        ></li>
                    </ol>
                    <div class="carousel-inner">
                        @foreach(explode(',', $product['image']) as $image)
                        <div class="carousel-item">
                            <img
                                src="{{ $image }}"
                                class="d-block w-100"
                                style="max-height:490px;max-width:400px;"
                                alt=""
                            />
                        </div>
                        @endforeach
                    </div>
                    <a
                        class="carousel-control-prev"
                        href="#carouselExampleIndicators"
                        role="button"
                        data-slide="prev"
                    >
                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="false"
                        ></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a
                        class="carousel-control-next"
                        href="#carouselExampleIndicators"
                        role="button"
                        data-slide="next"
                    >
                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="false"
                        ></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ strtoupper($product["brand"]) }}
                        {{ $product["model"] }}
                    </h3>
                    <div class="card-title">
                        @if ($product['new_price'] > 0)
                            <div class="card-price" style="display:flex;justify-content:flex-start;width:100%">
                                <h5 class="old-price text-muted">{{ $product['price'] }}</h5>
                                <h2 style="color:#9f07a9;margin-left:10px;"><b>{{ $product['new_price'] }}</b></h2>
                            </div>
                        @else
                            <div class="card-price" style="display:flex;justify-content:center;width:100%">
                                <h3 style="color:#9f07a9;font-family:'Roboto'"><b>{{ $product['price'] }}</b></h3>
                            </div>
                        @endif
                        </div>
                    <ul class="short-techs">
                        @foreach($productOptions as $option => $value)
                        <li>{{ $option }}: {{ $value }}</li>
                        @endforeach
                    </ul>
                    @if ($rating == 0)
                        <div class="rating" style="margin-bottom:5px;">
                            Средняя оценка: -/5
                        </div>
                    @else
                        <div class="rating" style="margin-bottom:5px;">
                            <div class="star-rating-nonDynamic">
                                @for ($i = 0; $i < round($rating); $i+=1)
                                    <img src="{{ asset('/images/star-12.png') }}">
                                @endfor
                                @for ($i = 0; $i < (5 - round($rating)); $i+=1)
                                    <img src="{{ asset('/images/star-12-inactive.png') }}">
                                @endfor
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['url' => route('cart.store')]) !!}
                        {!! Form::hidden('id', $product['id']) !!}
                        {!! Form::hidden('name', $product['model']) !!}
                        {!! Form::hidden('quantity', 1) !!}
                        {!! Form::hidden('price', $product['price']) !!}
                        {!! Form::submit('Добавить в корзину', ['class' => 'btn btn-outline-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="extraInfo">
        <ul class="list-group">
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
            >
                Cras justo odio
                <span class="badge badge-primary badge-pill">14</span>
            </li>
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
            >
                Dapibus ac facilisis in
                <span class="badge badge-primary badge-pill">2</span>
            </li>
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
            >
                Morbi leo risus
                <span class="badge badge-primary badge-pill">1</span>
            </li>
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
            >
                Cras justo odio
                <span class="badge badge-primary badge-pill">14</span>
            </li>
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
            >
                Dapibus ac facilisis in
                <span class="badge badge-primary badge-pill">2</span>
            </li>
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
            >
                Morbi leo risus
                <span class="badge badge-primary badge-pill">1</span>
            </li>
        </ul>
    </div>
</div>
@endsection @section('submain-header') @endsection @section('submain')
<div class="options">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a
                class="nav-link active"
                id="home-tab"
                data-toggle="tab"
                href="#home"
                role="tab"
                aria-controls="home"
                aria-selected="true"
                >Тех. характеристики</a
            >
        </li>
        <li class="nav-item">
            <a
                class="nav-link"
                id="contact-tab"
                data-toggle="tab"
                href="#contact"
                role="tab"
                aria-controls="contact"
                aria-selected="false"
                >Наличие товара</a
            >
        </li>
        <li class="nav-item">
            <a
                class="nav-link"
                id="reviews-tab"
                data-toggle="tab"
                href="#reviews"
                role="tab"
                aria-controls="reviews"
                aria-selected="false"
                >Отзывы
                <small class="text-muted">{{ count($reviews) }}</small></a
            >
        </li>
     
    </ul>
    <div class="tab-content" id="myTabContent">
        <div
            class="tab-pane fade show active"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
        >
            techs
        </div>
        <div
            class="tab-pane fade"
            id="reviews"
            role="tabpanel"
            aria-labelledby="reviews-tab"
        >
            <div class="add-review" style="">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne" style="display:flex;justify-content:flex-end;">
                            <h5 class="mb-0">
                            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Написать отзыв
                            </button>
                            </h5>
                        </div>
                            
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            @if (Auth::user())
                            <div class="card-body">
                                {!! Form::open(['url' => route('reviews.store'), 'style' => 'display: flex;flex-direction:column;'])!!}
                                {!! Form::hidden('productType', $product['category']) !!}
                                {!! Form::hidden('product_id', $product['id']) !!}
                                {!! Form::hidden('author_id', Auth::user()->id) !!}
                                {!! Form::hidden('author_name', Auth::user()->name) !!}
                                <div class="star-rating">
                                    <div style="display:flex;align-items:flex-end;margin-right:10px;">Оценить товар:</div>
                                    <div class="star-rating__wrap">
                                        <input class="star-rating__input fa" id="star-rating-5" type="radio" name="rating" value="5" title="Отлично!">
                                        <input class="star-rating__input fa" id="star-rating-4" type="radio" name="rating" value="4" title="Хорошо">
                                        <input class="star-rating__input fa" id="star-rating-3" type="radio" name="rating" value="3" title="Так себе">
                                        <input class="star-rating__input fa" id="star-rating-2" type="radio" name="rating" value="2" title="Плохо">
                                        <input class="star-rating__input fa" id="star-rating-1" type="radio" name="rating" value="1" title="Ужас!">
                                    </div>
                                </div> 
                                {!! Form::textarea('body', null, ['rows' => 4, 'cols' => 20]) !!}
                                {!! Form::submit('Добавить отзыв', ['class' => 'btn btn-primary', 'style' => 'width:200px;align-self:center;']) !!}
                                {!! Form::close() !!}
                            </div>
                            @endif
                            @if (!Auth::user())
                                <p> Чтобы добавить отзыв <a href="/login">войдите</a> или <a href="/register">зарегестрируйтесь.</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="reviews-show">
                @foreach($reviews as $review)
                    <div class="card" style="border-right:1px solid #fff;border-left:1px solid #fff;border-bottom:1px solid #fff;border-top:1px solid #fff;">
                        <div class="card-header" style="display:flex;justify-content:space-between;">
                        <div style="width:30%;display:flex;justify-content:flex-start;">  
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
                            
                            <div class="star-rating-nonDynamic">
                                @for ($i = 0; $i < round($review['rating']); $i+=1)
                                    <img src="{{ asset('/images/star-12.png') }}">
                                @endfor
                                @for ($i = 0; $i < (5 - round($review['rating'])); $i+=1)
                                    <img src="{{ asset('/images/star-12-inactive.png') }}">
                                @endfor
                            </div>
                            </div>
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
                                    {!! Form::model($review, ['url' => route('reviews.destroy', $review), 'method' =>  "DELETE"]) !!}
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
                                    
                                    {!! Form::model($review, ['url' => route('reviews.update', $review), 'method' => 'PATCH']) !!}
                                    <div class="star-rating">
                                        <div style="display:flex;align-items:flex-end;margin-right:10px;">Оценить товар:</div>
                                        <div class="star-rating__wrap">
                                            <input class="star-rating__input fa" id="star-rating-5" type="radio" name="rating" value="5" title="Отлично!">
                                            <input class="star-rating__input fa" id="star-rating-4" type="radio" name="rating" value="4" title="Хорошо">
                                            <input class="star-rating__input fa" id="star-rating-3" type="radio" name="rating" value="3" title="Так себе">
                                            <input class="star-rating__input fa" id="star-rating-2" type="radio" name="rating" value="2" title="Плохо">
                                            <input class="star-rating__input fa" id="star-rating-1" type="radio" name="rating" value="1" title="Ужас!">
                                        </div>
                                    </div>
                                    {!! Form::textarea('body', $review['body'], ['rows' => '6']) !!}
                                    {!! Form::hidden('product_id', $product['id']) !!}
                                    {!! Form::hidden('productType', $product['category']) !!}
                                    {!! Form::hidden('review_id', $review['id']) !!}
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
            <img src="/images/arrow-down.png" />
        </div>

        <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
        >
            availability
        </div>
    </div>
</div>

@endsection
