<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ReferenceCategoryController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\TypologyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ActiveController;
use App\Http\Controllers\DuaController;
use App\Http\Controllers\DulController;
use App\Http\Controllers\DulArticleController;
use App\Http\Controllers\RuleClassificationController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidationController;

Auth::routes();

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });

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

    Route::resource('mission', MissionController::class);
    Route::resource('activity', ActivityController::class);
    Route::resource('reference', ReferenceController::class);

    Route::get('reference/{reference}/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('reference/{reference}/article', [ArticleController::class, 'store'])->name('article.store');
    Route::get('reference/{reference}/article/{article}', [ArticleController::class, 'show'])->name('article.show');
    Route::get('reference/{reference}/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('reference/{reference}/article/{article}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('reference/{reference}/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('references/{reference}/article', [ArticleController::class, 'index'])->name('article.index');

    Route::resource('reference-category', ReferenceCategoryController::class);
    Route::resource('ressource', RessourceController::class);
    Route::resource('typology', TypologyController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('rule', RuleController::class);
    Route::resource('active', ActiveController::class);
    Route::resource('rule.dua', DuaController::class);
    Route::resource('rule.dul', DulController::class);
    Route::resource('rule.dul.dulreference', DulArticleController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('rule.classification', RuleClassificationController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('forum', ForumController::class);
    Route::resource('user', UserController::class);
    Route::resource('validation', ValidationController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
