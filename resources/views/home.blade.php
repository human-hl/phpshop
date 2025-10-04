@extends('layouts.app')
@section('content')
<h1>Главная</h1>
<section>
    <h2>Новинки</h2>
    <div class="grid">@foreach($new as $p) @include('components.product-card', ['product'=>$p]) @endforeach</div>
</section>
<section>
    <h2>Хиты</h2>
    <div class="grid">@foreach($hits as $p) @include('components.product-card', ['product'=>$p]) @endforeach</div>
</section>
<section>
    <h2>Распродажа</h2>
    <div class="grid">@foreach($sale as $p) @include('components.product-card', ['product'=>$p]) @endforeach</div>
</section>
@endsection
