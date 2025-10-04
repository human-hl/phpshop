@extends('layouts.app')

@section('title', 'Редактировать пользователя')

@section('content')
<h1>Редактировать пользователя</h1>

<form action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Имя</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Админ</label>
        <select name="is_admin" class="form-select">
            <option value="0" @selected(!$user->is_admin)>Нет</option>
            <option value="1" @selected($user->is_admin)>Да</option>
        </select>
    </div>

    <button class="btn btn-success">Сохранить</button>
</form>
@endsection
