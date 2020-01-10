<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="display:flex;justify-content:space-between;background-color:#333;">
    <div style="display:flex;">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-home"></i>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="my-0 mr-md-auto font-weight-normal">
                {{ menu('main', 'partials.menus.main') }}
            </div>
        </div>
    </div>
    {!! Form::open(['url' => route('search'), 'class' => 'form-inline my-2 my-lg-0', 'method' => 'GET']) !!}
    {!! Form::submit("найти", ['class' => 'btn btn-outline-warning']) !!}
    {!! Form::search('query', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'поиск...', 'aria-label' => 'Search']) !!}
    {!! Form::close() !!}

    <div class="d-flex flex-column flex-md-row align-items-center font-weight-normal">

            @guest
                
                <div class="user-cart" style="display:flex;flex-direction:row;flex-wrap:nowrap;width:50px;justify-content:space-between;align-items:flex-end;">
                        <a href="{{ route('cart.index') }}">
                            <i class="fa fa-shopping-cart" style="color:#fff;font-size:24px;margin-right:10px"></i>
                        </a>
                            
                        @if (Auth::user())
                            @if (count(Cart::getContent()) > 0)
                                <div style="height:22px;color:#fff;text-align:center;width:20px;border-radius:50%;background-color:#ffa500">
                                    {{ \Cart::session(Auth::user()->id)->getTotalQuantity() }}
                                </div>
                            @endif
                        @else
                            @if (count(Cart::getContent()) > 0)
                                <div style="height:22px;color:#fff;text-align:center;width:20px;border-radius:50%;background-color:#ffa500">
                                    {{ Session::get('cart')::getTotalQuantity() }}
                                </div>
                            @endif
                        @endif
                            
                </div>
                
                <a class="p-2 text-light" href="{{ route('login') }}">{{ __('Войти') }}</a>
                
                @if (Route::has('register'))
                    <a class="p-2 text-light" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                @endif

                @else
                <div class="user-session" style="display:flex;flex-wrap:nowrap;justify-content:space-between;">
                    @if (stristr(Route::getCurrentRoute()->uri, 'article'))
                        <a class="p-2 text-light" href="{{ route('articles.myarticles') }}">Мои статьи</a>
                    @else
                        <div class="user-cart" style="display:flex;flex-direction:row;flex-wrap:nowrap;justify-content:space-between;align-items:center;">
                            <a href="{{ route('cart.index') }}">
                                <i class="fa fa-shopping-cart" style="color:#fff;font-size:24px;margin-right:10px"></i>
                            </a>
                            @if (Cart::session(Auth::user()->id)->getTotalQuantity() > 0)
                                <div style="height:22px;color:#fff;text-align:center;width:20px;border-radius:50%;background-color:#ffa500">
                                    {{ Cart::session(Auth::user()->id)->getTotalQuantity() }}
                                </div>
                            @endif
                            
                        </div>
                    @endif
                        <div class="text-light">
                            <div class="btn-group">
                                <button type="button" class="btn btn-link text-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                </button>
                                <div class="user-avatar-container">
                                    <img class="user-avatar" src="{{ asset('storage/' . Auth::user()->avatar) }}">
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @if (Auth::user() && Auth::user()->email === 'roman_planeta@mail.ru')
                                        <a href="/admin" class="p-2 text-dark">Администратор</a>
                                    @endif
                                    {!! Form::open(['url' => route('logout')]) !!}
                                        {!! Form::submit('Выйти', ['class' => 'btn btn-link', 'style' => 'color: red']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                            
                     </div>
                
                @endguest
        </div>
</nav>

