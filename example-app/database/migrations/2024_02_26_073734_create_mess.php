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
        Schema::create('mess', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('iduser')->nullable();
            $table->Integer('idusergg')->nullable();
            $table->string('tenuser');
            $table->text('hinhuser');
            $table->integer('idnhac')->nullable();
            $table->text('noidung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mess');
    }
};