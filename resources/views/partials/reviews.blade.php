<div style="width:100%;background:#333">
        <div class="from-blog-title">
                <div style="width:70%;margin-top:20px;">
                    <h3 style="margin-bottom:40px;;display:flex;justify-content:center;">
                        <div style="font-weight:600;color:#fff">Отзывы</a>
                    </h3>
                    <p style="margin-top:20px;">
                        
                    </p>
                </div>
            </div>
<div id="carouselExampleCaptions" class="carousel slide container" data-ride="carousel" >
        <div class="carousel-inner" style="">
          @for ($i = 0; $i < count($reviews); $i += 1)
            @if ($i === 0)
                <div class="carousel-item active" style="min-height:400px;background:#333;color:#fff">
                    <div class="card mb-3" style="background:#333">
                        <div class="row no-gutters">
                            <div class="col-md-3" style="border:1px solid #ddd;border-radius:50%;width:200px;height:200px;display:flex;justify-content:center;align-items:center;">
                                <img src="/images/anonimus-180.png">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:600;">{{ $reviews[$i]['author_name'] }}</h5>
                                    <div style="font-weight:600;">
                                        @foreach ($products as $product)
                                            @if ($product['id'] === $reviews[$i]['product_id'])
                                                {{ $product['brand'] }}
                                                {{ $product['model'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="rating" style="margin-bottom:5px;">
                                            <div class="star-rating-nonDynamic">
                                                @for ($k = 0; $k < $reviews[$i]['rating']; $k+=1)
                                                    <img src="{{ asset('/images/star-12.png') }}">
                                                @endfor
                                                @for ($k = 0; $k < (5 - $reviews[$i]['rating']); $k+=1)
                                                    <img src="{{ asset('/images/star-12-inactive.png') }}">
                                                @endfor
                                            </div>
                                        </div>
                                    <p class="card-text" style="min-height:200px;">{{ $reviews[$i]['body'] }}</p>
                                    <p class="text-muted"><small>{{ $reviews[$i]['updated_at'] }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="carousel-item" style="min-height:400px;color:#fff">
                    <div class="card mb-3" style="background:#333">
                        <div class="row no-gutters">
                            <div class="col-md-3" style="border:1px solid #ddd;border-radius:50%;width:200px;height:200px;display:flex;justify-content:center;align-items:center;">
                                <img src="/images/anonimus-180.png">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $reviews[$i]['author_name'] }}</h5>
                                    <div>
                                        @foreach ($products as $product)
                                            @if ($product['id'] === $reviews[$i]['product_id'])
                                                {{ $product['brand'] }}
                                                {{ $product['model'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="rating" style="margin-bottom:5px;">
                                            <div class="star-rating-nonDynamic">
                                                @for ($k = 0; $k < $reviews[$i]['rating']; $k+=1)
                                                    <img src="{{ asset('/images/star-12.png') }}">
                                                @endfor
                                                @for ($k = 0; $k < (5 - $reviews[$i]['rating']); $k+=1)
                                                    <img src="{{ asset('/images/star-12-inactive.png') }}">
                                                @endfor
                                            </div>
                                        </div>
                                    <p class="card-text" style="min-height:200px;">{{ $reviews[$i]['body'] }}</p>
                                    <p class="text-muted"><small>{{ $reviews[$i]['updated_at'] }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
          @endfor
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</div>