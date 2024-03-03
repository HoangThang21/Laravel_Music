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
        Schema::create('user_a_p_i', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('image')->nullable();
            $table->string('quyen');
            $table->timestamps();
            $table->text('thuvien')->nullable();
            $table->text('vip')->nullable();
            $table->string('quyenchat')->nullable();
            $table->unsignedInteger('trangthai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_a_p_i');
    }
};