<?php

namespace App\Http\Controllers;
use App\Models\Basket;
use App\Models\BasketType;
use App\Models\Activity;
use App\Models\Reference;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index()
    {
        $baskets = Basket::with('references', 'rules', 'activities')->get();
        return view('basket.index', compact('baskets'));
    }


    public function addToBasket(Request $request, Reference $reference)
    {
        $basketId = $request->input('basket_id');
        $basket = Basket::findOrFail($basketId);
        if (!$basket->references()->where('reference_id', $reference->id)->exists()) {
            $basket->references()->attach($reference->id);
        }
        return redirect()->route('reference.index')->with('success', 'Référence ajoutée au panier avec succès.');
    }




    public function showBasket(Basket $basket)
    {
        $references = $basket->references;
        return view('basket.show', compact('basket', 'references'));
    }



    public function create()
    {
        $basketTypes = BasketType::all();
        $activities = Activity::all();
        $references = Reference::all();
        $rules = Rule::all();
        return view('basket.create', compact('basketTypes', 'classifications', 'references', 'rules'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:baskets',
            'description' => 'nullable|string',
            'type_id' => 'nullable|exists:basket_types,id'
        ]);
        $basket = Basket::create([
            'name' => $request->name,
            'description' => $request->description,
            'type_id' => $request->type_id,
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);
        return redirect()->route('basket.index')->with('success', 'Basket created successfully.');
    }




    public function show(Basket $basket)
    {
        $basket->load('type');
        return view('basket.show', compact('basket'));
    }





    public function edit(Basket $basket)
    {
        $basketTypes = null;
        if ($basket->doesntHave('classes') && $basket->doesntHave('rules') && $basket->doesntHave('references')) {
            $basketTypes = BasketType::all();
        }
        $classifications = Activity::all();
        $references = Reference::all();
        $rules = Rule::all();
        return view('basket.edit', compact('basket', 'basketTypes', 'classifications', 'references', 'rules'));
    }


    public function update(Request $request, Basket $basket)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:baskets,name,'.$basket->id,
            'description' => 'nullable|string',
            'basket_type_id' => 'nullable|exists:basket_types,id',
            'classification_ids' => 'nullable|array|exists:classifications,id',
            'reference_ids' => 'nullable|array|exists:references,id',
            'rule_ids' => 'nullable|array|exists:rules,id',
        ]);

        $basket->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->has('basket_type_id')) {
            // TODO: Implement basket type association
        }

        if ($request->has('activitity_ids')) {
            $basket->activities()->sync($request->activity_ids);
        }

        if ($request->has('reference_ids')) {
            $basket->references()->sync($request->reference_ids);
        }

        if ($request->has('rule_ids')) {
            $basket->rules()->sync($request->rule_ids);
        }

        return redirect()->route('basket.index')->with('success', 'Basket updated successfully.');
    }


    public function destroy(Basket $basket)
    {
        if ($basket->whereHas('classes')->count() > 0 &&
            $basket->whereHas('rules')->count() > 0 &&
            $basket->whereHas('references')->count() > 0){
            return redirect()->route('basket.index')->with('error', 'Cannot delete basket because it has related classifications, rules and references.');
        }
        $basket->delete();
        return redirect()->route('basket.index')->with('success', 'Basket deleted successfully.');
    }



}
