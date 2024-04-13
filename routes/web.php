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


use App\Http\Controllers\ArticleController;

Route::get('reference/{reference}/article/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('reference/{reference}/article', [ArticleController::class, 'store'])->name('article.store');
Route::get('reference/{reference}/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('reference/{reference}/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('reference/{reference}/article/{article}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('reference/{reference}/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
Route::get('references/{reference}/article', [ArticleController::class, 'index'])->name('article.index');


use App\Http\Controllers\ReferenceCategoryController;
Route::resource('reference-category', ReferenceCategoryController::class);

use App\Http\Controllers\RessourceController;
Route::resource('ressource', RessourceController::class);

use App\Http\Controllers\TypologyController;
Route::resource('typology', TypologyController::class);


use App\Http\Controllers\SettingController;
Route::resource('setting', SettingController::class);


use App\Http\Controllers\RuleController;
Route::resource('rule', RuleController::class);

use App\Http\Controllers\activeController;
Route::resource('active', ActiveController::class);

use App\Http\Controllers\DuaController;
Route::resource('rule.dua', DuaController::class);


use App\Http\Controllers\DulController;
Route::resource('rule.dul', DulController::class);


use App\Http\Controllers\BasketController;
Route::resource('basket', BasketController::class);


use App\Http\Controllers\ForumController;
Route::resource('forum', ForumController::class);

use App\Http\Controllers\UserController;
Route::resource('user', UserController::class);


use App\Http\Controllers\ValidationController;
Route::resource('validation', ValidationController::class);





// Dans le fichier routes/web.php,,,,,,,,,,,,,,,,,,,'
/*Route::get('/reference/{id}', 'ReferenceController@show')->name('reference.show');*/




    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



