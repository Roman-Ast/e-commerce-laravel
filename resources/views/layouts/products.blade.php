@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->
@section('title', 'Салон бытовой техники') @section('cart') @show
@section('main')
<div class="containerForProducts">
    <div class="filter">
        <div class="filter-header">
            <img src="/images/filter.png" />
            <h5>Фильтр</h5>
        </div>
        <div class="checkedCheckboxes" style="display:none;">
            @if (isset($checkedCheckboxes)) @foreach($checkedCheckboxes as
            $checkedCheckbox)
            <span name="{{ $checkedCheckbox }}"></span>
            @endforeach @endif
        </div>
        {!! Form::Open(['url' => "showProducts/$productType", 'id' =>'accordion', 'class' => 'filter-accordion']) !!}
        <div class="card filter-item">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <div class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        Цена
                    </div>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="collapseCardWraper">
                    <div class="card-body">
                        {!! Form::label('customRange1', 'От') !!} 
                        {!! Form::range('', $from, ['class' => 'custom-range', 'id' => 'priceFromRange', 'min' => '0', 'max' => $to]) !!}
                        {!! Form::text('from', $from, ['class' => 'form-control', 'id' => 'priceFromValue', 'value' => $from, 'size' => '20']) !!}
                    </div>
                    <div class="card-body">
                        {!! Form::label('customRange1', 'До') !!} 
                        {!! Form::range('', $to, ['class' => 'custom-range', 'id' => 'priceToRange', 'min' => $from, 'max' => $to]) !!}
                        {!! Form::text('to', $to,['class' => 'form-control', 'id' => 'priceToValue','size' => '30']) !!}
                    </div>
                </div>
            </div>
        </div>
        @foreach($options as $option)
        <div class="card">
            <div class="card-header" id="heading{{ $option }}">
                <h5 class="mb-0">
                    <div class="btn" data-toggle="collapse" data-target="#collapse{{ $option }}" aria-expanded="true"
                        aria-controls="collapse{{ $option }}">
                        {{ $option }}
                    </div>
                </h5>
            </div>

            <div name="{{ $option }}" id="collapse{{ $option }}" class="collapse" aria-labelledby="heading{{ $option }}"
                data-parent="#accordion">
                <div class="card-body">
                    @foreach($optionsItems[$option] as $optionItem)
                    <div class="form-check">
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
            {!! Form::submit('Показать', ['class' => 'btn btn-light useFiltera', 'style' => 'color:#fff;align-self:center;background-color:#9f07a9;'])!!}
        </div>
    </div>

    <div class="products">
        <div class="sortContainer">
            <div style="width:3000px;text-decoration:underline;">
                {{ strtoupper($productType[0]).substr($productType, 1) }}
            </div>
            @if (isset($inputSort)) {!! Form::label('selectSort', 'Сортировать
            ') !!} {!! Form::select('sort', array('byDefault' => 'по умолчанию',
            'byIncreasePrise' => 'по возрастанию цены', 'byDescPrise' => 'по
            убыванию цены'), $inputSort, ['class' => 'form-control selectSort'])
            !!} @endif @if (!isset($inputSort)) {!! Form::label('selectSort',
            'Сортировать ') !!} {!! Form::select('sort', array('byDefault' =>
            'по умолчанию', 'byIncreasePrise' => 'по возрастанию цены',
            'byDescPrise' => 'по убыванию цены'), 'byDefault', ['class' =>
            'form-control selectSort']) !!} @endif
        </div>
        <div class="row">
            {!! Form::Close() !!} @foreach($products as $product)
            <div class="col-md-3">
                <div class="card mb-3 shadow-sm card-scale">
                    <img src="{{ explode(',', $product['image'])[0] }}"
                        style="max-height:150px;max-width:250px;align-self:center;" class="d-block" />
                    <div class="card-body">
                        <div class="card-brand" style="text-align:center;">
                            <h5>{{ strtoupper($product["brand"]) }}</h5>
                            <div class="card-model">
                                {{ $product["model"] }}
                            </div>
                        </div>
                        <div class="card-model" style="text-align:center;color:#9f07a9;">
                            <h4>
                                <b>{{ $product["price"] }}</b>
                            </h4>
                        </div>
                        <div class="reviews" style="display:flex;flex-wrap:nowrap;justify-content:space-between;">
                            @if (array_key_exists($product['id'], $reviewsCount) && array_key_exists($product['id'], $averageRating))
                                <small>Отзывы: {{ $reviewsCount[$product['id']] }}</small>
                                <small>Рэйтинг: {{ $averageRating[$product['id']] }}/5</small>
                            @endif

                            @if (!array_key_exists($product['id'], $reviewsCount) && !array_key_exists($product['id'], $averageRating))
                                <small>Отзывы: -</small>
                                <small>Рэйтинг: -</small>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <a style="text-decoration:none;" href="{{ $product['category'] }}/{{
                                        $product['id']
                                    }}">Подробнее...</a>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success">
                                В корзину
                            </button>
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
@endsection @section('submain-header') @endsection @section('submain')
@endsection