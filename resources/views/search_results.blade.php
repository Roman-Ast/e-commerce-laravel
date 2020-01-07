@extends('layouts.app')

@section('title', 'Результаты поиска')

@include('partials.navbar')

@component('components.breadcrumbs')
    <a href="/" class="text-dark">Главная</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span>Результаты поиска</span>
@endcomponent

@section('content')
    <div class="container">
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="search-results-container container">
            <h1>Результаты поиска</h1>
            <p class="search-results-count">
                Найдено {{  $products->total() }} результата для '{{ request()->input('query') }}'
            </p>
    
            @if ($products->count() > 0)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Модель</th>
                        <th>Описание</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <div style="display: flex;justify-content: center;align-items: center;height:80px;">
                                    <img style="max-height:100%;max-width:100%;height:auto;" src="{{ asset('storage/' . $product->image) }}">
                                </div>
                            </td>
                            <th>
                                <a href="{{ route('products.show', $product->id) }}">
                                    {{ $product->brand }} {{ $product->model }}
                                </a>
                            </th>
                            <td>{{ Str::limit($product->description, 150) }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @endif
            {{ $products->appends(request()->input())->links() }}

        </div> <!-- end search-results-container -->

    @include('partials.footer')

@endsection

