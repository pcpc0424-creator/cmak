<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('top_popup_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');                 // 버튼 텍스트
            $table->string('link_url')->nullable();  // 이동 링크 (상대/절대 모두 허용)
            $table->string('link_target')->default('_self');
            $table->string('image_path')->nullable(); // 버튼 이미지 (있으면 이미지로 표시)
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        $now = now();
        $items = [
            ['CM능력평가공시', '/business/certification'],
            ['CM30년', '/intro/history'],
            ['건설사업관리사자격검정', '/business/inspection'],
        ];
        $rows = [];
        foreach ($items as $i => $it) {
            $rows[] = [
                'label' => $it[0],
                'link_url' => $it[1],
                'link_target' => '_self',
                'is_active' => true,
                'sort_order' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('top_popup_items')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('top_popup_items');
    }
};
