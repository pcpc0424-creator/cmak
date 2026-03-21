<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('english_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('title');
            $table->longText('content');
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('view_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('english_contents');
    }
};
