<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * 회원가입 승인 기능: users.approval_status 추가.
 * pending(승인대기) / approved(승인) / rejected(반려)
 * 기존 회원/관리자는 모두 approved로 처리.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('approval_status', 20)->default('pending')->after('is_active');
            $table->timestamp('approved_at')->nullable()->after('approval_status');
        });

        // 기존 사용자(관리자 포함)는 모두 승인 상태로 간주
        DB::table('users')->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['approval_status', 'approved_at']);
        });
    }
};
