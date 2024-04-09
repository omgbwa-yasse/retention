<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\ReferenceFile;
use App\Models\ReferenceLink;
use App\Models\ReferenceCategory;

class ReferenceController extends Controller
{


    public function index()
    {
        $reference = Reference::select(
            'reference.id',
            'reference.title',
            'reference.description',
            'reference.category_id',
            'reference_category.id AS category_id'
        )
        ->leftJoin('reference_category', 'reference.category_id', '=', 'reference_category.id')
        ->leftJoin('reference_file', 'reference.id', '=', 'reference_file.reference_id')
        ->leftJoin('reference_link', 'reference.id', '=', 'reference_link.reference_id')
        ->get();

        return view('reference.referenceIndex', compact('reference'));
    }






    public function create()
    {
        $categories = ReferenceCategory::all();
        return view('reference.referenceCreate', compact('categories'));
    }






    public function store(Request $request)
{
    // Validation des données du formulaire
    $validatedData = $request->validate([
        'title' => 'required|max:50|unique:reference',
        'description' => 'nullable|max:500',
        'category_id' => 'required|exists:reference_category,id',

        /*
        'files.*' => 'file|max:10240', // Taille maximale de 10 Mo par fichier
        'links.*.title' => 'required|string|max:255',
        'links.*.url' => 'required|url|max:255',
        */
    ]);


    // Créer la référence
    $reference = Reference::create($validatedData);
    $reference->save();

    // Enregistrer les fichiers associés à la référence
    $filesSaved = false;
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filePath = $file->store('public/files'); // Enregistrer le fichier dans le stockage
            ReferenceFile::create([
                'title' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'reference_id' => $reference->id,
            ]);
        }
        $filesSaved = true;
    }

    // Enregistrer les liens associés à la référence
    $linksSaved = false;
    if ($request->has('links')) {
        foreach ($request->links as $link) {
            ReferenceLink::create([
                'title' => $link['title'],
                'link' => $link['url'],
                'reference_id' => $reference->id,
            ]);
        }
        $linksSaved = true;
    }

    $message = 'Référence enregistrée. ';
    if ($filesSaved) {
        $message .= 'Fichiers enregistrés. ';
    }
    if ($linksSaved) {
        $message .= 'Liens enregistrés. ';
    }

    return redirect()->route('reference.index')->with('success', $message);
}






    public function edit($id)
    {
        $reference = Reference::findOrFail($id);
        $categories = ReferenceCategory::all();
        return view('reference.referenceEdit', compact('reference', 'categories'));
    }






    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'title' => 'required|max:50|unique:references,title,'.$id,
            'description' => 'nullable|max:500',
            'category_id' => 'required|exists:reference_categories,id',
            'files.*' => 'file|max:10240', // Taille maximale de 10 Mo par fichier
            'links.*' => 'url|max:255', // Limite maximale de 255 caractères pour les liens
        ]);

        // Mettre à jour la référence
        $reference = Reference::findOrFail($id);
        $reference->update($validatedData);

        // Supprimer les anciens fichiers associés
        $reference->files()->delete();

        // Enregistrer les nouveaux fichiers associés à la référence
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $file->store('public/files'); // Enregistrer le fichier dans le stockage
                ReferenceFile::create([
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $file->store('public/files'),
                    'reference_id' => $reference->id,
                ]);
            }
        }

        // Supprimer les anciens liens associés
        $reference->links()->delete();

        // Enregistrer les nouveaux liens associés à la référence
        if ($request->has('links')) {
            foreach ($request->links as $link) {
                ReferenceLink::create([
                    'title' => $link['title'],
                    'link' => $link['url'],
                    'reference_id' => $reference->id,
                ]);
            }
        }

        return redirect()->route('reference.index')->with('success', 'La référence a été mise à jour avec succès.');
    }





    public function destroy($id)
    {
        $reference = Reference::findOrFail($id);
        $reference->delete();
        return redirect()->route('reference.index')->with('success', 'La référence a été supprimée avec succès.');
    }
}
