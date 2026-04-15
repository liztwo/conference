<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Request as ConferenceRequest;
use Illuminate\Support\Facades\Hash;

Route::get('/', fn() => redirect('/register'));

// Регистрация
Route::get('/register', fn() => view('register'));
Route::post('/register', function(Request $request) {
    $validated = $request->validate([
        'login' => 'required|unique:users|min:6|alpha_num',
        'password' => 'required|min:6',
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'email' => 'required|email|unique:users',
    ]);
    User::create([
        'login' => $validated['login'],
        'password' => Hash::make($validated['password']),
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'phone' => $validated['phone'],
        'email' => $validated['email'],
        'name' => $validated['first_name'] . ' ' . $validated['last_name'],
    ]);
    return redirect('/register')->with('success', 'Регистрация успешна!');
});

// Вход
Route::get('/login', fn() => view('login'));
Route::post('/login', function(Request $request) {
    $user = User::where('login', $request->login)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Неверный логин или пароль');
    }
    auth()->login($user);
    return redirect('/cabinet');
});

// Выход
Route::post('/logout', function() {
    auth()->logout();
    return redirect('/login');
});

// Личный кабинет
Route::get('/cabinet', function() {
    if (!auth()->check()) return redirect('/login');
    return view('cabinet');
});

// Отзыв
Route::post('/cabinet/review/{id}', function($id, Request $httpRequest) {
    if (!auth()->check()) return redirect('/login');

    $booking = ConferenceRequest::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $booking->review = $httpRequest->input('review');
    $booking->save();

    return redirect('/cabinet')->with('success', 'Отзыв сохранён');
});

// Создание заявки
Route::get('/request', function() {
    if (!auth()->check()) return redirect('/login');
    return view('request');
});
Route::post('/request', function(Request $request) {
    if (!auth()->check()) return redirect('/login');
    $validated = $request->validate([
        'room' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'payment_method' => 'required',
        'phone' => 'required',
    ]);
    ConferenceRequest::create([
        'user_id' => auth()->id(),
        'room' => $validated['room'],
        'date' => $validated['date'],
        'time' => $validated['time'],
        'payment_method' => $validated['payment_method'],
        'phone' => $validated['phone'],
        'status' => 'new',
    ]);
    return redirect('/cabinet')->with('success', 'Заявка отправлена администратору');
});

// Админка
Route::get('/admin', function() {
    if (!auth()->check() || auth()->user()->email !== 'admin@admin.com') abort(403);
    $requests = ConferenceRequest::with('user')->get();
    return view('admin', compact('requests'));
});
Route::put('/admin/status/{id}', function($id) {
    if (!auth()->check() || auth()->user()->email !== 'admin@admin.com') abort(403);
    $request = ConferenceRequest::findOrFail($id);
    $request->status = request('status');
    $request->save();
    return redirect('/admin')->with('success', 'Статус обновлён');
});
Route::delete('/admin/{id}', function($id) {
    if (!auth()->check() || auth()->user()->email !== 'admin@admin.com') abort(403);
    ConferenceRequest::findOrFail($id)->delete();
    return redirect('/admin')->with('success', 'Заявка удалена');
});