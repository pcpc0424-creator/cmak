<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('link_url')->nullable();
            $table->string('icon')->nullable();        // 이미지 없을 때 표시할 아이콘 키
            $table->string('image_path')->nullable();  // 카드 배경 이미지 (있으면 hover시 dim+텍스트)
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        $now = now();
        // [title, subtitle, link, icon] — 기존 우측 6개 카드 그대로 이관
        $cards = [
            ['CM관련서식', 'CM 업무 관련 서식', '/business/cm-forms', 'doc'],
            ['Book Review', '추천 도서', '/notice/bookreview', 'book'],
            ['Word Book', 'CM 용어집', '/notice/wordbook', 'search'],
            ['CM헤럴드', '월간 소식지', '/business/herald', 'monitor'],
            ['CM자료방', '논문·연구자료', '/cmdata/report', 'folder'],
            ['CM사 소개', '회원사 안내', '/intro/members', 'building'],
        ];
        $rows = [];
        foreach ($cards as $i => $c) {
            $rows[] = [
                'title' => $c[0],
                'subtitle' => $c[1],
                'link_url' => $c[2],
                'icon' => $c[3],
                'is_active' => true,
                'sort_order' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('home_cards')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('home_cards');
    }
};
