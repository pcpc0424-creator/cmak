<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');   // 사용자ID
            $table->string('grade')->nullable()->after('role');                 // 회원등급: general/regular/internet
            $table->string('phone_company')->nullable()->after('position');     // 전화번호(회사)
            $table->string('phone_mobile')->nullable()->after('phone_company'); // 휴대폰번호
            $table->boolean('sms_agree')->default(false)->after('phone_mobile');
            $table->boolean('email_agree')->default(false)->after('sms_agree');
            $table->string('zipcode')->nullable()->after('email_agree');
            $table->string('address')->nullable()->after('zipcode');
            $table->string('address_detail')->nullable()->after('address');
            $table->string('join_period')->nullable()->after('address_detail'); // 가입기간
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username', 'grade', 'phone_company', 'phone_mobile',
                'sms_agree', 'email_agree', 'zipcode', 'address', 'address_detail', 'join_period',
            ]);
        });
    }
};
