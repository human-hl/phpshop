@extends('layouts.app')

@section('title', 'Заказ #' . $order->id)

@section('content')
<h1>Заказ #{{ $order->id }}</h1>

<p><strong>Пользователь:</strong> {{ $order->user?->name ?? 'Гость' }}</p>
<p><strong>Сумма:</strong> {{ $order->total }}</p>
<p><strong>Статус:</strong> {{ $order->status }}</p>
<p><strong>Адрес доставки:</strong> {{ $order->shipping_address['address'] ?? '-' }}</p>

<h3>Товары</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product?->name ?? 'Удален' }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Изменить статус</label>
        <select name="status" class="form-select">
            <option value="pending" @selected($order->status == 'pending')>В ожидании</option>
            <option value="processing" @selected($order->status == 'processing')>В обработке</option>
            <option value="completed" @selected($order->status == 'completed')>Выполнен</option>
            <option value="cancelled" @selected($order->status == 'cancelled')>Отменен</option>
        </select>
    </div>
    <button class="btn btn-success">Сохранить</button>
</form>
@endsection
