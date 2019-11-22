@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->
@section('title', 'Салон бытовой техники')

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
                            <div class="carousel-item active">
                                <img src="{{ explode(',', $product['image'])[0] }}" class="d-block w-100 h-100" style="max-height:490px;max-width:500px;" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ explode(',', $product['image'])[1] }}" class="d-block w-100" style="max-height:490px;max-width:500px;" alt="">
                            </div>
                            <div class="carousel-item">
                               <img src="{{ explode(',', $product['image'])[2] }}" class="d-block w-100"  style="max-height:490px;max-width:500px;" alt="">
                            </div>
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
                        <li>Цвет: {{ $product['colour'] }}</li>
                        <li>Оперативная память: {{ $product['ram'] }}</li>
                        <li>Встроенная память: {{ $product['capacity'] }}</li>
                        <li>Краткое описание: <br><p style="margin-left:10px;">{{ $product['description'] }}</p></li>
                    </ul>
                    <button class="btn btn-warning">Добавить в корзину</button>
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
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Отзывы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Наличие товара</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      ...
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
</div>
@endsection



