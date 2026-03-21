<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attachable_id');
            $table->string('attachable_type');
            $table->string('file_name');
            $table->string('file_path');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('mime_type')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['attachable_id', 'attachable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
