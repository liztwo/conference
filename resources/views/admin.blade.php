@extends('layout')
@section('title', 'Админка')
@section('content')
<h1 class="text-center mb-4">Все заявки</h1>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr><th>ID</th><th>Пользователь</th><th>Помещение</th>
                <th>Дата</th><th>Время</th><th>Оплата</th>
                <th>Статус</th><th>Отзыв</th><th>Действия</th></tr>
        </thead>
        <tbody>
            @foreach($requests as $r)
            <tr>
                <td>{{ $r->id }}</td><td>{{ $r->user->login }}</td>
                <td>{{ $r->room }}</td><td>{{ $r->date }}</td>
                <td>{{ $r->time }}</td><td>{{ $r->payment_method }}</td>
                <td>
                    <form method="POST" action="/admin/status/{{ $r->id }}" style="display: inline;">
                        @csrf @method('PUT')
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="new" {{ $r->status=='new' ? 'selected' : '' }}>Новая</option>
                            <option value="assigned" {{ $r->status=='assigned' ? 'selected' : '' }}>Мероприятие назначено</option>
                            <option value="completed" {{ $r->status=='completed' ? 'selected' : '' }}>Мероприятие завершено</option>
                        </select>
                    </form>
                </td>
                <td>{{ $r->review ?? '—' }}</td>
                <td>
                    <form method="POST" action="/admin/{{ $r->id }}">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection