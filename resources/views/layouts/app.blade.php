<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', config('app.name','Shop'))</title>

    {{-- CDN fallback (быстрая страховка) --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Vite assets --}}
    @if(app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Главная</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('catalog.index') }}">Каталог</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Корзина ({{ \App\Models\CartItem::where('cart_id', session('cart_id') ?? '')->count() }})</a></li>
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Вход</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
        @else
            @if(auth()->user()->is_admin)
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">Админ</a>
  </li>

          @endif
         <li class="nav-item"><a class="nav-link" href="{{ route('account.index') }}">{{ auth()->user()->name }}</a></li>

          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">@csrf
              <button class="btn btn-link nav-link">Выйти</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
    <aside class="col-md-3">
      <h5>Категории</h5>
      <ul class="list-group mb-4">
        @foreach(\App\Models\Category::whereNull('parent_id')->get() as $cat)
          <li class="list-group-item"><a href="{{ route('catalog.index', $cat->slug) }}">{{ $cat->name }}</a></li>
        @endforeach
      </ul>

      <h5>Популярные бренды</h5>
      <ul class="list-group">
        @foreach(\App\Models\Brand::take(12)->get() as $brand)
          <li class="list-group-item">{{ $brand->name }}</li>
        @endforeach
      </ul>
    </aside>

    <main class="col-md-9">
      @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
      @yield('content')
    </main>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
  © {{ date('Y') }} Shop
</footer>

{{-- bootstrap js CDN (fallback) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
