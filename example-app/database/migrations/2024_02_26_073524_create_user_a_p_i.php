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
            $table->string('sdt');
            $table->string('email');
            $table->string('image')->default('user-profile.png');
            $table->string('quyen');
            $table->timestamps();
            $table->text('thuvien')->nullable();
            $table->text('vip')->nullable();
            $table->unsignedInteger('trangthai');
            $table->string('quyenchat')->default(0);
            $table->string('online')->default(0);
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