<?php

namespace App\Http\Controllers;
use App\Exports\ActivitiesExport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\Country;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class ActivityController extends Controller
{

    public function index(Request $request)
    {
        $countryId = Auth::user()->country_id;

        $search = $request->input('search');

        $items = Classification::whereNot('parent_id')
            ->where('country_id', $countryId)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('code')
            ->with('children', 'country', 'user')
            ->paginate(30);

        $country = Country::find($countryId);

        return view('activity.index', compact('items', 'country'));
    }



    public function pdf(Request $request)
    {
        $search = $request->input('search');

        $activities = Classification::query()
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
        $activities = Classification::where('country_id', $countryId)->orderBy('code')->get();
        return view('activity.create', compact('activities', 'auth'));
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

        $parent = Classification::findOrFail($request->parent_id);
        $code = $parent->code . $request->input('code');

        Classification::create([
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
        $activity = Classification::findOrFail($id)->with('parent','typologies','rules')->first();
        $parentName = $activity->parent ? $activity->parent->name : 'No parent';
        return view('activity.show', compact('activity', 'parentName'));

    }





    // Affiche le formulaire de modification d'un élément
    public function edit($id)
    {
        $activity = Classification::findOrFail($id);
        $activities = Classification::orderBy('code')->get();
        return view('activity.edit', compact('activity', 'activities'));
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

        $item = Classification::findOrFail($id);
        $item->code = $request->input('code');
        $item->name = $request->input('name');
        $item->parent_id = $request->input('parent_id');
        $item->save();

        return redirect()->route('activity.index')->with('success', 'Item updated successfully.');
    }




    public function destroy(INT $id)
    {
        $classification = Classification::findOrFail($id);
        if($classification->children->count()>0){
            return redirect()->route('activity.index')->with('error', 'Impossible de supprimer cet élément.');
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
        $activities = Classification::all();

        $pdf = PDF::loadView('activity.pdf', compact('activities'));

        return $pdf->download('activities.pdf');
    }
}
