<?php

namespace App\Http\Controllers;

use App\Models\Active;
use App\Models\Articles;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Reference;
use App\Models\Rule;
use App\Models\Sort;
use App\Models\Status;
use App\Models\Trigger;
use App\Models\Typology;
use App\Models\TypologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $references = Reference::where('name', 'like', "%{$query}%")->get();
        $rules = Rule::where('name', 'like', "%{$query}%")->get();
        $typologies = Typology::where('name', 'like', "%{$query}%")->get();
        $classifications = Classification::where('name', 'like', "%{$query}%")->get();



        return view('search.index', compact('references', 'rules', 'typologies', 'classifications'));
    }

    public function advancedSearch(Request $request)
    {
        $type = $request->input('type');
        $categories = TypologyCategory::all();
        $states = Status::all();
        $triggers = Trigger::all();
        $sorts = Sort::all();
        $actives = Active::all();
        $articles = Articles::all()->where('country_id', '=', Auth::user()->country_id);
        $countries = Country::orderBy('name')->get();
        $activities = Classification::all();

        $name = $request->input('name');
        $description = $request->input('description');
        $code = $request->input('code');
        $parent_id = $request->input('parent_id');
        $country_id = $request->input('country_id');
        $ref_code = $request->input('ref_code');
        $ref_type = $request->input('ref_type');
        $rule_code = $request->input('rule_code');
        $rule_category = $request->input('rule_category');
        $typology_code = $request->input('typology_code');
        $typology_category = $request->input('typology_category');
        $basket_code = $request->input('basket_code');
        $basket_type = $request->input('basket_type');

        $results = [];

        switch ($type) {
            case 'activity':
                $results = Classification::where(function ($query) use ($name, $description, $code, $parent_id, $country_id) {
                    if ($name) $query->where('name', 'like', "%{$name}%");
                    if ($description) $query->where('description', 'like', "%{$description}%");
                    if ($code) $query->where('code', 'like', "%{$code}%");
                    if ($parent_id) $query->where('parent_id', $parent_id);
                    if ($country_id) $query->where('country_id', $country_id);
                })->get();
                break;
            case 'basket':
                $results = Basket::where(function ($query) use ($name, $description, $basket_code, $basket_type) {
                    if ($name) $query->where('name', 'like', "%{$name}%");
                    if ($description) $query->where('description', 'like', "%{$description}%");
                    if ($basket_code) $query->where('code', 'like', "%{$basket_code}%");
                    if ($basket_type) $query->where('type_id', $basket_type);
                })->get();
                break;
            case 'reference':
                $results = Reference::where(function ($query) use ($name, $description, $ref_code, $ref_type) {
                    if ($name) $query->where('name', 'like', "%{$name}%");
                    if ($description) $query->where('description', 'like', "%{$description}%");
                    if ($ref_code) $query->where('code', 'like', "%{$ref_code}%");
                    if ($ref_type) $query->where('category_id', $ref_type);
                })->get();
                break;
            case 'rule':
                $results = Rule::where(function ($query) use ($name, $description, $rule_code, $rule_category) {
                    if ($name) $query->where('name', 'like', "%{$name}%");
                    if ($description) $query->where('description', 'like', "%{$description}%");
                    if ($rule_code) $query->where('code', 'like', "%{$rule_code}%");
                    if ($rule_category) $query->where('status_id', $rule_category);
                })->get();
                break;
            case 'typology':
                $results = Typology::where(function ($query) use ($name, $description, $typology_code, $typology_category) {
                    if ($name) $query->where('name', 'like', "%{$name}%");
                    if ($description) $query->where('description', 'like', "%{$description}%");
                    if ($typology_code) $query->where('code', 'like', "%{$typology_code}%");
                    if ($typology_category) $query->where('category_id', $typology_category);
                })->get();
                break;
        }

        return view('search.advanced', compact(
            'results',
            'type',
            'categories',
            'states',
            'triggers',
            'sorts',
            'actives',
            'articles',
            'countries',
            'activities'
        ));
    }




}
