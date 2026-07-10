<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consma_editions', function (Blueprint $table) {
            $table->id();
            $table->string('year', 10);              // 연도 (예: 2026)
            $table->string('thumb_path')->nullable(); // 썸네일 이미지 경로
            $table->string('full_path')->nullable();  // 상세 포스터 이미지 경로
            $table->string('main_text')->nullable();  // 메인 텍스트(관리자 편집)
            $table->string('sub_text')->nullable();   // 보조 텍스트(관리자 편집)
            $table->string('detail_url')->nullable(); // 외부/레거시 상세 링크(선택)
            $table->text('detail_content')->nullable(); // 상세페이지 본문(선택, 에디터)
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consma_editions');
    }
};
