<?php

namespace Modules\Tgs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Tgs\Http\Requests\ArticleDeleteRequest;
use Modules\Tgs\Models\TgsArticle;
use Modules\Tgs\Http\Requests\ArticleUpdateRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = TgsArticle::all();
        return view('tgs::tgs.index', compact('articles'));
    }

    public function show(TgsArticle $article)
    {
        return view('tgs::tgs.show',compact('article'));
    }

    public function edit(TgsArticle $article)
    {
        return view('tgs::tgs.edit', compact('article'));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = TgsArticle::find($id);
        $article->update($request->validated());
        return redirect()->route('tgs.article.index');
    }

    public function destroy(TgsArticle $article)
    {
        $article->delete();
        return redirect()->route('tgs.article.index');
    }

    public function deleteArticles(ArticleDeleteRequest $article)
    {
        foreach ($article->input('articles') as $article){
            TgsArticle::where('id', $article)->delete();
        }
        return redirect()->route("tgs.article.index");
    }

    public function accept(Request $request,TgsArticle $article)
    {
        $article->update(['status'=>$request->input('status','rejected')]);
        return redirect()->route('tgs.article.index');
    }
}
