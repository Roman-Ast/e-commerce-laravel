<div class="from-blog-title" style="background:#f8f9fa">
    <div style="width:70%;margin-top:20px;">
        <h3 style="margin-bottom:40px;display:flex;justify-content:center;">
            <a href="{{ route('articles.index') }}" class="text-dark" style="font-weight:600;">Скидки</a>
        </h3>
        <p style="text-align:center">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab ipsum cumque dicta debitis suscipit? Fugiat rem quae totam saepe placeat unde magnam praesentium ex eveniet, inventore ducimus ad at odit!
        </p>
    </div>
</div>
<div>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
            
                @foreach ($productsOnSale as $productOnSale)
                <div class="col-md-3">
                    <div class="card mb-3 shadow-sm card-scale">
                    <img style="max-height:150px;width:60%;align-self:center" src="{{ asset('/storage/' . $productOnSale->image) }}">
                        <div class="card-body">
                            <div class="" >
                                <div>
                                    <h6 style="font-weight:600;">{{ $productOnSale->brand }}</h6>
                                    <h6 style="font-weight:600;">{{ $productOnSale->model }}</h6>
                                </div>
                            </div>
                            <p class="card-text" style="font-size:11px;">{{ Str::limit($productOnSale->description, 65) }}</p>
                            <div class="card-price">
                                <div class="old-price" style="color:#222;margin-right:10px">{{ $productOnSale->price }}</div>
                                <h4 style="font-weight:600;">{{ $productOnSale->new_price }}</h4>
                            </div>
                            {{--<div>
                                <small><i>Вы экономите</i></small>
                                <b>{{ $productOnSale->price - $productOnSale->new_price  }}!</b>
                            </div>--}}
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group" style="margin-top:10px;">
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
