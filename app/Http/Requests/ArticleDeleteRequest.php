<?php

namespace Modules\Tgs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleDeleteRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {

        if (! is_array($this->articles) && ! is_null($this->articles)) {
            $this->merge([
                'articles' => json_decode($this->articles, true),
            ]);
        }

    }
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'articles' => ['required','array'],
            'articles.*' => ['required','exists:tgs_articles,id'],
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
