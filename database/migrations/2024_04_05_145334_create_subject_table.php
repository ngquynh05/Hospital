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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null)->comment('tên loại dịch vụ');
            $table->text('description')->nullable()->default(null)->comment('mô tả dịch vụ');
            $table->integer('price')->nullable()->default(0)->comment('giá tiền dịch vụ');
            $table->tinyInteger('status')->default(1)->comment('1: dịch vụ đang sử dụng, 0: dịch vụ tạm ngưng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
