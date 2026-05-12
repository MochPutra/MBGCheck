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
        Schema::create('jadwal_menus', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_makanan');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->integer('minggu');
            $table->integer('tahun');
            $table->string('dipesan_oleh')->nullable();
            $table->timestamps();
            
            $table->foreign('id_makanan')->references('id_makanan')->on('makanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_menus');
    }
};
