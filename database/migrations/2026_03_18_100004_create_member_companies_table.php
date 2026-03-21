<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('region')->nullable();
            $table->string('company_type')->nullable();
            $table->string('representative')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->text('address')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_integrated')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_companies');
    }
};
