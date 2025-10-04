@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Каталог</h1>
    <form method="GET" class="d-flex gap-2" action="{{ route('catalog.index') }}">
        <input type="number" name="min" class="form-control" placeholder="Мин цена" value="{{ request('min') }}" style="width:120px">
        <input type="number" name="max" class="form-control" placeholder="Макс цена" value="{{ request('max') }}" style="width:120px">
        <select name="filter" class="form-select" style="width:140px">
            <option value="">Все</option>
            <option value="new" {{ request('filter')=='new'?'selected':'' }}>Новинки</option>
            <option value="hit" {{ request('filter')=='hit'?'selected':'' }}>Лидеры</option>
            <option value="sale" {{ request('filter')=='sale'?'selected':'' }}>Распродажа</option>
        </select>
        <button class="btn btn-primary">Фильтр</button>
    </form>
</div>

<div class="row">
    @forelse($products as $product)
        @include('components.product-card', ['product'=>$product])
    @empty
        <p>Товаров не найдено</p>
    @endforelse
</div>

<div class="mt-4">
    {{ $products->withQueryString()->links() }}
</div>
@endsection
