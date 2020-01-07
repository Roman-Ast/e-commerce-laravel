@extends('layouts.app')


@section('content')

    @include('partials.navbar')
  
    @component('components.breadcrumbs')
        <a href="/" class="text-dark">Главная</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Корзина</span>
    @endcomponent
        
    @if (Session::has('message'))

    <div class="alert {{ Session::get('class') }}" style="align-text:center;">
        <div style="display:flex;justify-content:flex-end;" class="close-flash">
            &times;
        </div>
        {{ Session::get('message') }}
    </div>
    
    @endif 
    <div style="font-style:italic;margin-bottom:10px;width:60%;margin:0 auto;">
        <strong>
        @if (count($itemsInCart) === 1)
            {{ count($itemsInCart) }} позиция в корзине
        @endif
        @if (count($itemsInCart) < 5 && count($itemsInCart) >= 2)
            {{ count($itemsInCart) }} позиции в корзине
        @endif
        @if (count($itemsInCart) > 5)
            {{ count($itemsInCart) }} позиций в корзине
        @endif
        </strong>
    </div>
    
    @if (count($itemsInCart) > 0)
    <div class="cartItemsContainer" style="">
        
        @foreach ($itemsInCart as $cartItem)
            
        <div class="cartItemContainer" >
            <div class="" style="width:100%;padding-top:10px;">
                <div class="cartItem">
                    <div class="col-md-2">
                        <img src="{{ asset('storage/' . $cartItem['image']) }}" class="card-img" alt="{{ $cartItem['model'] }}" style="max-height:150px;">
                    </div>
                    <div class="cart-item-description">
                        <h4 class="card-title"><a href="{{ route("products.show", $cartItem['id']) }}">{{ $cartItem['model'] }}</a></h4>
                        <div class="card-text text-muted">{{ $cartItem['ram'] }}, {{ $cartItem['capacity'] }}, {{ $cartItem['colour'] }}</div>
                        <div class="card-text text-muted itemPrice"><strong>{{ $cartItem['price'] }}</strong></div>
                    </div>
                    <div class="cartItemControl">
                        <div class ="cartItemControl-buttons">
                            {!! Form::open(['url' => route('cart.destroy', $cartItem['id']), 'method' => 'DELETE']) !!}
                                {!! Form::submit('Удалить из корзины', ['class' => 'btn btn-sm btn-link']) !!}
                            {!! Form::close() !!}
                            {!! Form::model($cartItem, ['url' => route('wishlist.store', $cartItem)] ) !!}
                                
                                {!! Form::submit('Добавить в желаемое', ['class' => 'btn btn-sm btn-link']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class ="cartItemControl-totals">
                            <div style="border:display:flex;justify-content:center;margin-top:10px;margin-left:10px;">
                                {!! Form::model($cartItem, ['url' => route('cart.update', $cartItem['id']), 'method' => 'PATCH']) !!}
                                    {!! Form::hidden('id', $cartItem['id']) !!}
                                    <input type="number" style="width:40px" value="{{ $cartContent[$cartItem['id']]['quantity'] }}" min="1" class="quantity" name="quantity">
                                    {!! Form::submit('обновить', ['id' => 'updateCartItemQuantity']) !!}
                                {!! Form::close() !!}
                            </div>
                            <div class="cart-item-total">
                                <div class="cart-item-sum" style="font-size:17px;font-weight:600;">{{ $cartItem['price'] * $cartContent[$cartItem['id']]['quantity']}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

        <div class="cart-total">
            {!! Form::open(['url' => route('cart.clear'), 'method' => 'GET']) !!}
            {!! Form::submit('Очистить корзину', ['class' => 'btn btn-sm btn-link', 'style' => 'font-size:15px;']) !!}
            {!! Form::close() !!}
            <div class="cart-sum">{{ $cartTotalPrice }}</div>
        </div>
        
        @else
        <div class="cartItemsContainer" >
            <h5>Корзина пуста</h5>
        </div>
        @endif
        
    </div>
    


    @if (Session::has('wishList') && count($wishList) > 0)
    <div style="font-style:italic;margin-bottom:10px;width:60%;margin:0 auto;">
        <strong>
        @if (count($wishList) === 1)
            {{ count($wishList) }} позиция в списке желаемого
        @endif
        @if (count($wishList) < 5 && count($wishList) >= 2)
            {{ count($wishList) }} позиции в списке желаемого
        @endif
        @if (count($wishList) > 5)
            {{ count($wishList) }} позиций в списке желаемого
        @endif
        </strong>
    </div>
    
    <div class="cartItemsContainer" >
        
        @foreach ($wishList as $wishListItem)
            
        <div class="cartItemContainer" >
            <div class="" style="width:100%;padding-top:10px;">
                <div class="cartItem">
                    <div class="col-md-2">
                        <img src="{{ asset('storage/' . $cartItem['image']) }}" class="card-img" alt="{{ $wishListItem['model'] }}" style="max-height:150px;">
                    </div>
                    <div class="cart-item-description">
                        <h4 class="card-title"><a href="{{ route("products.show", $wishListItem['id']) }}">{{ $wishListItem['model'] }}</a></h4>
                        <div class="card-text text-muted">{{ $wishListItem['ram'] }}, {{ $wishListItem['capacity'] }}, {{ $wishListItem['colour'] }}</div>
                    </div>
                    <div class="cartItemControl">
                        <div class ="cartItemControl-buttons">
                            {!! Form::open(['url' => route('wishlist.destroy', $wishListItem['id']), 'method' => 'DELETE']) !!}
                                {!! Form::submit('Удалить из списка желаемых', ['class' => 'btn btn-sm btn-link']) !!}
                            {!! Form::close() !!}
                            {!! Form::open(['url' => route('cart.store')]) !!}
                                {!! Form::hidden('id', $wishListItem['id']) !!}
                                {!! Form::hidden('name', $wishListItem['model']) !!}
                                {!! Form::hidden('quantity', 1) !!}
                                {!! Form::hidden('price', $wishListItem['price']) !!}
                                {!! Form::submit('Добавить в корзину', ['class' => 'btn btn-sm btn-link']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class ="cartItemControl-totals">
                            <div style="border:display:flex;justify-content:center;margin-top:10px;margin-left:10px;"></div>
                            <div class="cart-item-total">
                                <div class="cart-item-price" style="font-size:14px;font-style:italic;text-align:right"></div>
                                <div class="cart-item-sum" style="font-size:17px;font-weight:600;">{{ $wishListItem['price'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

        @else
        <div class="cartItemsContainer" >
            <h5>Список желаемого пуст</h5>
        </div>
        
        @endif
    </div>
    
    <div class="goToCheckout">
        @if (Auth::user())
            @if (\Cart::session(Auth::user()->id)->getTotalQuantity() > 0)
                <div>
                    <a class="btn btn-outline-secondary" href="{{ $refererUrl ?? '/products' }}">Продолжить покупки</a>
                </div>
            @else
                <div>
                    <a class="btn btn-outline-secondary" href="{{ route('products.index') }}">Продолжить покупки</a>
                </div>
            @endif
        @else
            @if (\Session('cart')::getTotalQuantity() > 0)
                <div>
                    <a class="btn btn-outline-secondary" href="{{ $refererUrl ?? '/products' }}">Продолжить покупки</a>
                </div>
            @else
                <div>
                    <a class="btn btn-outline-secondary" href="{{ route('products.index') }}">Продолжить покупки</a>
                </div>
            @endif
        @endif
        @if (Auth::user())
            @if (\Cart::session(Auth::user()->id)->getTotalQuantity() > 0)
            {!! Form::open(['url' => route('checkout.index'), 'method' => 'GET']) !!}
                {!! Form::submit('Перейти к оплате', ['class' => 'btn btn-outline-success']) !!}
            {!! Form::close() !!} 
            @else
            {!! Form::open(['url' => route('checkout.index'), 'method' => 'GET']) !!}
                {!! Form::submit('Перейти к оплате', ['class' => 'btn btn-outline-success', 'disabled' =>true]) !!}
            {!! Form::close() !!} 
            @endif
        @endif
        
    </div>

    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    @include('partials.footer')

@endsection