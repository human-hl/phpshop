@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Админ-панель</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary w-100 mb-2">Категории</a>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-primary w-100 mb-2">Бренды</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary w-100 mb-2">Товары</a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary w-100 mb-2">Заказы</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary w-100 mb-2">Пользователи</a>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary w-100 mb-2">Страницы</a>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Пользователи</h5>
                            <p class="card-text display-6">{{ $usersCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Заказы</h5>
                            <p class="card-text display-6">{{ $ordersCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Товары</h5>
                            <p class="card-text display-6">{{ $productsCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
