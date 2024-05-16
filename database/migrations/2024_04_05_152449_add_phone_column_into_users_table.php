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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone',20)->nullable()->comment('số điện thoại bệnh nhân');
            $table->string('address',500)->nullable()->comment('địa chỉ bệnh nhân');
            $table->string('avatar',1000)->nullable()->comment('hình ảnh của bệnh nhân');
            $table->date('birthday')->nullable()->comment('ngày tháng năm sinh của bệnh nhân');
            $table->tinyInteger('gender')->nullable()->default(0)->comment('0: nam, 1: nữ');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
