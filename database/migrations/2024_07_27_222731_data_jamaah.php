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
        Schema::create('data_jamaah', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('alamat');
            $table->string('no_hp', 14);
            $table->string('p4ss');
            $table->enum('gender', ['l', 'p']);
            $table->enum('hidup', ['ya', 'tidak']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('umur');
            $table->string('pekerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_jamaah');
    }
};
