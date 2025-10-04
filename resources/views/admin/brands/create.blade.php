@extends('layouts.app')

@section('title', isset($brand) ? 'Редактировать бренд' : 'Добавить бренд')

@section('content')
<h1>{{ isset($brand) ? 'Редактировать бренд' : 'Добавить бренд' }}</h1>

<form action="{{ isset($brand) ? route('admin.brands.update', $brand) : route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($brand)) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $brand->slug ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Лого</label>
        <input type="file" name="logo" class="form-control">
        @if(isset($brand) && $brand->logo)
            <img src="{{ asset('storage/'.$brand->logo) }}" class="mt-2" width="100">
        @endif
    </div>

    <button class="btn btn-success">{{ isset($brand) ? 'Сохранить' : 'Создать' }}</button>
</form>
@endsection
