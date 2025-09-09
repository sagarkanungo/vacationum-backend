<?php

use Illuminate\Support\Facades\Route;

// Default route for browser (homepage)
Route::get('/', function () {
    return view('welcome'); // or just return 'Laravel is working!';
});
