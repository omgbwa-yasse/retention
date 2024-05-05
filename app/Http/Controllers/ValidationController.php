<?php

namespace App\Http\Controllers;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = Rule::where('country_id', '=', Auth::user()->country_id)->get();
        return view('validation.index', compact('rules'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $rule = Rule::findOrFail($id);

        if ($id == 2 && $rule->id == 1) {
            $rule->update([
                'status_id' => $request->input('status_id'),
                'validated_at' => now(),
                'validated_by' => Auth::id()
            ]);
        } elseif ($id == 3 && $rule->id == 2) {
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
