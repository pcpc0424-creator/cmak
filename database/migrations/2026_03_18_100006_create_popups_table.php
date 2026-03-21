<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('popup_type')->default('layer');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('image_path')->nullable();
            $table->string('link_url')->nullable();
            $table->integer('width')->default(400);
            $table->integer('height')->default(300);
            $table->integer('position_x')->default(100);
            $table->integer('position_y')->default(100);
            $table->boolean('is_active')->default(true);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popups');
    }
};
