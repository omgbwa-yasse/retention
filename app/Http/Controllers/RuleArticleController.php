<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuleArticle;
use App\Models\ReferenceArticle;
use App\Models\Rule;

class RuleArticleController extends Controller
{



    public function create(int $ruleId)
    {
        $rule = Rule::findOrFail($ruleId);

        $articles = ReferenceArticle::whereHas('reference', function ($query) {
            $query->where('country_id', auth()->user()->country_id);
        })
        ->get();

        return view('rule.article.create', compact('rule', 'articles'));
    }



    public function store(Request $request, int $ruleId)
    {
        $rule = Rule::findOrFail($ruleId);

        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
        ]);

        RuleArticle::create([
            'rule_id' => $rule->id,
            'article_id' => $validatedData['article_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('rule.show', $rule->id)
            ->with('success', 'ReferenceArticle associé avec succès');
    }



    public function show($reference_id, $article_id)
    {
        $article = ReferenceArticle::where('reference_id', $reference_id)->where('id', $article_id)->first();
        $article = $article->load('reference');
        $reference = $article->reference;
        return view('reference.articles.show', compact( 'article','reference'));

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
