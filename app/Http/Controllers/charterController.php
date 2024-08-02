<?php

namespace App\Http\Controllers;

use App\Models\classification;
use App\Models\rule;
use Illuminate\Http\Request;
use App\Models\country;
use Illuminate\Support\Facades\Auth;

class charterController extends Controller
{
    public function index()
    {
        $country = country::find(Auth::user()->country_id);
        $domaines = classification::with('childrenRecursive',
            'rules.actives.trigger',
            'rules.duas.trigger',
            'rules.duls.trigger',
            'rules.articles',
            'typologies')
            ->whereNull('parent_id')
            ->get();

        return view('charter.index', compact('country', 'domaines'));
    }
}
