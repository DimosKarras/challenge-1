<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('url_shortener');
});

Route::post('/shortened_urls', [UrlShortenerController::class, 'store'])->name('fetch_url');

Route::get('/shortened_urls/{urlShortener}', [UrlShortenerController::class, 'show'])->name('show_url');

Route::get('/visit', [UrlShortenerController::class, 'redirectToOriginalURL']);

