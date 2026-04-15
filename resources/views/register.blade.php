@extends('layout')
@section('title', 'Регистрация')
@section('content')
<h1 class="text-center mb-4">Регистрация</h1>
<form method="POST" action="/register">
    @csrf
    <div class="mb-3">
        <label class="form-label">Логин (мин. 6)</label>
        <input type="text" name="login" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Пароль (мин. 6)</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Имя</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Фамилия</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Телефон</label>
        <input type="tel" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
</form>
<p class="text-center mt-3">Уже есть аккаунт? <a href="/login">Войдите</a></p>
@endsection