<?php

namespace App\Exports;

use App\Models\Reference;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReferencesExport implements FromView
{
    protected $reference;

    public function __construct(Reference $reference)
    {
        $this->reference = $reference;
    }

    public function view(): View
    {
        return view('public.references.pdf', ['reference' => $this->reference]);
    }
}
