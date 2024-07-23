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
        Schema::create('data_qurban', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_penanggungjawab');
            $table->string('status');
            $table->date('tgl_mulai');
            $table->string('total_target');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_qurban');
    }
};
