<?php

namespace Modules\Tgs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Tgs\Enums\ArticleTypeEnum;

class ArticleUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "title"=>["required","string"],
            "published"=>["required"],
            "image"=>["nullable","file"],
            "type"=>["required",Rule::in(ArticleTypeEnum::ALL),],
            "content"=>["required","string"],
            "short_description"=>["required","string"],
            "image_title"=>["nullable","string","max:100"],
            "source_title"=>["nullable","string","max:200"],
            "source_url"=>["nullable","string","max:200"],
            "page_title"=>["nullable","string","max:100"],
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
