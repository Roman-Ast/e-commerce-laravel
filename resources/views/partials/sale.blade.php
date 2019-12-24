
<div class="sales-header header">
    <img src="/images/sales.png">
    <h4>Акции</h4>
</div>

<div role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
            
                @foreach ($productsOnSale as $productOnSale)
                <div class="col-md-3">
                    <div class="card mb-3 shadow-sm card-scale">
                    <img style="max-height:150px;width:60%;align-self:center" src="{{ explode(',', $productOnSale->image)[0] }}">
                        <div class="card-body">
                            <div class="">{{ $productOnSale->category }}<h4>{{ $productOnSale->brand }}</h4></div>
                            <p class="card-text">{{ Str::limit($productOnSale->description, 55) }}</p>
                            <div class="card-price" >
                                <div class="old-price" style="color:#222;">{{ $productOnSale->price }}</div>
                                <h3 style="color:#9f07a9;">{{ $productOnSale->new_price }}</h3>
                            </div>
                            <div>
                                <small><i>Вы экономите</i></small>
                                <b>{{ $productOnSale->price - $productOnSale->new_price  }}!</b>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                {!! Form::open(['url' => route('products.show', $productOnSale), 'method' => 'GET']) !!}
                                    {!! Form::submit('Подробнее', ['class' => 'btn btn-sm btn-outline-primary']) !!}
                                {!! Form::close() !!}
                                
                                {!! Form::open(['url' => route('cart.store')]) !!}
                                    {!! Form::hidden('id', $productOnSale['id']) !!}
                                    {!! Form::hidden('name', $productOnSale['model']) !!}
                                    {!! Form::hidden('quantity', 1) !!}
                                    {!! Form::hidden('price', $productOnSale['price']) !!}
                                    {!! Form::submit('В корзину', ['class' => 'btn btn-sm btn-outline-success']) !!}
                                {!! Form::close() !!}
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
        </div> 
    </div>  
</div>
