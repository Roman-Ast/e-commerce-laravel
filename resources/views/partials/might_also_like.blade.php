<div class="container header">
    <h4>Вам также может быть интересно:</h4>
</div>

<div class="container mightAlsoLike-container">
    @foreach ($mightAlsoLike as $mightAlsoLike_item)
        <div class="mightAlsoLike-item card-scale">
            <a href="{{ route('products.show', $mightAlsoLike_item->id)}}">
                <img src="{{ asset('/storage/' . $mightAlsoLike_item->image) }}" class="w-100" alt=""/>
            </a>
            <small>{{ Str::limit($mightAlsoLike_item->model, 13) }}</small>
        </div>
    @endforeach
</div>
