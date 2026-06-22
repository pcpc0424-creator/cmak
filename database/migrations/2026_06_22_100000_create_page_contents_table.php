<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();          // 예: business.membership
            $table->string('menu')->default('협회업무'); // 메뉴 그룹
            $table->string('page_title')->nullable();   // 화면 제목(H1)
            $table->string('browser_title')->nullable();// 브라우저 타이틀
            $table->string('category')->nullable();     // 상단 카테고리 라벨
            $table->string('category_link')->nullable();// 카테고리 링크
            $table->longText('content')->nullable();    // 본문 HTML
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
