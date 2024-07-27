<?php

namespace App\Http\Controllers;

use App\Models\Active;
use App\Models\Articles;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Reference;
use App\Models\Rule;
use App\Models\Sort;
use App\Models\Status;
use App\Models\Trigger;
use App\Models\Typology;
use App\Models\TypologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $references = Reference::where('name', 'like', "%{$query}%")->get();
        $rules = Rule::where('name', 'like', "%{$query}%")->get();
        $typologies = Typology::where('name', 'like', "%{$query}%")->get();
        $classifications = Classification::where('name', 'like', "%{$query}%")->get();



        return view('search.index', compact('references', 'rules', 'typologies', 'classifications'));
    }

    public function advancedSearch(Request $request)
    {
        $type = $request->input('type');
        $categories = TypologyCategory::all();
        $states = Status::all();
        $triggers = Trigger::all();
        $sorts = Sort::all();
        $actives = Active::all();
        $articles = Articles::all()->where('country_id', '=', Auth::user()->country_id);
        $countries = Country::orderBy('name')->get();
        $activities = Classification::all();
        $query = $request->input('query');

        $results = [];

        switch ($type) {
            case 'activity':
                $results = Classification::where('name', 'like', "%{$query}%")->get();
                break;
            case 'basket':
                $results = Basket::where('name', 'like', "%{$query}%")->get();
                break;
            case 'mission':
                $results = Classification::where('name', 'like', "%{$query}%")->get();
                break;
            case 'reference':
                $results = Reference::where('name', 'like', "%{$query}%")->get();
                break;
            case 'rule':
                $results = Rule::where('name', 'like', "%{$query}%")->get();
                break;
            case 'typology':
                $results = Typology::where('name', 'like', "%{$query}%")->get();
                break;
        }

        return view('search.advanced', compact(
            'results',
            'type',
            'categories',
            'states',
            'triggers',
            'sorts',
            'actives',
            'articles',
            'countries',
            'activities',
            'query'
        ));
    }


}
