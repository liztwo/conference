@extends('layout')
@section('title', 'Мои заявки')
@section('content')
<h1 class="text-center mb-4">Мои заявки</h1>
@if(auth()->user()->requests->count() == 0)
    <p class="text-center">У вас пока нет заявок. <a href="/request">Создать заявку</a></p>
@else
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr><th>Помещение</th><th>Дата</th><th>Время</th><th>Статус</th><th>Отзыв</th></tr>
            </thead>
            <tbody>
                @foreach(auth()->user()->requests as $r)
                <tr>
                    <td>{{ $r->room }}</td><td>{{ $r->date }}</td>
                    <td>{{ $r->time }}</td><td>{{ $r->status }}</td>
                    <td>
                        @if($r->status == 'completed')
                            <form method="POST" action="/cabinet/review/{{ $r->id }}">
                                @csrf
                                <input type="text" name="review" class="form-control form-control-sm" placeholder="Ваш отзыв" value="{{ $r->review }}">
                                <button type="submit" class="btn btn-sm btn-primary mt-1">Сохранить</button>
                            </form>
                        @else
                            {{ $r->review ?? '—' }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection