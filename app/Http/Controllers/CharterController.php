<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassesExport;
use App\Models\Classification;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharterController extends Controller
{
    public function index()
    {
        $country = Country::find(Auth::user()->country_id);

        $domaines = Classification::with('childrenRecursive',
            'rules.articles',
            'typologies')
            ->whereNull('parent_id')
            ->where('country_id', $country->id)
            ->get();

        return view('charter.index', compact('country', 'domaines'));
    }

    public function exportExcel($domaineId)
    {
        $domaine = Classification::with('childrenRecursive',
            'rules.articles',
            'typologies')
            ->find($domaineId);

        return Excel::download(new ClassesExport($domaine), 'domaine.xlsx');
    }



    public function printPdf($domaineId)
    {
        $domaine = Classification::with('childrenRecursive',
            'rules.articles',
            'typologies')
            ->find($domaineId);

        $pdf = PDF::loadView('charter.pdf', compact('domaine'));
        return $pdf->download('domaine.pdf');
    }
}
