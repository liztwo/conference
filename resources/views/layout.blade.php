<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Конференции.РФ - @yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        @auth
        <nav class="mb-4 pb-2 border-bottom text-center">
            <a href="/cabinet" class="btn btn-sm btn-outline-primary">Мои заявки</a>
            <a href="/request" class="btn btn-sm btn-outline-success">Новая заявка</a>
            @if(auth()->user()->email === 'admin@admin.com')
                <a href="/admin" class="btn btn-sm btn-outline-danger">Админка</a>
            @endif
            <form method="POST" action="/logout" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Выйти</button>
            </form>
        </nav>
        @endauth

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
            </div>
        @endif

        @yield('content')
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>