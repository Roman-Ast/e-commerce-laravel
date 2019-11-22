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
        <form id="accordion" class="filter-accordion">
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
                <div class="card filter-item">
                    <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Брэнд
                    </div>
                    </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-check">
                            <input name="apple" class="form-check-input" type="checkbox" value="" id="appleCheckbox">
                            <label class="form-check-label" for="appleCheckbox">
                                Apple
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="samsung" class="form-check-input" type="checkbox" value="" id="samsungCheckbox">
                            <label class="form-check-label" for="samsungCheckbox">
                                Samsung
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="asus" class="form-check-input" type="checkbox" value="" id="asusCheckbox">
                            <label class="form-check-label" for="asusCheckbox">
                                Asus
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="oppo" class="form-check-input" type="checkbox" value="" id="oppoCheckbox">
                            <label class="form-check-label" for="oppoCheckbox">
                                Oppo
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="sony" class="form-check-input" type="checkbox" value="" id="sonyCheckbox">
                            <label class="form-check-label" for="sonyCheckbox">
                                Sony
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="huawei" class="form-check-input" type="checkbox" value="" id="huaweiCheckbox">
                            <label class="form-check-label" for="huaweiCheck2">
                                Huawei
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="meizu" class="form-check-input" type="checkbox" value="" id="meizuCheckbox">
                            <label class="form-check-label" for="meizuCheckbox">
                                Meizu
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card filter-item">
                    <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Цвет
                        </div>
                    </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-check">
                            <input name="черный" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Черный
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="Белый" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Белый
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="Красный" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Красный
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="Зеленый" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Зеленый
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="Желтый" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Желтый
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card filter-item">
                    <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Оперативная память
                        </div>
                    </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-check">
                            <input name="1Gb" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                1Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                2Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                3Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                4Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                8Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                12Gb
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card filter-item">
                    <div class="card-header" id="headingFive" width="100%">
                    <h5 class="mb-0">
                        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Встроенная память
                        </div>
                    </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                4Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                8gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                16Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                32Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                64Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                128Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                256Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                512Gb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                1Tb
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="useFilterBtnContainer">
                    <input type="submit" class="btn useFilter" style="background-color:#9f07a9;color:#fff" value="Показать">
                </div>
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary"><a style="text-decoration:none;" href="{{ $product['category'] }}/{{ $product['id'] }}">Подробнее...</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-success">В корзину</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach   

            <div class="links">
            {{ $products->links() }}
            </div> 
            </div>
                
        </div>
    </div>
@endsection

@section('submain-header')

@endsection

@section('submain')

@endsection