<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Reference;
use App\Models\Rule;
use App\Models\Typology;
use Illuminate\Http\Request;

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

}
