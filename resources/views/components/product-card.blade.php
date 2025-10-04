<div class="col-md-3 mb-4">
    <div class="card h-100 shadow-sm">
        <a href="{{ route('product.show', $product->slug) }}">
            <img src="{{ $product->main_image ? asset($product->main_image) : asset('images/no-image.png') }}" class="card-img-top" alt="{{ $product->name }}" style="height:180px;object-fit:cover;">
        </a>

        <div class="card-body d-flex flex-column">
            <h5 class="card-title">
                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
            </h5>

            <p class="card-text fw-bold mb-2">{{ number_format($product->price,2,',',' ') }} ₽</p>

            @if($product->is_new)
                <span class="badge bg-success mb-2">Новинка</span>
            @endif
            @if($product->is_hit)
                <span class="badge bg-warning mb-2">Хит</span>
            @endif
            @if($product->is_sale)
                <span class="badge bg-danger mb-2">Sale</span>
            @endif

            <form method="POST" action="{{ route('cart.add') }}" class="mt-auto">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-sm btn-success w-100">В корзину</button>
            </form>
        </div>
    </div>
</div>
