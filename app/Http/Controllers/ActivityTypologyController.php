<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Typology;
use Illuminate\Http\Request;

class ActivityTypologyController extends Controller
{
    public function index(Classification $activity)
    {
        $activity->load('typologies');
        return view('activity.typology.index', compact('activity'));
    }





    public function create(Classification $activity){
        $typologies = Typology::all();
        return view('activity.typology.create', compact('activity', 'typologies'));
    }




    public function update(Request $request, Classification $activity)
    {
        $request->validate([
            'typology_ids' => 'required|array',
        ]);

        $activity->typologies()->sync($request->input('typology_ids'));

        return redirect()->route('activity.typology.index', $activity)->with('success', 'Typologies have been updated.');
    }




    public function store(Request $request, Classification $activity)
    {
        $request->validate([
            'typology_ids' => 'required|exists:typologies,id',
        ]);

        $activity->typologies()->sync($request->input('typology_ids'));

        return redirect()->route('activity.typology.index', $activity)->with('success', 'Typologies have been added to the activity.');
    }






    public function destroy(Classification $activity, Typology $typology)
    {
        if ($typology->activitys()->count() > 0) {
            return redirect()->back()->with('error', 'Typology cannot be deleted because it is associated with one or more activitys.');
        }

        $activity->typologies()->detach($typology);

        return redirect()->route('activity.typology.index', $activity)->with('success', 'Typology has been removed.');
    }
}
