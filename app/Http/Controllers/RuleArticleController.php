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
        ->whereDoesntHave('rules', function ($query) use ($ruleId) {
            $query->where('rule_id', $ruleId);
        })
        ->get();

        return view('rule.article.create', compact('rule', 'articles'));
    }



    public function store(Request $request, int $ruleId)
    {
        $rule = Rule::findOrFail($ruleId);

        $validatedData = $request->validate([
            'article_id' => 'required|exists:reference_articles,id',
        ]);

        RuleArticle::create([
            'rule_id' => $rule->id,
            'article_id' => $validatedData['article_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('rule.show', $rule->id)
            ->with('success', 'ReferenceArticle associé avec succès');
    }



    public function show($rule_id, $article_id)
    {
        $ruleArticle = RuleArticle::where('rule_id', $rule_id)->where('article_id', $article_id)->firstOrFail();
        return view('rule.article.edit', compact('ruleArticle'));
    }





    public function update(Request $request, $dulId, $articleId)
    {
        $dulArticle = RuleArticle::where('rule_id', $dulId)->where('reference_id', $articleId)->first();
        $dulArticle->update($request->all());
        return redirect()->back()->with('success', 'L\'association a été mise à jour avec succès.');
    }




    public function destroy(INT $ruleId, INT $articleId)
    {
        $rule = Rule::findOrFail($ruleId)->load('articles');
        if ($rule->articles()->detach($articleId)) {
            return redirect()->back()->with('success', 'L\'article a été détaché de la règle avec succès.');
        } else {
            return redirect()->back()->with('error', 'L\'association n\'a pas été trouvée.');
        }
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
