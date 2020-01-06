@extends('layouts.app')

@section('title', 'Ваш брэнд')

@include('partials.navbar')

@section('content')

    <div class="contianer-fluid wrapper">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($i = 0; $i < count($mainBannerImages); $i++)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="active"></li>
                @endfor
            </ol>
            <div class="carousel-inner">
                @foreach ($mainBannerImages as $mainBannerImages_item)
                    <div class="carousel-item " data-interval="5000">
                        <img src="{{ asset('/storage/'.$mainBannerImages_item->image) }}" class="d-block w-100" height="600">
                    </div>
                @endforeach
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
    
    @include('partials.sale')

    @include('partials.reviews')

    @include('partials.blog')

    @include('partials.footer')
    
@endsection

