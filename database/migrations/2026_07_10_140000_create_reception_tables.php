<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 행사(접수 대상)
        Schema::create('reception_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');                       // 행사명
            $table->string('slug')->unique();              // URL 슬러그
            $table->text('description')->nullable();       // 행사 설명
            $table->dateTime('event_start')->nullable();   // 행사 시작일시
            $table->dateTime('event_end')->nullable();     // 행사 종료일시
            $table->dateTime('reg_start')->nullable();     // 접수 시작일시
            $table->dateTime('reg_end')->nullable();       // 접수 마감일시
            $table->string('fee_info')->nullable();        // 참가비(유형별 자유입력)
            $table->string('status')->default('open');     // open(접수중)/closed(마감)/done(완료)
            $table->integer('capacity')->nullable();       // 정원(미지정=제한없음)
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 문항(동적)
        Schema::create('reception_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reception_event_id')->constrained()->cascadeOnDelete();
            $table->string('label');                       // 문항 라벨
            $table->string('type')->default('text');       // text/textarea/radio/checkbox/select/date/agreement
            $table->json('options')->nullable();           // 선택지(radio/checkbox/select)
            $table->boolean('is_required')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 신청(제출)
        Schema::create('reception_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reception_event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->json('answers')->nullable();           // {question_id: value}
            $table->string('applicant_name')->nullable();  // 대표 성명(빠른 조회용)
            $table->string('applicant_phone')->nullable();
            $table->string('applicant_email')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reception_submissions');
        Schema::dropIfExists('reception_questions');
        Schema::dropIfExists('reception_events');
    }
};
