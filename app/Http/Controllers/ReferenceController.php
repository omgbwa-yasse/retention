<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\basket;
use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\Country;
use App\Models\ReferenceFile;
use App\Models\ReferenceLink;
use App\Models\ReferenceCategory;
use Illuminate\Support\Facades\Auth;

class ReferenceController extends Controller
{


//    public function index()
//    {
//        $references = Reference::all();
//
//        $references->load('links', 'countries', 'articles', 'files');
//
//        return view('reference.referenceIndex', compact('references'));
//    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $references = Reference::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })->paginate(150);

        $baskets = Basket::all();

        return view('reference.referenceIndex', compact('references', 'baskets'));
    }

    public function addToBasket(Request $request)
    {
//        dd($request->all());
        $referenceId = $request->input('reference_id');
        $basketId = $request->input('basket_id');
        $reference = Reference::findOrFail($referenceId);
        $basket = Basket::findOrFail($basketId);

        // Vérifiez si l'élément existe déjà dans le panier
        if (!$basket->references()->where('reference_id', $reference->id)->exists()) {

            $basket->references()->attach($reference->id);
        }

        return redirect()->route('reference.referenceIndex')->with('success', 'Référence ajoutée au panier avec succès.');
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

        $validatedData['user_id'] = Auth::user()->id;
        $Reference = Reference::create($validatedData);
        return redirect()->route('reference.referenceIndex')->with('success', 'Référence créée avec succès');
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

        return redirect()->route('reference.referenceIndex')->with('success', 'La référence a été mise à jour avec succès.');
    }




    public function destroy(Reference $reference)
    {
        $error = '';

        if (!$reference->files->isEmpty() && !$reference->links->isEmpty() && !$reference->articles->isEmpty() && !$reference->sources->isEmpty()) {
            if (!$reference->files->isNotEmpty()) {
                $error .= 'Cannot delete reference with associated files. ';
            }
            if (!$reference->links->isNotEmpty()) {
                $error .= 'Cannot delete reference with associated links. ';
            }
            if (!$reference->articles->isNotEmpty()) {
                $error .= 'Cannot delete reference with associated articles. ';
            }

            $error = rtrim($error, '. ');
            $error .= '.';

            return redirect()->route('reference.referenceIndex')->with('error', $error);
        }

        $reference->delete();

        return redirect()->route('reference.referenceIndex')->with('success', 'La référence a été supprimée avec succès.');
    }


}
