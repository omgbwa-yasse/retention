<?php
namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class charterController extends Controller
{
    public function index()
    {
        $country = Country::find(Auth::user()->country_id);
        $domaines = Classification::with('childrenRecursive',
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
