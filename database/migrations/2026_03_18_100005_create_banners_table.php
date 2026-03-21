<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('screen_type')->default('main');
            $table->string('page_type')->nullable();
            $table->string('title');
            $table->string('image_path')->nullable();
            $table->string('link_url')->nullable();
            $table->string('link_target')->default('_self');
            $table->boolean('is_active')->default(true);
            $table->integer('click_count')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
