<?php

use Illuminate\Support\Facades\Route;

Route::get('/enable-dev-vite', function () {
    if (!app()->environment('production')) {
        return redirect('/')
            ->withCookie(cookie('VITE_DEV', 'TRUE', 60));
    }

    return redirect()->route('app');
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

