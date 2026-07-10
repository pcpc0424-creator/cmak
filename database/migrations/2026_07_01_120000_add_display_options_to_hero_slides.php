<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->boolean('show_eyebrow')->default(true)->after('eyebrow'); // 상단 라벨 표시 여부
            $table->boolean('title_bold')->default(true)->after('highlight'); // 강조문구 볼드 여부
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['show_eyebrow', 'title_bold']);
        });
    }
};
