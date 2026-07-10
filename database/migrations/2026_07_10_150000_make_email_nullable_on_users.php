<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * 구 개인(온라인)회원 임포트 대응: 이메일이 없는 레거시 회원이 있어 email을 nullable로 변경.
     * 온라인 회원은 아이디(username)로 로그인하므로 email 부재가 가능. unique 인덱스는 유지(다중 NULL 허용).
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE `users` MODIFY `email` VARCHAR(255) NULL');
    }

    public function down(): void
    {
        // NULL 값을 되돌릴 수 없으므로 되돌리기는 no-op (안전)
    }
};
