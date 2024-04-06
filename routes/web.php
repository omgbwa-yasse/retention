<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/category', function (Request $request) {
    $post = \App\Models\TypologyCategory::create([
        'title' => 'Bonjour papa',
        'description' => 'la description'
    ]);

    $post->save();
    return $post->find(1);
});
