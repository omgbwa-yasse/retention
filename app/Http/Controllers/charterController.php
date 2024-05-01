<?php

namespace App\Http\Controllers;
use App\Models\classification;
use Illuminate\Http\Request;
use App\Models\country;
use Illuminate\Support\Facades\Auth;

class charterController extends Controller
{
    public function index(){
        $country = country::find(Auth::user()->country_id);
        $domaines = classification::all()->whereNull('parent_id');
        $domaines->load('rules');
        return view('charter.index', compact('country', 'domaines'));
    }
}
