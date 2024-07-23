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
        Schema::create('data_qurban_detail', function (Blueprint $table) {
            $table->id('id');
            $table->integer('id_qurban');
            $table->string('nama_pembayar');
            $table->date('tgl_bayar');
            $table->string('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_qurban_detail');
    }
};
