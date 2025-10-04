@extends('layouts.app')

@section('title', 'Страницы')

@section('content')
<h1>Страницы</h1>
<a href="{{ route('admin.pages.create') }}" class="btn btn-primary mb-3">Добавить страницу</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Slug</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pages as $page)
        <tr>
            <td>{{ $page->id }}</td>
            <td>{{ $page->title }}</td>
            <td>{{ $page->slug }}</td>
            <td>
                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить страницу?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $pages->links() }}
@endsection
