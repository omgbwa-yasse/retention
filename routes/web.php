<?php


//Route::get('/', function () {
//
//    return view('auth.login');
//});

use App\Http\Controllers\CountryController;
use App\Http\Controllers\ForumReactionController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReferenceCategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TriggerController;
use App\Http\Controllers\TypologyCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypologyController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ReferenceArticleController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TypologyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CharterController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\DulController;
use App\Http\Controllers\RuleArticleController;
use App\Http\Controllers\RuleClassificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ActivityRuleController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\ForumSubjectController;
use App\Http\Controllers\ForumChatController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\ChatController;

Route::get('reference/{reference}/file/{name}/preview', [FileController::class, 'preview'])->name('reference.file.preview');
Route::get('/reference/{reference}/generate-pdf', [ReferenceController::class, 'generatePdf'])->name('reference.generatePdf');
Route::get('/activity/export', [ActivityController::class, 'export'])->name('activity.export');
Route::get('/activity/pdf', [ActivityController::class, 'pdf'])->name('activity.pdf');
Route::get('/rules/export', [RuleController::class, 'export'])->name('rule.export');
Route::get('/mission/export', [MissionController::class, 'export'])->name('mission.export');
Route::get('/typologies/export', [TypologyController::class, 'export'])->name('typology.export');
Route::get('reference/{reference}/file/{name}/download', [FileController::class, 'download'])->name('reference.file.download');
Route::get('/', [PublicController::class, 'index'])->name('public.index');

Route::get('/charter/{id}', [PublicController::class, 'showCharter'])->name('public.charter');
Route::get('/charter/{id}/pdf', [PublicController::class, 'downloadCharter'])->name('public.charter.pdf');


// Accès au grand public

    Route::get('/', [PublicController::class, 'index']);
    Route::get('/public', [PublicController::class, 'index'])->name('public.index');
    Route::prefix('public')->group(function () {




 /*
        Recherche simple et avancée
    */
    Route::get('/search', [PublicController::class, 'search'])->name('public.search');
    Route::get('/search/advanced', [PublicController::class, 'advancedFormular'])->name('public.search.advanced');
    Route::get('/search/advanced/results', [PublicController::class, 'advanced'])->name('public.search.advanced.results');

    /*
        les vues des rules, references et classes
    */

    Route::get('/rules/{rule}', [PublicController::class, 'showRule'])->name('public.rules.show');
    Route::get('/classes/{class}', [PublicController::class, 'showClass'])->name('public.classes.show');
    Route::get('/references/{reference}', [PublicController::class, 'showReference'])->name('public.references.show');

    /*
        Pages statiques
    */
    Route::get('/class', [PublicController::class, 'showClass'])->name('public.class');
    //    Route::get('/charter/{id}', [PublicController::class, 'showCharter'])->name('public.charter');
    //    Route::get('/charter/{id}/pdf', [PublicController::class, 'downloadCharter'])->name('public.charter.pdf');
    Route::get('/search', [PublicController::class, 'search'])->name('public.search');
    Route::get('/about', [PublicController::class, 'about'])->name('public.about');
    Route::get('/news', [PublicController::class, 'news'])->name('public.news');
});

Route::get('language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch')
    ->where('locale', '[a-zA-Z]{2}');


// Route group for authentication
Route::middleware(['auth'])->group(function () {
    // Controllers
    Route::resource('mission', MissionController::class);
    Route::resource('basket', basketController::class);

    Route::resource('activity', ActivityController::class);
    Route::resource('activity.rule', ActivityRuleController::class);
    Route::get('/activities/{id}/rules', [ActivityRuleController::class, 'show'])->name('activity.rules.show');
    Route::resource('activity.typology', ActivityTypologyController::class);

    Route::resource('reference', ReferenceController::class);
    Route::resource('reference.article', ReferenceArticleController::class);
    Route::resource('reference.link', LinkController::class);
    Route::resource('reference.file', FileController::class)->except(['download']);
    Route::resource('reference-category', ReferenceCategoryController::class);

    Route::resource('typology', TypologyController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('charter', CharterController::class);

    /*
        Règles de conservation
    */
    Route::resource('rule', RuleController::class);
    Route::resource('rule.article', RuleArticleController::class)->names('rule.article');
    Route::resource('rule.classification', RuleClassificationController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('rule.classification', RuleClassificationController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::get('/rule-classification', [RuleClassificationController::class, 'index'])->name('rule.classification.ruleClassificationIndex');
    Route::get('/rule/{rule_id}/classification', [RuleClassificationController::class, 'index'])->name('rule.classification.index');
    Route::get('/rule/{rule}/classification/{classification}/edit', [RuleClassificationController::class, 'edit'])->name('rule.classification.edit');
    Route::delete('/rule/{rule}/classification/{classification}', [RuleClassificationController::class, 'destroy'])->name('rule.classification.destroy');

    /*
        Chartes de conservation
    */
    Route::post('/reference/add-to-basket', [ReferenceController::class, 'addToBasket'])->name('reference.addToBasket');
    Route::get('/charter', [CharterController::class, 'index'])->name('charter.index');
    Route::get('/charter/print/{domaineId}', [CharterController::class, 'printPdf'])->name('charter.print');
    Route::get('/charter/export/{domaineId}', [CharterController::class, 'exportExcel'])->name('charter.export');
    Route::resource('user', UserController::class);

    /*
        Comité de validation
    */
    Route::get('/committee/project', [CommitteeController::class, 'project'])->name('committee.project');
    Route::get('/committee/examining', [CommitteeController::class, 'examining'])->name('committee.examining');
    Route::get('/committee/approved', [CommitteeController::class, 'approved'])->name('committee.approved');


    /*
        Forum
    */
    Route::resource('committee', CommitteeController::class);
    Route::resource('subject', ForumSubjectController::class);
    Route::resource('subject.post', ForumPostController::class);
    Route::resource('chat', ForumChatController::class);
    Route::post('/reaction/{post}', [ForumReactionController::class, 'add'])->name('reaction.add');
    Route::post('/subject/{subject}/post/{post}/reply', [ForumPostController::class, 'reply'])->name('subject.post.reply');
    Route::delete('/subjects/{subject}/posts/{post}', [ForumSubjectController::class, 'destroyPost'])->name('subject.post.destroyPost');
    Route::get('/subjects/{subject}/posts/{post}/edit', [ForumSubjectController::class, 'editPost'])->name('subject.post.editPost');
    Route::put('/subjects/{subject}/posts/{post}', [ForumSubjectController::class, 'updatePost'])->name('subject.post.updatePost');
    Route::get('/subject/{subject}/post/{post}', [ForumSubjectController::class, 'showPost'])->name('subject.post.showPost');

    //setting
    Route::get('/basket/{basket}', [ReferenceController::class, 'showBasket'])->name('basket.show');
    Route::resource('country', CountryController::class);
    Route::post('typology_categories', [TypologyCategoryController::class, 'store'])->name('typology_categories.store');
    Route::resource('reference_categories', ReferenceCategoryController::class);
    Route::resource('typology_categories', TypologyCategoryController::class);
    Route::resource('SearchController', SearchController::class);
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/visitor-stats', [App\Http\Controllers\DashboardController::class, 'getVisitorStats'])
            ->name('admin.visitor-stats');
    });
    //research
    Route::get('/search/index', [SearchController::class, 'search'])->name('search');
    Route::get('/search/advanced', [SearchController::class, 'advancedSearch'])->name('search.advanced');

    //Route::get('/activity/exportPdf', [ActivityController::class, 'exportPdf'])->name('activity.exportPdf');
    Route::resource('triggers', TriggerController::class);
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
