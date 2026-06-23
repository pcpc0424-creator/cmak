<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('herald_issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');                    // 호수 라벨 (예: 2026년 6월호 / 제120호)
            $table->date('issue_date')->nullable();     // 발행일
            $table->string('cover_image')->nullable();  // 표지 썸네일
            $table->string('webzine_url')->nullable();  // 웹진보기 링크 (외부 e-book 또는 업로드 PDF 경로)
            $table->text('description')->nullable();     // 간단 설명
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('herald_issues');
    }
};
