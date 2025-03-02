<?php

namespace Modules\Tgs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "id"=>["required","integer"],
            "title"=>["required","string"],
            "page_title"=>["max:255","string",'nullable'],
            "short_desc"=>["string",'nullable'],
            "type"=>["integer",'nullable'],
            "image_title"=>["max:255","string",'nullable'],
            "source_title"=>["string",'nullable'],
            "source_url"=>["string",'nullable'],
            "prompt"=>["required","string"],
            "response"=>["required","string"],
            "selected_image"=>["required","string"],
            "status"=>["required","string"],
            "scheduled_at"=>["required","string"],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
