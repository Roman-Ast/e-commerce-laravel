<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="display:flex;justify-content:space-between;background-color: #9F07A9;">
    <div style="display:flex;">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('/images/home-page.png') }}">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="my-0 mr-md-auto font-weight-normal">
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-light" href="{{ route('products.index')}}">Магазин</a>
                    <a class="p-2 text-light" href="{{ route('articles.index')}}">Блог</a>
                    <a class="p-2 text-light" href="#">Новости</a>
                    <a class="p-2 text-light" href="{{ route('about')}}">О нас</a>
                </nav>
            </div>
        </div>
    </div>
    

    <form class="form-inline my-2 my-lg-0">
        <button class="btn  my-2 my-sm-0" type="submit"><img src="{{ asset('/images/search-icon.png') }}"></button>
        <input class="form-control mr-sm-2" type="search" placeholder="поиск..." aria-label="Search">
    </form>

    <div class="d-flex flex-column flex-md-row align-items-center font-weight-normal">

            @guest
                
                <div class="user-cart" style="display:flex;flex-direction:row;flex-wrap:nowrap;width:50px;justify-content:space-between;align-items:flex-end;">
                        <a href="{{ route('cart.index') }}">
                            <img src="/images/cart24.png">
                        </a>
                            
                        @if (count(Cart::getContent()) > 0)
                            <div style="height:22px;color:#fff;text-align:center;width:20px;border-radius:50%;background-color:#ffa500">
                                {{ \Cart::session(Auth::user()->id)->getTotalQuantity() }}
                            </div>
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
                                <img src="/images/cart24.png">
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
                                <div class="dropdown-menu dropdown-menu-right">
                                    {!! Form::open(['url' => route('logout'), 'style' => 'display:flex;justify-content:center;']) !!}
                                        {!! Form::submit('Выйти', ['class' => 'btn btn-link text-dark']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                            
                     </div>
                
                @endguest
        </div>
</nav>


