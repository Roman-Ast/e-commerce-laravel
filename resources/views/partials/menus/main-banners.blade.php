<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($items); $i++)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="active"></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach ($items as $menu_item)
            <div class="carousel-item " data-interval="5000">
                <img src="{{ $menu_item->link() }}" class="d-block w-100" height="500">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

{{--@foreach ($items as $menu_item)
    <div class="carousel-item " data-interval="5000">
        <img src="{{ $menu_item->link() }}" class="d-block w-100" height="500">
    </div>
@endforeach--}}