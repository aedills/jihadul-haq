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
        Schema::create('keuangan_outcome', function (Blueprint $table) {
            $table->id('id');
            $table->string('jenis_pengeluaran');
            $table->date('tanggal');
            $table->unsignedBigInteger('nominal');
            $table->string('tujuan_pengeluaran');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_outcome');
    }
};
