@extends('layouts.app')

@section('title', isset($category) ? 'Редактировать категорию' : 'Добавить категорию')

@section('content')
<h1>{{ isset($category) ? 'Редактировать категорию' : 'Добавить категорию' }}</h1>

<form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($category)) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Родительская категория</label>
        <select name="parent_id" class="form-select">
            <option value="">-- Нет --</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id ?? '') == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Изображение</label>
        <input type="file" name="image" class="form-control">
        @if(isset($category) && $category->image)
            <img src="{{ asset('storage/'.$category->image) }}" class="mt-2" width="100">
        @endif
    </div>

    <button class="btn btn-success">{{ isset($category) ? 'Сохранить' : 'Создать' }}</button>
</form>
@endsection
