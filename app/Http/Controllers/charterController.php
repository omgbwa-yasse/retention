<?php

namespace App\Http\Controllers;
use App\Models\classification;
use Illuminate\Http\Request;

class charterController extends Controller
{
    public function index(){
        $country = 'Cameroun';
        $domaines = classification::all()->whereNull('parent_id');
        return view('charter.index', compact('country', 'domaines'));
    }
}
