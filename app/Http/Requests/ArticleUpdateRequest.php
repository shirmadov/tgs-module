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
            "extra_fields"=>["nullable","array"],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation(): void
    {
        //[{"role": "text", "value": "Sapa", "field_name": "first_name", "field_label": "Имя"}, {"role": "textarea", "value": "My name is Shirmadov", "field_name": "desc", "field_label": "Описание"}]
//        dd($this->extra_fields);
//        $this->replace(['extra_fields' => [
//            'role'=>'text',
//            'field_name'=>'text',
//            'role'=>'text',
//        ]
//        ]);
    }
}
