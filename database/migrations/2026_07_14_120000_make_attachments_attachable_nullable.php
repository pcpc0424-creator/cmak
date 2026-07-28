<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 에디터(고정 페이지 등)에서 부모 없이 단독 업로드되는 첨부를 허용하기 위해
     * attachable_id / attachable_type 를 nullable 로 변경한다.
     * (기존 게시글 첨부는 값이 채워지므로 영향 없음)
     */
    public function up(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->unsignedBigInteger('attachable_id')->nullable()->change();
            $table->string('attachable_type')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->unsignedBigInteger('attachable_id')->nullable(false)->change();
            $table->string('attachable_type')->nullable(false)->change();
        });
    }
};
