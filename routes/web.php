<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('/docs', function () {
    return view('scribe.index');
});


require __DIR__ . '/auth.php';
