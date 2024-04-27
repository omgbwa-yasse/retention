<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
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

use App\Http\Controllers\ActivityTypologyController;
Route::resource('activity.typology', ActivityTypologyController::class);

use App\Http\Controllers\ReferenceController;
Route::resource('reference', ReferenceController::class);


use App\Http\Controllers\ArticleController;
Route::resource('reference.article', ArticleController::class);

use App\Http\Controllers\LinkController;
Route::resource('reference.link', LinkController::class);

use App\Http\Controllers\FileController;
Route::resource('reference.file', FileController::class)->except(['download']);
Route::get('reference/{reference}/file/{file}/download', 'FileController@download')->name('reference.file.download');


/*
    Route::get('reference/{reference}/file/{file}/download', 'FileController@download')->name('reference.file.download');
*/



use App\Http\Controllers\ReferenceCategoryController;
Route::resource('reference-category', ReferenceCategoryController::class);


use App\Http\Controllers\TypologyController;
Route::resource('typology', TypologyController::class);


use App\Http\Controllers\SettingController;
Route::resource('setting', SettingController::class);


use App\Http\Controllers\charterController;
Route::resource('charter', charterController::class);


use App\Http\Controllers\RuleController;
Route::resource('rule', RuleController::class);

use App\Http\Controllers\activeController;
Route::resource('active', ActiveController::class);

use App\Http\Controllers\DuaController;
Route::resource('rule.dua', DuaController::class);


use App\Http\Controllers\DulController;
Route::resource('rule.dul', DulController::class);


use App\Http\Controllers\DulArticleController;
Route::resource('rule.dul.dulreference', DulArticleController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);

use App\Http\Controllers\RuleClassificationController;
Route::resource('rule.classification', RuleClassificationController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);


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



