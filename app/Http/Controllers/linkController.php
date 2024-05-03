<?php

namespace App\Http\Controllers;
use App\Models\Reference;
use App\Models\ReferenceLink;
use Illuminate\Http\Request;

class LinkController extends Controller
{



    public function index(Reference $reference)
    {
        $links = $reference->links()->get();
        return view('reference.links.index', compact('reference', 'links'));
    }




    public function create(Reference $reference)
    {
        return view('reference.links.create', compact('reference'));
    }



    public function show(Reference $reference, ReferenceLink $link)
    {
        return view('reference.links.show', compact('reference', 'link'));
    }



    public function store(Request $request, Reference $reference)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'link' => 'nullable|string|max:255',
        ]);

        $reference->links()->create($validatedData);

        return redirect()->route('reference.link.index', $reference)->with('success', 'Link created successfully.');
    }




    public function edit(Reference $reference, ReferenceLink $link)
    {
        return view('reference.links.edit', compact('reference', 'link'));
    }




    public function update(Request $request, Reference $reference, ReferenceLink $link)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'link' => 'nullable|string|max:255',
        ]);

        $link->update($validatedData);

        return redirect()->route('reference.link.index', $reference)->with('success', 'Link updated successfully.');
    }




    public function destroy(Reference $reference, ReferenceLink $link)
    {
        $link->delete();
        return redirect()->route('reference.link.index', $reference)->with('success', 'Link deleted successfully.');
    }
}


