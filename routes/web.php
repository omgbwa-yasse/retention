<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});



// Routes sans préfixe
Route::get('/search', function () {
    return view('search.searchActivity');
})->name('searchActivity');

Route::get('/add', function () {
    return view('search.searchActivity');
})->name('addActivity');

Route::get('/setting', function () {
    return view('search.searchActivity');
})->name('setting');

Route::get('/forum', function () {
    return view('search.searchActivity');
})->name('forum');



use App\Http\Controllers\MissionController;
Route::resource('mission', MissionController::class);


use App\Http\Controllers\ActivityController;
Route::resource('activity', ActivityController::class);

use App\Http\Controllers\ReferenceController;
Route::resource('reference', ReferenceController::class);

use App\Http\Controllers\TypologyController;
Route::resource('typology', TypologyController::class);


use App\Http\Controllers\SettingController;
Route::resource('setting', SettingController::class);


use App\Http\Controllers\RuleController;
Route::resource('rule', RuleController::class);

use App\Http\Controllers\BasketController;
Route::resource('basket', BasketController::class);


use App\Http\Controllers\ForumController;
Route::resource('forum', ForumController::class);

use App\Http\Controllers\UserController;
Route::resource('user', UserController::class);


use App\Http\Controllers\ValidationController;
Route::resource('validation', ValidationController::class);

