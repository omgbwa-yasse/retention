<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\Country;
use App\Models\ReferenceFile;
use App\Models\ReferenceLink;
use App\Models\ReferenceCategory;

class ReferenceController extends Controller
{


    public function index()
    {
        $references = Reference::select(
            'references.id',
            'references.name',
            'references.description',
            'references.category_id',
            'references.country_id',
            'reference_categories.name AS category_name',
            'countries.name AS country_name'
        )
        ->leftJoin('reference_categories', 'references.category_id', '=', 'reference_categories.id')
        ->leftJoin('countries', 'references.country_id', '=', 'countries.id')
        ->leftJoin('reference_files', 'references.id', '=', 'reference_files.reference_id')
        ->leftJoin('reference_links', 'references.id', '=', 'reference_links.reference_id')
        ->get();

        $references->load('links', 'countries', 'articles', 'files');

        return view('reference.referenceIndex', compact('references'));
    }



    public function show(Reference $reference)
    {
        $articles = $reference->articles;
        return view('reference.referenceShow', compact('reference', 'articles'));
    }



    public function create()
    {
        $categories = ReferenceCategory::all();
        $countries = Country::all();
        return view('reference.referenceCreate', compact('categories', 'countries'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:500|unique:references',
            'description' => 'nullable|string|max:500',
            'category_id' => 'required|exists:reference_categories,id',
            'country_id' => 'required|exists:countries,id',
        ]);

        Reference::create($validatedData)->save();

        return redirect()->route('reference.index')->with('success', 'Référence créée avec succès');
    }




    public function edit($id)
    {
        $references = Reference::findOrFail($id);
        $categories = ReferenceCategory::all();
        return view('reference.referenceEdit', compact('references', 'categories'));
    }






    public function update(Request $request, $id)
    {



        $validatedData = $request->validate([
            'name' => 'required|max:500|unique:references,name,'.$id,
            'description' => 'nullable|max:500',
            'category_id' => 'required|exists:reference_categories,id',
            'files.*' => 'file|max:20240',
            'links.*' => 'url|max:255',
        ]);


        $reference = Reference::findOrFail($id);
        $reference->update($validatedData);

        $reference->files()->delete();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $file->store('public/files');
                ReferenceFile::create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $file->store('public/files'),
                    'reference_id' => $reference->id,
                ]);
            }
        }

        $reference->links()->delete();

        if ($request->has('links')) {
            foreach ($request->links as $link) {
                ReferenceLink::create([
                    'name' => $link['name'],
                    'link' => $link['url'],
                    'reference_id' => $reference->id,
                ]);
            }
        }

        return redirect()->route('reference.index')->with('success', 'La référence a été mise à jour avec succès.');
    }





    public function destroy(Reference $reference)
    {
        if (!$reference->files->isEmpty() && !$reference->links->isEmpty() && !$reference->articles->isEmpty()) {
            throw new \Exception('Cannot delete reference with associated records.');
        }

        $reference->delete();

        return redirect()->route('reference.index')->with('success', 'La référence a été supprimée avec succès.');
    }




}
