@extends('layouts.app')

@include('partials.navbar')

@section('title', 'О нас')

@section('content')
<div id="about-background">
    <div id="about-background3"></div>
    <div id="about-background2"></div>
</div>
<div class="container about">
    <div class="about-header">
        <h1>О компании</h1>
    </div>
    <div class="about-body">
        <p><b style="color:#FFB300">«Ваш брэнд»</b> - специализированная торговая сеть магазинов электроники и бытовой техники. Компания является одной из ведущих торговых сетей по продаже бытовой техники в Вашей стране, в которой работает более 1900 человек.</p>
        <p><b style="color:#FFB300">Наша миссия</b> - Вдохновленные «Ваш брэнд», мы раскрываем свой потенциал и делаем жизнь людей ярче, а быт комфортнее.</p>
        <p><b style="color:#FFB300">Наш девиз</b> - Качество во всем!</p>
    </div>
    <div class="statistics">
        <div class="statistics-item">
            <div class="statistics-item-header"><h2>18+</h2></div>
            <div class="statistics-item-body">
                <p>лет опыта и совершенствований</p>
            </div>
        </div>
        <div class="statistics-item">
            <div class="statistics-item-header"><h2>40+</h2></div>
            <div class="statistics-item-body">
                <p>магазинов в более 20 городах страны</p>
            </div>
        </div>
        <div class="statistics-item">
            <div class="statistics-item-header"><h2>100500+</h2></div>
            <div class="statistics-item-body">
                <p>товаров для дома и вашего офиса</p>
            </div>
        </div>
    </div>
</div>

@endsection

