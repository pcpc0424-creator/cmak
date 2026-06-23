<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * 회원 등급을 4종(정회원/준회원/인터넷회원/특별회원)으로 재정의.
 * 기존 데이터 매핑(클라이언트 결정 2026-06-23):
 *   - general(일반회원) → internet(인터넷회원)
 *   - regular(정회원)   → 유지
 *   - internet(인터넷)  → 유지
 * 신규 등급(associate 준회원, special 특별회원)은 관리자가 부여.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('grade', 'general')->update(['grade' => 'internet']);
    }

    public function down(): void
    {
        // 매핑이 비가역적(general↔internet 구분 불가)이므로 down은 동작하지 않음.
    }
};
