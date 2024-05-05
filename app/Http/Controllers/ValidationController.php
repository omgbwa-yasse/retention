<?php

namespace App\Http\Controllers;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{

    public function index(Request $request)
    {
        $rules = Rule::where('country_id', '=', Auth::user()->country_id)->get();
        $rules->load('validator');
        return view('validation.index', compact('rules'));
    }


    public function show(INT $id)
    {
        $rule = rule::find($id);
        $rule->load('countries')->load('validator');
        return view('validation.show', compact('rule'));
    }


    public function update(Request $request,INT $id)
{
    $rule = Rule::findOrFail($id);
    if ($rule->status_id == 1 && ($request->status_id == 2 || $request->status_id == 3)) {
        $rule->update([
            'status_id' => $request->input('status_id'),
            'validated_at' => now(),
            'validated_by' => Auth::id()
        ]);
    } else {
        abort(404);
    }
    return redirect()->route('validation.index')->with('success', 'Activité mise à jour avec succès.');
}

}
