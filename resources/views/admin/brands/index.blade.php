@extends('layouts.app')

@section('title', 'Бренды')

@section('content')
<h1>Бренды</h1>
<a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3">Добавить бренд</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Лого</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</td>
            <td>
                @if($brand->logo)
                    <img src="{{ asset('storage/'.$brand->logo) }}" width="50">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить бренд?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $brands->links() }}
@endsection
