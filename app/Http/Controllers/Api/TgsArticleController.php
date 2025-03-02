<?php

namespace Modules\Tgs\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Article\Models\TextServiceArticle;
use Modules\Tgs\Http\Requests\ArticleStoreRequest;
use Modules\Tgs\Models\TgsArticle;

class TgsArticleController extends Controller
{

    public function store(ArticleStoreRequest $request)
    {
        $imageName = '';
        if($request->input('selected_image'))
        {
            $image = Http::get($request->input('selected_image'))->body();
            $imageName = 'service_'.date("YmdH").uniqid().'.jpg';
            $imagePath = '/publication/'.$imageName;
            Storage::disk('public')->put($imagePath, $image);
        }

        $title = $request->input('title');
        $data = [
            'ai_article_id' => $request->input('id'),
            'title' => $title,
            'slug' => Str::slug($request->input('title')),
            'page_title' => $request->input('page_title')??$title,
            'type' => $request->input('type',1)??1,
            'status' => $request->input('status'),
            'prompt_image' => $request->input('prompt_image'),
            'image' => $imageName,
            'image_title' => $request->input('image_title'),
            'prompt_text' => $request->input('prompt'),
            'content' => $request->input('response'),
            'short_description' => $request->input('short_desc'),
            'source_title' => $request->input('source_title'),
            'source_url' => $request->input('source_url'),
            'published' => $request->input('scheduled_at'),
        ];

        TgsArticle::create($data);

        return response()->json([
            'success' => true,
            'data' => 'ok']);
    }

}
