<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('related_sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_type')->default('domestic');
            $table->string('site_name');
            $table->string('site_url');
            $table->string('logo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('related_sites');
    }
};
