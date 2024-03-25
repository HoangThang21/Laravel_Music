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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('quyen');
            $table->timestamps();
            $table->text('thuvien')->nullable();
            $table->text('vip')->nullable();
    
            $table->unsignedInteger('trangthai');
            $table->string('quyenchat')->default(0);
            $table->string('online')->default(0);
            // $table->foreign('nghesi_id')->references('id')->on('nghesi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};