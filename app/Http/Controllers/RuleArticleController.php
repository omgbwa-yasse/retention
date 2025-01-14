<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuleArticle;

class RuleArticleController extends Controller
{

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'rule_id' => 'required|integer',
            'article_id' => 'required|integer',
        ]);

        RuleArticle::create($validatedData);

        return redirect()->back()->with('success', 'L\'association a été créée avec succès.');
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
