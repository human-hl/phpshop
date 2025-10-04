@extends('layouts.app')
@section('content')
<h1>Корзина</h1>
@if($items->isEmpty())
  <p>Ваша корзина пуста.</p>
@else
<table class="table">
  <thead><tr><th>Товар</th><th>Цена</th><th>Кол-во</th><th>Сумма</th><th></th></tr></thead>
  <tbody>
  @foreach($items as $item)
    <tr>
      <td>{{ $item->product->name }}</td>
      <td>{{ number_format($item->product->price,2,',',' ') }} ₽</td>
      <td>
        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
          @csrf
          <input type="number" name="quantity" value="{{ $item->quantity }}" min="0" class="form-control" style="width:90px">
          <button class="btn btn-sm btn-secondary ms-2">Обновить</button>
        </form>
      </td>
      <td>{{ number_format($item->quantity*$item->product->price,2,',',' ') }} ₽</td>
      <td>
        <form action="{{ route('cart.remove', $item->id) }}" method="POST">@csrf
          <button class="btn btn-sm btn-danger">Удалить</button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

<div class="d-flex justify-content-end">
  <a href="{{ route('checkout.form') }}" class="btn btn-primary">Оформить заказ</a>
</div>
@endif
@endsection
