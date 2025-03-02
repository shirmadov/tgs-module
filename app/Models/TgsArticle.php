<?php

namespace Modules\Tgs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Tgs\Enums\ArticleTypeEnum;

// use Modules\Tgs\Database\Factories\TgsArticleFactory;

class TgsArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        "ai_article_id",
        "title",
        "slug",
        "page_title",
        "type",
        "status",
        "prompt_image",
        "image",
        "image_title",
        "prompt_text",
        "content",
        "short_description",
        "source_title",
        "source_url",
        'published',
    ];

    protected $casts = [
        'type' => ArticleTypeEnum::class,
    ];

    public function getTypeLabelAttribute(): string
    {
        return $this->type->getLabel();
    }
}
