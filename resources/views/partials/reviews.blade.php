<div class="from-blog-title container">
        <div style="width:70%;margin-top:20px;">
            <h3 style="margin-bottom:40px;display:flex;justify-content:center;font-weight:700">
                Отзывы
            </h3>
            <p style="text-align:center">
                
            </p>
        </div>
    </div>
<div class="container reviews-container">
    
    @foreach ($reviews as $review)
        <div class="card card-scale" style="width: 22rem;">
            <div class="reviews-top-side">
                <div class="reviews-user-avatar">
                    @foreach ($users as $user)
                        @if ($review['author_id'] === $user->id)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-100 user-avatar">
                        @endif
                    @endforeach
                </div>
                <div class="reviews-user-data">
                    <h5 style="font-weight:600">{{ $review['author_name'] }}</h5>
                    <div>
                        @foreach ($products as $product)
                            @if ($product['id'] === $review['product_id'])
                                {{ $product['brand'] }} {{ $product['model'] }}
                            @endif
                        @endforeach
                    </div>
                    <div class="star-rating-nonDynamic">
                        @for ($k = 0; $k < $review['rating']; $k+=1)
                            <img src="{{ asset('/images/star-12.png') }}">
                        @endfor
                        @for ($k = 0; $k < (5 - $review['rating']); $k+=1)
                            <img src="{{ asset('/images/star-12-inactive.png') }}">
                        @endfor
                    </div>
                    <div style="display:flex;justify-content:flex-end;">
                        <small class="text-muted">{{ substr($review['updated_at'], 0, strpos($review['updated_at'], " ")) }}</small>
                    </div>
                </div>
            </div>
            <div class="triangle"></div>
            <div class="card-body" style="overflow:hidden;">
                <div><img src="{{ asset('/images/quote-left-20.png') }}"></div>
                <p class="card-text" style="font-style:italic;font-family:Georgia, 'Times New Roman', Times, serif">
                    {{ Str::limit($review['body'], 200) }} 
                    <a href="{{ route("products.show", $review['product_id']) }}">далее</a>
                </p>
            </div>
        </div>
    @endforeach
</div>