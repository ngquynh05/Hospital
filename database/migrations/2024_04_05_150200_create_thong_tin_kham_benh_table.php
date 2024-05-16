<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('thong_tin_kham_benh', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->comment('tên bệnh nhân');
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->comment('tên dịch vụ khám');
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->comment('lịch khám');
            $table->date('date')->nullable()->comment('ngày khám');
            $table->tinyInteger('status')->nullable()->default(0)->comment('0: chưa khám, 1: đã khám, 2: hủy lịch khám');
            $table->string('url',5000)->nullable()->comment('link tạo QR code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_tin_kham_benh');
    }
};
