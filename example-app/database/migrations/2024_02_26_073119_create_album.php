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
        Schema::create('album', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenalbum');
            $table->integer('namphathanh');
            $table->timestamps();
            $table->unsignedInteger('nghesi_idalbum');
            // $table->foreign('nghesi_id_album')->references('id')->on('nghesi');
            $table->unsignedInteger('theloai_idalbum');
            // $table->foreign('theloai_id')->references('id')->on('theloai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album');
    }
};