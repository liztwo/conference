@extends('layout')
@section('title', 'Новая заявка')
@section('content')
<h1 class="text-center mb-4">Бронирование помещения</h1>
<form method="POST" action="/request">
    @csrf
    <div class="mb-3">
        <label class="form-label">Тип помещения</label>
        <select name="room" class="form-select" required>
            <option value="Аудитория">Аудитория</option>
            <option value="Коворкинг">Коворкинг</option>
            <option value="Кинозал">Кинозал</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Дата конференции</label>
        <input type="date" name="date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Время начала</label>
        <input type="time" name="time" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Способ оплаты</label>
        <select name="payment_method" class="form-select" required>
            <option value="Наличные">Наличные</option>
            <option value="Банковская карта">Банковская карта</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Контактный телефон</label>
        <input type="tel" name="phone" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Отправить заявку</button>
</form>
@endsection