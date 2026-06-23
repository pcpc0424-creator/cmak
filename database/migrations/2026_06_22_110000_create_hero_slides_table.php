<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();      // 상단 작은 라벨
            $table->string('title')->nullable();        // 제목(첫 줄)
            $table->string('highlight')->nullable();    // 강조 문구(둘째 줄)
            $table->string('image_path')->nullable();   // 배경 이미지 (예: images/banners/main_visual1.jpg)
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 기존 하드코딩 슬라이드 6종을 그대로 이관
        $now = now();
        $slides = [
            ['CMAK · Since 1996', '대한민국 건설사업관리의', '미래를 선도합니다', 'images/banners/main_visual1.jpg'],
            ['2026 CM 능력평가 공시', '신뢰받는 CM,', '능력으로 증명합니다', 'images/banners/main_visual2.jpg'],
            ['전문가 양성', '체계적인 교육과 자격으로', 'CM 전문가를 양성합니다', 'images/banners/main_visual3.jpg'],
            ['CM 전문교육', '함께 배우고 함께 성장하는', 'CMAK 전문교육 프로그램', 'images/banners/main_visual4.jpg'],
            ['IPMA KOREA', '세계와 함께하는', '글로벌 CM 네트워크', 'images/banners/main_visual5.jpg'],
            ['Sustainable Construction', '지속가능한 건설로', '내일의 가치를 만듭니다', 'images/banners/main_visual6.jpg'],
        ];

        $rows = [];
        foreach ($slides as $i => $s) {
            $rows[] = [
                'eyebrow' => $s[0],
                'title' => $s[1],
                'highlight' => $s[2],
                'image_path' => $s[3],
                'is_active' => true,
                'sort_order' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('hero_slides')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
