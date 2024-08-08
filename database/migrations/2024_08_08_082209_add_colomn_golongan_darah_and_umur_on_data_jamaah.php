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
        Schema::table('data_jamaah', function (Blueprint $table) {
            $table->char('golongan_darah')->nullable();
            $table->integer('umur')->length(3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_jamaah', function (Blueprint $table) {
            $table->dropColumn('golongan_darah')->nullable();
            $table->dropColumn('umur')->nullable();
        });
    }
};
