<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('english_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('english_content_id')->constrained('english_contents')->cascadeOnDelete();
            $table->string('type', 30)->default('item');
            $table->integer('sort_order')->default(0);
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('tag', 60)->nullable();
            $table->string('date_text', 60)->nullable();
            $table->string('link')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['english_content_id', 'sort_order']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('english_items');
    }
};
