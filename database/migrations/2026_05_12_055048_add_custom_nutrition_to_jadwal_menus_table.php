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
        Schema::table('jadwal_menus', function (Blueprint $table) {
            $table->string('nama_makanan_custom')->nullable()->after('id_makanan')->comment('Nama makanan custom jika tidak memilih dari database');
            $table->decimal('kalori_custom', 10, 2)->nullable()->after('nama_makanan_custom')->comment('Kalori custom');
            $table->decimal('protein_custom', 10, 2)->nullable()->after('kalori_custom')->comment('Protein custom');
            $table->decimal('karbohidrat_custom', 10, 2)->nullable()->after('protein_custom')->comment('Karbohidrat custom');
            $table->string('vitamin_custom')->nullable()->after('karbohidrat_custom')->comment('Vitamin custom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_menus', function (Blueprint $table) {
            $table->dropColumn([
                'nama_makanan_custom',
                'kalori_custom',
                'protein_custom',
                'karbohidrat_custom',
                'vitamin_custom',
            ]);
        });
    }
};
