@extends('layouts.app')

@section('title', isset($page) ? 'Редактировать страницу' : 'Добавить страницу')

@section('content')
<h1>{{ isset($page) ? 'Редактировать страницу' : 'Добавить страницу' }}</h1>

<form action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST">
    @csrf
    @if(isset($page)) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $page->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Содержание</label>
        <textarea name="content" class="form-control" rows="6">{{ old('content', $page->content ?? '') }}</textarea>
    </div>

    <button class="btn btn-success">{{ isset($page) ? 'Сохранить' : 'Создать' }}</button>
</form>
@endsection
