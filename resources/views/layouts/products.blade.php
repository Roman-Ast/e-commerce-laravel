@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->
@section('title', 'Салон бытовой техники')

@section('main')
<div class="containerForProducts">
    <div class="filter">
        <div class="filter-header">
            <img src="/images/filter.png">
            <h5>Фильтр</h5>
        </div>
        <form id="accordion" class="filter-accordion" action="/showProducts" method="POST" >

            <div class="card filter-item">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <div class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Цена
                </div>
                </h5>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                     <div class="collapseCardWraper">
                        <div class="card-body">
                            <label for="customRange1">От</label>
                            <input type="range" class="custom-range" id="priceFromRange" min="0" max="1000000" value="0">
                            <input class="form-control" type="text" id="priceFromValue">
                        </div>
                        <div class="card-body">
                                <label for="customRange1">До</label>
                                <input type="range" class="custom-range" id="priceToRange" min="0" max="1000000" value="100000">
                                <input class="form-control" type="text" id="priceToValue">
                        </div>
                    </div>
                </div>
            </div>
            
                @foreach($options as $option)
                <div class="card">
                    <div class="card-header" id="heading{{ $option }}">
                    <h5 class="mb-0">
                        <div class="btn" data-toggle="collapse" data-target="#collapse{{ $option }}" aria-expanded="true" aria-controls="collapse{{ $option }}">
                        {{ $option }}
                        </div>
                    </h5>
                    </div>

                    <div name="{{ $option }}" id="collapse{{ $option }}" class="collapse" aria-labelledby="heading{{ $option }}" data-parent="#accordion">
                    <div class="card-body">
                        @foreach($optionsItems[$option] as $optionItem)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="{{ $optionItem }}">
                            <label class="form-check-label" for="defaultCheck1">
                                {{ $optionItem }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    </div>
                </div>
               @endforeach
                
                <input type="submit" class="btn useFilter" style="background-color:#9f07a9;color:#fff" value="Показать" name="{{ $productType }}">
                
            </form>
        
        </div>
        
        <div class="products">
              
            <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card mb-3 shadow-sm card-scale">
                        <img src="{{ explode(',', $product['image'])[0] }}" style="max-height:150px;max-width:250px;align-self:center;" class="d-block">
                            <div class="card-body">
                                <div class="card-brand" style="text-align:center;">
                                    <h5>{{ strtoupper($product['brand']) }}</h5>
                                    <div class="card-model">{{ $product['model'] }}</div>
                                </div>
                                <div class="card-model" style="text-align:center;color:#9f07a9;"><h4><b>{{ $product['price'] }}</b></h4></div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary"><a style="text-decoration:none;" href="{{ $product['category'] }}/{{ $product['id'] }}">Подробнее...</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-success">В корзину</button>
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
@endsection

@section('submain-header')

@endsection

@section('submain')

@endsection