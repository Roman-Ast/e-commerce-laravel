@extends('layouts.app')

@section('title', 'Магазин')

@include('partials.navbar')

@component('components.breadcrumbs')
    <a href="/" class="text-dark">Главная</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span>Магазин</span>
@endcomponent

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
@if (Session::has('message'))

<div class="alert {{ Session::get('class') }}" style="align-text:center;margin-top:-15px;">
    <div style="display:flex;justify-content:flex-end;" class="close-flash">
        &times;
    </div>
    {{ Session::get('message') }}
</div>

@endif 
<div class="containerForProducts">
    
    <div class="filter">
        <div class="filter-header">
            <img src="/images/filter.png" />
            <h5>Фильтр</h5>
        </div>
        <div class="checkedCheckboxes" style="display:none;">
            @if (isset($checkedCheckboxes))
                @foreach($checkedCheckboxes as $checkedCheckbox)
                    <span name="{{ $checkedCheckbox }}"></span>
                @endforeach
            @endif
        </div>
        {!! Form::open(['url' => route('products.filter'), 'id' =>'accordion', 'class' => 'filter-accordion']) !!}
        <div class="card">
            <div class="card-header" id="headingOne">
                
                <div data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    Цена
                </div>
                
            </div>

            <div >
                <div class="collapseCardWraper">
                    <div class="card-body">
                        {!! Form::label('customRange1', 'От') !!} 
                        {!! Form::range('', $from, ['class' => 'custom-range', 'id' => 'priceFromRange', 'min' => '0', 'max' => $to]) !!}
                        {!! Form::text('from', $from, ['class' => 'form-control', 'id' => 'priceFromValue', 'value' => $from, 'size' => '25']) !!}
                    </div>
                    <div class="card-body">
                        {!! Form::label('customRange1', 'До') !!} 
                        @if (isset($maxInSelectedCategories))
                        {!! Form::range('', $to, ['class' => 'custom-range', 'id' => 'priceToRange', 'min' => $from, 'max' => $maxInSelectedCategories]) !!}
                        @else
                        {!! Form::range('', $to, ['class' => 'custom-range', 'id' => 'priceToRange', 'min' => $from, 'max' => $to]) !!}
                        @endif
                        {!! Form::text('to', $to,['class' => 'form-control', 'id' => 'priceToValue','size' => '35']) !!}
                    </div>
                </div>
            </div>
        </div>
        @foreach($options as $option)
        <div class="card" style="border:none">
            <div class="filter-item" id="heading{{ $option }}">
                
                <div data-toggle="collapse" data-target="#collapse{{ $option }}" aria-expanded="true"
                    aria-controls="collapse{{ $option }}" class="filter-item-option">
                    @if (array_key_exists($option, $optionsRussian))
                        {{ $optionsRussian[$option] }}
                    @endif
                </div>
                    @if (array_key_exists($option, $optionsRussian))
                        <div style="display:flex;align-self:center;justify-self:flex-end;">
                            <img src="{{ asset('images/triangle-right-16.png') }}">
                        </div>
                    @endif
                
                
            </div>

            <div name="{{ $option }}" id="collapse{{ $option }}" class="collapse" aria-labelledby="heading{{ $option }}"
                data-parent="#accordion">
                <div class="card-body">
                    @foreach($optionsItems[$option] as $optionItem)
                    <div class="form-check" style="border-left:1px solid #ccc;">
                        {!! Form::checkbox($option .':'. $optionItem, null,['class' => 'filterCheckbox']) !!}
                        {!! Form::label($optionItem, $optionItem) !!}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

        <div class="useFilterBtnContainer" tabindex="-1" role="dialog">
            <button type="button" class="close" data-dismiss="useFilterBtnContainer" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {!! Form::submit('Применить', ['class' => 'btn btn-warning text-dark', 'style' => 'color:#fff;align-self:center;'])!!}
        </div>
    </div>

    <div class="products">
        <div style="display:flex;justify-content:flex-end;">
                <div class="sortContainer"> 
                        @if (isset($inputSort)) 
                        {!! Form::label('selectSort', 'Сортировать:', ['style' => 'margin-right:10px;']) !!} 
                        {!! Form::select('sort', array(
                            'byDefault' => 'по умолчанию',
                            'byIncreasePrise' => 'по возрастанию цены', 
                            'byDescPrise' => 'по убыванию цены'), 
                            $inputSort, ['class' => 'form-control selectSort'])
                        !!} 
                        @else
                        {!! Form::label('selectSort','Сортировать ') !!} 
                        {!! Form::select('sort', array(
                            'byDefault' => 'по умолчанию',
                            'byIncreasePrise' => 'по возрастанию цены',
                            'byDescPrise' => 'по убыванию цены'), 
                            'byDefault', ['class' =>'form-control selectSort']) !!} 
                        @endif
                    </div>
        </div>
        <div class="row">
            {!! Form::Close() !!} 
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="card mb-3 shadow-sm card-scale">
                    <img src="{{ asset('/storage/' . $product['image'])}} "style="max-height:150px;max-width:250px;align-self:center;" class="d-block" />
                    <div class="card-body">
                        <div class="card-brand" style="text-align:center;">
                            <h5>{{ strtoupper($product["brand"]) }}</h5>
                            <div class="card-model">
                                {{ $product["model"] }}
                            </div>
                        </div>
                        <div class="card-model" style="text-align:center;">

                            @if ($product['new_price'] > 0)
                                <div class="card-price" style="display:flex;justify-content:center;width:100%">
                                    <div class="old-price text-muted">{{ $product['price'] }}</div>
                                    <h3 style="color:#9f07a9;font-family:'Roboto'"><b>{{ $product['new_price'] }}</b></h3>
                                </div>
                            @else
                                <div class="card-price" style="display:flex;justify-content:center;width:100%">
                                    <h3 style="color:#9f07a9;font-family:'Roboto'"><b>{{ $product['price'] }}</b></h3>
                                </div>
                            @endif
                            
                        </div>
                        <div class="reviews" style="display:flex;flex-wrap:nowrap;justify-content:space-between;">
                            @if (array_key_exists($product['id'], $reviewsCount) && array_key_exists($product['id'], $averageRating))
                                <small>Отзывы: {{ $reviewsCount[$product['id']] }}</small>
                                <small>
                                    @for ($i = 0; $i < round($averageRating[$product['id']]); $i+=1)
                                        <img src="{{ asset('/images/star-12.png') }}">
                                    @endfor
                                    @for ($i = 0; $i < 5 - $averageRating[$product['id']]; $i+=1)
                                        <img src="{{ asset('/images/star-12-inactive.png') }}">
                                    @endfor
                                </small>
                            @endif

                            @if (!array_key_exists($product['id'], $reviewsCount) && !array_key_exists($product['id'], $averageRating))
                                <small>Отзывы: -</small>
                                <small>Рэйтинг: -</small>
                            @endif
                        </div>
                        <div style="display:flex;flex-wrap:nowrap;justify-content:space-between;">
                            {!! Form::open(['url' => route('products.show', $product), 'method' => 'GET']) !!}
                                {!! Form::submit('Подробнее', ['class' => 'btn btn-sm btn-outline-primary']) !!}
                            {!! Form::close() !!}
                            
                            {!! Form::open(['url' => route('cart.store')]) !!}
                                {!! Form::hidden('id', $product['id']) !!}
                                {!! Form::hidden('name', $product['model']) !!}
                                {!! Form::hidden('quantity', 1) !!}
                                {!! Form::hidden('price', $product['price']) !!}
                                {!! Form::submit('В корзину', ['class' => 'btn btn-sm btn-outline-success']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="links" style="display:flex;align-self:baseline">
            {{ $products->links() }}
        </div>
    </div>
</div>

@include('partials.footer')
@endsection