<?php

namespace Modules\Tgs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Tgs\Http\Requests\ArticleDeleteRequest;
use Modules\Tgs\Models\TgsArticle;
use Modules\Tgs\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\Storage;
class ArticleController extends Controller
{
    public function index()
    {
        $articles = TgsArticle::all();
        return view('tgs::tgs.index', compact('articles'));
    }

    public function show(TgsArticle $article)
    {
        $modulePath = base_path('modules/Tgs/resources/assets/field/field_settings.json');
        $fields = [];
        if (file_exists($modulePath)) {
            $fields = json_decode(file_get_contents($modulePath), true);
        }
        return view('tgs::tgs.show',compact('article','fields'));
    }

    public function edit(TgsArticle $article)
    {
        $modulePath = base_path('modules/Tgs/resources/assets/field/field_settings.json');
        $fields = [];
        if (file_exists($modulePath)) {
            $fields = json_decode(file_get_contents($modulePath), true);
        }
        return view('tgs::tgs.edit', compact('article','fields'));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $data = $request->validated();
        if (!empty($data["image"])) {
            $data["image"] = basename(Storage::disk('module_storage')->putFileAs(
                'publication',
                $data["image"],
                date("YmdH") . uniqid() . "." . $data["image"]->extension()
            ));
        }
        TgsArticle::findOrFail($id)->update($data);

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
//        [{"role": "text", "field_name": "first_name", "field_label": "Имя", "value": "Sapa"}, {"role": "textarea", "field_name": "desc", "field_label": "Описание","value": "My name is Shirmadov"}]
        $article->update(['status'=>$request->input('status','rejected')]);
        return redirect()->route('tgs.article.index');
    }
}
