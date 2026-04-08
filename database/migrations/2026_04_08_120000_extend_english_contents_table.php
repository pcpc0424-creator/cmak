<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('english_contents', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('id')->unique();
            $table->string('description')->nullable()->after('title');
            $table->string('eyebrow')->nullable()->after('description');
            $table->string('hero_image')->nullable()->after('eyebrow');
            // make content nullable since it's an override
            $table->longText('content')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('english_contents', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'description', 'eyebrow', 'hero_image']);
            $table->longText('content')->nullable(false)->change();
        });
    }
};
