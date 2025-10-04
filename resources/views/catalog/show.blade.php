@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-5">
    <img src="{{ $product->main_image ? asset($product->main_image) : asset('images/no-image.png') }}" class="img-fluid" alt="{{ $product->name }}">
  </div>
  <div class="col-md-7">
    <h1>{{ $product->name }}</h1>
    <p class="text-muted mb-2">{{ $product->brand? $product->brand->name : '' }}</p>
    <h3 class="text-primary">{{ number_format($product->price,2,',',' ') }} ₽</h3>
    <p>{{ $product->description }}</p>

    <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">
      <input type="number" name="quantity" value="1" min="1" class="form-control" style="width:110px">
      <button class="btn btn-success">Добавить в корзину</button>
    </form>
  </div>
</div>
@endsection
