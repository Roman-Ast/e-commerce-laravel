@extends('layouts.app')

@section('title', 'Ваш брэнд')

@include('partials.navbar')

@section('content')

    <div class="contianer-fluid wrapper">
        {{ menu('main-banners', 'partials.menus.main-banners') }}
    </div>
    
    @include('partials.sale')

    @include('partials.product_of_the_week')

    @include('partials.blog')

    @include('partials.footer')
    
@endsection

