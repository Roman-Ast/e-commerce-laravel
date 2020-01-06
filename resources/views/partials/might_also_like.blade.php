<div class="container header">
    <h4>Вам также может быть интересно:</h4>
</div>

<div class="container mightAlsoLike-container">
    @foreach ($productsOnSale as $productOnSale)
        <div class="mightAlsoLike-item card-scale">
            <a href="{{ route('products.show', $productOnSale->id)}}">
                <img src="{{ asset('/storage/' . $productOnSale->image) }}" class="w-100" alt=""/>
            </a>
        </div>
    @endforeach
</div>
