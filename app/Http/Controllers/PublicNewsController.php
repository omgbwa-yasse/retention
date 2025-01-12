<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;

class PublicNewsController extends Controller
{

    public function index()
    {
        $items = News::all();
        return view('public.news.index', compact('items'));
    }




    // Afficher le formulaire de création
    public function create()
    {
        return view('public.news.create');
    }




    // Enregistrer un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        News::create($request->all());
        return redirect()->route('public.news.index')->with('success', 'News created successfully.');
    }




    // Afficher un élément spécifique
    public function show(News $news)
    {
        return view('public.news.show', compact('news'));
    }




    // Afficher le formulaire d'édition
    public function edit(News $news)
    {
        return view('public.news.edit', compact('news'));
    }




    // Mettre à jour un élément
    public function update(Request $request, News $news)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $news->update($request->all());
        return redirect()->route('public.news.index')->with('success', 'News updated successfully.');
    }




    // Supprimer un élément
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('public.news.index')->with('success', 'News deleted successfully.');
    }
}
