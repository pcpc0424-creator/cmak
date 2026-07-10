<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('position');        // 업체/기관명
            $table->boolean('is_member_company')->default(false)->after('company_name'); // 회원사 소속 임직원 여부
            $table->unsignedBigInteger('member_company_id')->nullable()->after('is_member_company'); // 연결된 회원사 id
            $table->boolean('ad_agree')->default(false)->after('email_agree');     // 광고성 정보 수신 동의(메일/SMS 수신동의와 별도)
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'is_member_company', 'member_company_id', 'ad_agree']);
        });
    }
};
