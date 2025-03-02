<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tgs_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ai_article_id')->index();
            $table->string("title",160);
            $table->string("slug",160);
            $table->string("page_title",160);
            $table->tinyInteger('type')->default(1);
            $table->string('status')->default('new');
            $table->text('prompt_image')->nullable();
            $table->string("image",160)->nullable();
            $table->string("image_title")->nullable();
            $table->text("prompt_text")->nullable();
            $table->text("content")->nullable();
            $table->text("short_description")->nullable();
            $table->string("source_title")->nullable();
            $table->string("source_url")->nullable();
            $table->timestamp('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tgs_articles');
    }
};
