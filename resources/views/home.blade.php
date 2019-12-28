@extends('layouts.app')

@section('title', 'Ваш брэнд')

@include('partials.navbar')

@section('content')

    <div class="contianer-fluid wrapper">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="5000">
                    <img src="https://fora.kz/images/content/slides/skidka-na-tv-lg_5cb971931dc85.jpg" class="d-block w-100" height="500" alt="samsung ul55h5600">
                </div>
                <div class="carousel-item" data-interval="5000">
                    <img src="https://i.ytimg.com/vi/3HQldz4VJRg/maxresdefault.jpg" class="d-block w-100" height="500" alt="iphone 11 pro max">
                </div>
                <div class="carousel-item" data-interval="5000">
                    <img src="http://ps4n.ru/wp-content/uploads/2016/08/bitvaskidok-ps4.jpg" class="d-block w-100" height="500" alt="sony PS4 Pro 1TB">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    @include('partials.product_of_the_week')

    @include('partials.sale')

    @include('partials.blog')

    @include('partials.footer')
    
@endsection

