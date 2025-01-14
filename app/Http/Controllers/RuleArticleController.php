<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuleArticle;
use App\Models\Article;
use App\Models\Rule;

class RuleArticleController extends Controller
{


    public function create(int $ruleId)
    {
        $rule = Rule::findOrFail($ruleId);
        $articles = Article::whereHas('reference', function ($query) {
            $query->where('country_id', Auth()->User()->country_id);
        })->get();
        return view('ruleArticle.create', compact('rule', 'articles'));
    }

    public function store(Request $request, INT $rule_id)
    {
        $rule = Rule::find($rule_id);
        // Valider les données entrantes
        $validatedData = $request->validate([
            'rule_id' => 'required|integer|exists:rules,id',
            'article_id' => 'required|integer|exists:articles,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // Créer une nouvelle instance de RuleArticle
        $ruleArticle = new RuleArticle();
        $ruleArticle->rule_id =  $rule->id;
        $ruleArticle->article_id = $validatedData['article_id'];
        $ruleArticle->user_id = Auth()->User()->id;
        $ruleArticle->save();

        // Récupérer l'instance de Rule associée
        $rule = Rule::find($validatedData['rule_id']);

        // Rediriger vers la route rule.show avec l'ID de la règle
        return redirect()->route('rule.show', $rule->id);
    }




    public function show($dulId, $articleId)
    {
        $dulArticle = RuleArticle::where('rule_id', $dulId)->where('reference_id', $articleId)->first();
        $dulArticle = $dulArticle->load('rules','articles');
        return redirect()->route('reference.article.index', $articleId)->with('success', 'Articles updated successfully.');

    }





    public function update(Request $request, $dulId, $articleId)
    {
        $dulArticle = RuleArticle::where('rule_id', $dulId)->where('reference_id', $articleId)->first();
        $dulArticle->update($request->all());
        return redirect()->back()->with('success', 'L\'association a été mise à jour avec succès.');
    }




    public function destroy($dulId, $articleId)
    {
        RuleArticle::where('rule_id', $dulId)->where('reference_id', $articleId)->delete();
        return redirect()->back()->with('success', 'L\'association a été supprimée avec succès.');
    }


    public function edit($dulId, $articleId)
    {

        $dulArticle = RuleArticle::where('rule_id', $dulId)->where('reference_id', $articleId)->first();
        if (!$dulArticle) {
            return redirect()->back()->with('error', 'L\'association n\'a pas été trouvée.');
        }
        return view('rule_articles.edit', compact('dulArticle'));
    }


}
