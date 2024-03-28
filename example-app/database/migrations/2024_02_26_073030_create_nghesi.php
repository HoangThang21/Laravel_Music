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
        Schema::create('nghesi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tennghesi');
            $table->unsignedInteger('id_nghesi_user')->nullable();
            $table->text('mota')->nullable();
            $table->text('quantam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nghesi');
    }
};