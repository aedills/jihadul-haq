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
        Schema::create('keuangan_income', function (Blueprint $table) {
            $table->id('id');
            $table->string('jenis_pemasukan');
            $table->date('tanggal');
            $table->unsignedBigInteger('nominal');
            $table->string('sumber_pemasukan');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_income');
    }
};
