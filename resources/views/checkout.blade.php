@extends('layouts.app')

@if (Session::has('error_message'))

  <div class="alert alert-danger" style="align-text:center;">
    <div style="display:flex;justify-content:flex-end;" class="close-flash">
      &times;
    </div>
      {{ Session::get('error_message') }}
    </div>
            
  @endif 

@section('content')

@include('partials.navbar')

        <div class="container" style="display:flex;flex-direction:row-reverse;justify-content:space-between;">
            
          <div class="col-md-5">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Ваш заказ</span>
                <span class="badge badge-secondary badge-pill">{{ \Cart::session(Auth::user()->id)->getTotalQuantity() }}</span>
            </h4>
            <ul class="list-group mb-3">
              
              @foreach ($itemsInCart as $cartItem)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div style="display:flex;flex-direction:row;flex-wrap:nowrap;">
                      <img style="width:30%" src="{{ asset('storage/' . $cartItem['image']) }}" class="card-img" alt="{{ $cartItem['model'] }}" style="max-height:150px;"> 
                      <div style="width:80%;">
                        <h6 class="my-0">{{ $cartItem['model'] }}</h6>
                        <small class="text-muted">{{ $cartItem['ram'] }}, {{ $cartItem['capacity'] }}, {{ $cartItem['colour'] }}</small>
                        <div class="text-muted"><strong style="font-style:italic;">{{ $cartItem['price'] }}</strong></div>
                    </div>
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:center;justify-content:space-evenly">
                        <span class="text-muted">{{ $cartContent[$cartItem['id']]['quantity'] }}</span>
                    </div>
                </li>
              @endforeach
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (KZT)</span>
                <strong>{{ $cartTotalPrice }}</strong>
              </li>
            </ul>
      
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Promo code">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
              </div>
          </div>
       <div class="col-md-6">
            <h4 class="mb-3">Платежные реквизиты</h4>
            {!! Form::open(['url' => route('checkout.store'), 'id' => 'payment-form']) !!}
              <div class="row">
                <div class="col-md-6 mb-3">
                  {!! Form::label('firstName', 'Имя') !!}
                  {!! Form::text('firstName', null, ['class' => 'form-control', 'id' => 'firstName', 'required' => 'required']) !!}
                </div>
                <div class="col-md-6 mb-3">
                  {!! Form::label('lastName', 'Фамилия') !!}
                  {!! Form::text('lastName', null, ['class' => 'form-control', 'id' => 'lastName', 'required' => 'required']) !!}
                </div>
              </div>
 
              <div class="mb-3">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'required' => 'required', 'placeholder' => 'you@example.com']) !!}
              </div>
      
              <div class="row">
                  <div class="col-md-9 mb-3">
                      {!! Form::label('address', 'Адрес') !!}
                      {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'required' => 'required', 'placeholder' => 'ул. Победы, 25']) !!}
                  </div>
                  <div class="col-md-3 mb-3">
                      {!! Form::label('apartments', 'Квартира') !!}
                      {!! Form::text('apartments', null, ['class' => 'form-control', 'id' => 'apartments', 'required' => 'required']) !!}
                  </div>
              </div>
      
              <div class="row">
                <div class="col-md-6 mb-3">
                  {!! Form::label('country', 'Страна') !!}
                  {!! Form::select('country', array(
                    'Kazachstan' => 'Казахстан', 
                    'Russia' => 'Россия', 
                    'Belarus' => 'Беларусь'), 
                    'Казахстан', ['class' => 'custom-select d-block w-100', 'id' => 'country'])
                  !!} 
                </div>
                <div class="col-md-6 mb-3">
                  {!! Form::label('postal', 'Почтовый индекс') !!}
                  {!! Form::text('postal', null, ['class' => 'form-control', 'id' => 'postal', 'required' => 'required']) !!}
                </div>
                <div class="col-md-6 mb-3">
                    {!! Form::label('city', 'Город') !!}
                    {!! Form::select('city', array(
                      'Astana' => 'Астана', 
                      'Almaty' => 'Алматы', 
                      'Karaganda' => 'Караганда'), 
                      'Астана', ['class' => 'custom-select d-block w-100', 'id' => 'city'])
                    !!}
                </div>
                      
                <div class="col-md-6 mb-3">
                    {!! Form::label('tel', 'Телефон') !!}
                    {!! Form::tel('tel', null, ['class' => 'form-control', 'id' => 'tel', 'required' => 'required']) !!}
                </div>
              </div>
              
              
              <hr class="mb-4">
              
              <h4 class="mb-3">Детали оплаты</h4>
      
                <div class="form-group">
                    {!! Form::label('nameOnCard', 'Имя на карте') !!}
                    {!! Form::text('nameOnCard', null, ['class' => 'form-control', 'id' => 'nameOnCard', 'required' => 'required']) !!}
                </div>

              <div class="form-group">
                    <label for="card-element">Платежная карта</label>
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
              </div>
              
              <hr class="mb-4">
              {!! Form::submit('Оплатить', ['class' => 'btn btn-outline-success btn-lg btn-block', 'id' => 'complete-order']) !!}
              {!! Form::close() !!}
          </div>
        </div>
        </div>
        <div class="spacer"></div>
        @include('partials.footer')
@endsection
