@extends('layouts.app')

@section('title', isset($product) ? 'Редактировать товар' : 'Добавить товар')

@section('content')
<h1>{{ isset($product) ? 'Редактировать товар' : 'Добавить товар' }}</h1>

<form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($product)) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Категория</label>
        <select name="category_id" class="form-select" required>
            <option value="">-- Выберите --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Бренд</label>
        <select name="brand_id" class="form-select">
            <option value="">-- Нет --</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id ?? '') == $brand->id)>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Цена</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required step="0.01">
    </div>

    <div class="mb-3">
        <label class="form-label">Основное изображение</label>
        <input type="file" name="main_image" class="form-control">
        @if(isset($product) && $product->main_image)
            <img src="{{ asset('storage/'.$product->main_image) }}" class="mt-2" width="100">
        @endif
    </div>

    <button class="btn btn-success">{{ isset($product) ? 'Сохранить' : 'Создать' }}</button>
</form>
@endsection
