<?php

namespace App\Http\Controllers;
use App\Models\Basket;
use App\Models\BasketType;
use App\Models\Classification;
use App\Models\Reference;
use App\Models\Rule;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $baskets = Basket::with(['rules', 'classifications', 'references'])->get();
        return view('baskets.index', compact('baskets'));
    }




    public function create()
    {
        $basketTypes = BasketType::all();
        $classifications = Classification::all();
        $references = Reference::all();
        $rules = Rule::all();
        return view('baskets.create', compact('basketTypes', 'classifications', 'references', 'rules'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:baskets',
            'description' => 'nullable|string',
            'basket_type_id' => 'nullable|exists:basket_types,id',
            'classification_ids' => 'nullable|array|exists:classifications,id',
            'reference_ids' => 'nullable|array|exists:references,id',
            'rule_ids' => 'nullable|array|exists:rules,id',
        ]);

        $basket = Basket::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->has('basket_type_id')) {
            // TODO: Implement basket type association
        }

        if ($request->has('classification_ids')) {
            $basket->classifications()->sync($request->classification_ids);
        }

        if ($request->has('reference_ids')) {
            $basket->references()->sync($request->reference_ids);
        }

        if ($request->has('rule_ids')) {
            $basket->rules()->sync($request->rule_ids);
        }

        return redirect()->route('baskets.index')->with('success', 'Basket created successfully.');
    }




    public function show(Basket $basket)
    {
        return view('baskets.show', compact('basket'));
    }





    public function edit(Basket $basket)
    {
        $basketTypes = BasketType::all();
        $classifications = Classification::all();
        $references = Reference::all();
        $rules = Rule::all();
        return view('baskets.edit', compact('basket', 'basketTypes', 'classifications', 'references', 'rules'));
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

        if ($request->has('classification_ids')) {
            $basket->classifications()->sync($request->classification_ids);
        }

        if ($request->has('reference_ids')) {
            $basket->references()->sync($request->reference_ids);
        }

        if ($request->has('rule_ids')) {
            $basket->rules()->sync($request->rule_ids);
        }

        return redirect()->route('baskets.index')->with('success', 'Basket updated successfully.');
    }


    public function destroy(Basket $basket)
    {
        if ($basket->classifications()->whereHas('baskets')->count() > 0 &&
            $basket->rules()->whereHas('baskets')->count() > 0 &&
            $basket->references()->whereHas('baskets')->count() > 0){
            return redirect()->route('baskets.index')->with('error', 'Cannot delete basket because it has related classifications, rules and references.');
        }

        $basket->delete();
        return redirect()->route('baskets.index')->with('success', 'Basket deleted successfully.');
    }



}
