@extends('layouts.app')
@section('content')
<h1>Оформление заказа</h1>
<form action="{{ route('checkout.place') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Имя</label>
    <input name="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}">
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}">
  </div>
  <div class="mb-3">
    <label>Адрес</label>
    <input name="address" class="form-control" value="{{ old('address', auth()->user()->address ?? '') }}">
  </div>
  <div class="mb-3">
    <label>Город</label>
    <input name="city" class="form-control" value="{{ old('city') }}">
  </div>
  <div class="mb-3">
    <label>ZIP</label>
    <input name="zip" class="form-control" value="{{ old('zip') }}">
  </div>
  <button class="btn btn-success">Отправить заказ</button>
</form>
@endsection
