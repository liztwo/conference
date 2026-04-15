@extends('layout')
@section('title', 'Вход')
@section('content')
<h1 class="text-center mb-4">Вход</h1>
<form method="POST" action="/login">
    @csrf
    <div class="mb-3">
        <label class="form-label">Логин</label>
        <input type="text" name="login" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Войти</button>
</form>
<p class="text-center mt-3">Нет аккаунта? <a href="/register">Зарегистрируйтесь</a></p>
@endsection