<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 구관리자(cmak.or.kr/admin) 회원사 엑셀의 고유 필드 보존용 컬럼.
 * - branch: 지회 (중부/영남1/영남2/호남/충청) — region(시/도)과는 별개
 * - member_code: 관리자 회원사 코드
 * - joined_at: 가입일 (원본 표기 그대로 보존, 일부 오타 포함되어 string)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('member_companies', function (Blueprint $table) {
            $table->string('branch')->nullable()->after('region');
            $table->string('member_code')->nullable()->after('branch');
            $table->string('joined_at')->nullable()->after('member_code');
        });
    }

    public function down(): void
    {
        Schema::table('member_companies', function (Blueprint $table) {
            $table->dropColumn(['branch', 'member_code', 'joined_at']);
        });
    }
};
