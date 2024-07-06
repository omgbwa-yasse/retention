<?php

namespace App\Exports;

use App\Models\Classification;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ActivitiesExport implements FromView
{
    public function view(): View
    {
        $activities = Classification::all();

        return view('activity.pdf', compact('activities'));
    }
}


