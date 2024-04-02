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
        Schema::create('ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tensong1');
            $table->string('phantram1');
            $table->string('nghesi1');
            $table->string('tensong2');
            $table->string('phantram2');
            $table->string('nghesi2');
            $table->string('tensong3');
            $table->string('phantram3');
            $table->string('nghesi3');
            $table->string('thoigian');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranks');
    }
};