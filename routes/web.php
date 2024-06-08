<?php



Route::get('/', function () {
    return view('auth.login');
});
use App\Http\Controllers\ForumReactionController;
use App\Http\Controllers\Settings\CountryController;
use App\Http\Controllers\Settings\TypologyCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypologyController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Settings\ReferenceCategoryController;
use App\Http\Controllers\TypologyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CharterController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ActiveController;
use App\Http\Controllers\DuaController;
use App\Http\Controllers\DulController;
use App\Http\Controllers\DulArticleController;
use App\Http\Controllers\RuleClassificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ActivityRuleController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\ForumSubjectController;
use App\Http\Controllers\ForumChatController;
use App\Http\Controllers\ChatController;

// Route group for authentication
Route::middleware(['auth'])->group(function () {
    // Controllers
    Route::resource('mission', MissionController::class);
    Route::resource('basket', basketController::class);
    Route::resource('activity', ActivityController::class);
    Route::resource('activity.rule', ActivityRuleController::class);
    Route::resource('activity.typology', ActivityTypologyController::class);
    Route::resource('reference', ReferenceController::class);
    Route::resource('reference.article', ArticleController::class);
    Route::resource('reference.link', LinkController::class);
    Route::resource('reference.file', FileController::class)->except(['download']);
    Route::get('reference/{reference}/file/{file}/download', [FileController::class, 'download'])->name('reference.file.download');
    Route::resource('reference-category', ReferenceCategoryController::class);
    Route::resource('typology', TypologyController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('charter', CharterController::class);
    Route::resource('rule', RuleController::class);
    Route::resource('active', ActiveController::class);
    Route::resource('rule.dua', DuaController::class);
    Route::resource('rule.dul', DulController::class);
    Route::resource('rule.dul.dulreference', DulArticleController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('rule.classification', RuleClassificationController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);


    Route::resource('user', UserController::class);
    Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');



    Route::prefix('committee')->group(function(){
        Route::get('/project', [CommitteeController::class, 'project'])->name('committee.project');
        Route::get('/examining', [CommitteeController::class, 'examining'])->name('committee.examining');
        Route::get('/approved', [CommitteeController::class, 'approved'])->name('committee.approved');
    });

    Route::resource('subject', ForumSubjectController::class);
    Route::resource('subject.post', ForumPostController::class);
    Route::resource('chat', ForumChatController::class);
    Route::post('/reaction/{post}', [ForumReactionController::class, 'add'])->name('reaction.add');
    Route::post('/subject/{subject}/post/{post}/reply', [ForumPostController::class, 'reply'])->name('subject.post.reply');

//    Route::get('/subject/{subject}/post/{post}/edit', [ForumSubjectController::class, 'editPost'])->name('subject.post.editPost');
//    Route::delete('/subject/{post}/post/{subject}', [ForumPostController::class, 'destroy'])->name('subject.post.destroy');
    Route::delete('/subjects/{subject}/posts/{post}', [ForumSubjectController::class, 'destroyPost'])->name('subject.post.destroyPost');
    Route::get('/subjects/{subject}/posts/{post}/edit', [ForumSubjectController::class, 'editPost'])->name('subject.post.editPost');
    Route::put('/subjects/{subject}/posts/{post}', [ForumSubjectController::class, 'updatePost'])->name('subject.post.updatePost');
    Route::get('/subject/{subject}/post/{post}', [ForumSubjectController::class, 'showPost'])->name('subject.post.showPost');
    Route::resource('setting/reference-categories', ReferenceCategoryController::class);
    Route::resource('setting/typology-categories', TypologyCategoryController::class);
    Route::resource('setting/countries', CountryController::class);
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');




});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
