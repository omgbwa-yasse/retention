<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});



/*


    Recherche des données


*/


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



// Routes avec préfixe
Route::prefix('/search')->group(function () {
    Route::get('/classification', function () {
        return view('search.searchActivity');
    })->name('searchClassification');

    Route::get('/typology', function () {
        return view('search.searchTypology');
    })->name('searchTypology');

    Route::get('/rule', function () {
        return view('search.searchRule');
    })->name('searchRule');

    Route::get('/reference', function () {
        return view('search.searchReference');
    })->name('searchReference');

    Route::get('/basket', function () {
        return view('search.searchBasket');
    })->name('searchBasket');
});


/*


    Ajout des données


*/

Route::prefix('/add')->group(function () {

    Route::get('/activity', function () {
        return view('add.addActivity');
     })->name('addActivity');

    Route::get('/typology', function () {
        return view('add.addTypology');
    })->name('addTypology');

    Route::get('/rule', function () {
        return view('add.addRule');
    })->name('addRule');


});
/*


    Paramètres de l'application


*/

use App\Http\Controllers\MissionController;

Route::resource('mission', MissionController::class);
Route::get('/mission/{id}/edit', [MissionController::class, 'edit'])->name('mission.edit');



/*


    Paramètres de l'application


*/

Route::prefix('/setting')->group(function () {

    Route::get('/home', function () {
        return "Paramètres sur les classes";
    })->name('settingHome');

    Route::get('/class', function () {
        return "Paramètres sur les classes";
    })->name('settingMission');

    Route::get('/typology', function () {
        return "Paramètres sur les typologie";
    })->name('settingTypology');

    Route::get('/rule', function () {
        return "Paramètres sur les règles";
    })->name('settingRule');

    Route::get('/mission', function () {
        return "Paramètres sur les mission";
    })->name('settingMission');

    Route::get('/user', function () {
        return "gestion des usagers";
    })->name('settingUser');

    Route::get('/display', function () {
        return "Paramètres d'affichage";
    })->name('settingDisplay');
});

/*


    Forum


*/

Route::prefix('/forum')->group(function () {

        Route::get('/topic', function (){
            return "Afficher les commentaires";
            })->name('forumTopic');

        Route::get('/comment', function () {
            return "Afficher les commentaires";
        })->name('forumComment');

        Route::get('/react', function () {
            return "Afficher les réactions";
        })->name('forumReact');

        Route::get('/add', function () {
            return "Ajouter les données dans le forum";
        })->name('forumadd');

        Route::get('/forumOnline', function () {
            return "rechercher les données dans le forum";
        })->name('forumOnline');


        Route::get('/forumTopic', function () {
            return "rechercher les données dans le forum";
        })->name('forumTopic');

        Route::get('/forumTopicBasket', function () {
            return "rechercher les données dans le forum";
        })->name('forumTopicBasket');

});

/*


    Approbation


*/

Route::prefix('/approbation')->group(function () {

    Route::get('/approved', function (){
        return "Afficher les commentaires";
        })->name('approved');

    Route::get('/noApproved', function () {
        return "Afficher les commentaires";
    })->name('noApproved');

});
