<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_applications', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->date('registration_date')->nullable();
            $table->date('education_start')->nullable();
            $table->date('education_end')->nullable();
            $table->integer('education_hours')->nullable();
            $table->integer('fee')->nullable();
            $table->string('status')->default('open');
            $table->integer('max_participants')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_applications');
    }
};
