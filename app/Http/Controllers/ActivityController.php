<?php

namespace App\Http\Controllers;
use App\Exports\ActivitiesExport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Country;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class ActivityController extends Controller
{

    public function index(Request $request)
    {
        $countryId = Auth::user()->country_id;

        $search = $request->input('search');

        $items = Activity::whereNot('parent_id')
            ->where('country_id', $countryId)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('code')
            ->with('children', 'country', 'user')
            ->paginate(2);

        $country = Country::find($countryId);

        return view('activity.activityIndex', compact('items', 'country'));
    }



    public function pdf(Request $request)
    {
        $search = $request->input('search');

        $activities = Activity::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('activity.pdf', compact('activities'));
    }


    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $auth = Auth::user();
        $countryId = Auth::user()->country_id;
        $activities = Activity::where('country_id', $countryId)->orderBy('code')->get();
        return view('activity.activityCreate', compact('activities', 'auth'));
    }





    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:classifications,id',
            'country_id' => 'required|exists:countries,id',
        ]);

        $parent = Activity::findOrFail($request->parent_id);
        $code = $parent->code . $request->input('code');

        Activity::create([
            'code' => $code,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $parent->id,
            'country_id' => $request->country_id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('activity.index')->with('success', 'Item created successfully.');
    }





    // Affiche un élément spécifique
    public function show($id)
    {
        $activity = Activity::findOrFail($id)->with('parent','typologies','rules')->first();
        $parentName = $activity->parent ? $activity->parent->name : 'No parent';
        return view('activity.activityShow', compact('activity', 'parentName'));

    }





    // Affiche le formulaire de modification d'un élément
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        $activities = Activity::orderBy('code')->get();
        return view('activity.activityEdit', compact('activity', 'activities'));
    }




    // Met à jour un élément spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:classifications,id'
        ]);

        $item = Activity::findOrFail($id);
        $item->code = $request->input('code');
        $item->name = $request->input('name');
        $item->parent_id = $request->input('parent_id');
        $item->save();

        return redirect()->route('activity.index')->with('success', 'Item updated successfully.');
    }




    public function destroy($id)
    {
        $classification = Activity::findOrFail($id);

        if ($classification->children->isNotEmpty()) {
            return back()->with('error', 'Impossible de supprimer cette classification. Elle a des enfants. Veuillez supprimer les enfants d\'abord.');
        }

        $classification->delete();

        return redirect()->route('activity.index')->with('success', 'Élément supprimé avec succès.');
    }

    public function map($activity): array
    {
        return [
            $activity->code,
            $activity->name,
            $activity->description,
            $activity->parent ? $activity->parent->name : '',
            $activity->children ? $activity->children->count() : '',
            $activity->countries->name,
        ];
    }



    public function export()
    {
        $activities = Activity::all();

        $pdf = PDF::loadView('activity.pdf', compact('activities'));

        return $pdf->download('activities.pdf');
    }
}
