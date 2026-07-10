<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 히어로 메인텍스트 두 줄을 각각 볼드 토글할 수 있도록 highlight_bold 컬럼 추가.
     * 기존에는 title_bold 하나가 둘째 줄(강조 문구)만 제어했으므로,
     * 그 값을 highlight_bold(둘째 줄)로 옮기고 title_bold(첫째 줄)는 기존 표시대로 비볼드로 초기화한다.
     */
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->boolean('highlight_bold')->default(true)->after('title_bold');
        });

        // 기존 title_bold(=둘째 줄 볼드 여부)를 highlight_bold로 이관
        DB::table('hero_slides')->update(['highlight_bold' => DB::raw('title_bold')]);
        // 첫째 줄(title)은 기존에 항상 비볼드였으므로 title_bold를 false로 초기화
        DB::table('hero_slides')->update(['title_bold' => false]);
    }

    public function down(): void
    {
        // 이관값을 되돌려 title_bold가 다시 둘째 줄을 제어하도록 복원
        DB::table('hero_slides')->update(['title_bold' => DB::raw('highlight_bold')]);

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn('highlight_bold');
        });
    }
};
