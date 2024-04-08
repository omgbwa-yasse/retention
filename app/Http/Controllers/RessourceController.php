<?php

namespace App\Http\Controllers;
use App\Models\Ressource;
use App\Models\Reference;
use Illuminate\Http\Request;

class RessourceController extends Controller
{




    public function index()
    {
        $ressources = Ressource::with('references')->get();
        return view('ressource.index', compact('ressources'));
    }





    public function create($referenceId)
    {
        $reference = Reference::findOrFail($referenceId);
        $references = Reference::pluck('title', 'id');
        return view('ressource.create', compact('reference', 'references'));
    }





    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'nullable|max:500',
            'link' => 'nullable|url',
            'file_path' => 'required|file|max:2048',
            'reference_id' => 'required|exists:reference,id',
        ]);

        $file = $request->file('file_path');
        $filePath = $file->store('public/ressources');
        $fileCrypt = $file->hashName();

        $ressource = Ressource::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'file_path' => $filePath,
            'file_crypt' => $fileCrypt,
        ]);

        $reference = Reference::find($request->reference_id);
        $reference->ressources()->attach($ressource->id);

        return redirect()->route('ressource.index')->with('success', 'Ressource créée avec succès.');
    }






    public function edit(Ressource $ressource)
    {
        $references = Reference::pluck('title', 'id');
        return view('ressource.edit', compact('ressource', 'references'));
    }





    public function update(Request $request, Ressource $ressource)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'nullable|max:500',
            'link' => 'nullable|url',
            'file_path' => 'nullable|file|max:2048',
            'reference_id' => 'required|exists:reference,id',
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filePath = $file->store('public/ressources');
            $fileCrypt = $file->hashName();

            $ressource->update([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
                'file_path' => $filePath,
                'file_crypt' => $fileCrypt,
            ]);
        } else {
            $ressource->update([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ]);
        }

        $reference = Reference::find($request->reference_id);
        $ressource->references()->sync([$reference->id]);

        return redirect()->route('ressource.index')->with('success', 'Ressource mise à jour avec succès.');
    }






    public function destroy(Ressource $ressource)
    {
        $ressource->delete();
        return redirect()->route('ressource.index')->with('success', 'Ressource supprimée avec succès.');
    }
}


