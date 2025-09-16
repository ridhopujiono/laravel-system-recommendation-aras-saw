<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            /*
            id: Primary Key

            kode_kriteria: (string, e.g., "C1", "C2")

            keterangan: (string, e.g., "Nilai Akademik")

            bobot: (float/decimal)

            jenis: (enum: 'benefit', 'cost')
            */

            $table->string('kode_kriteria')->unique();
            $table->string('keterangan');
            $table->decimal('bobot', 10, 9);
            $table->enum('jenis', ['benefit', 'cost']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria');
    }
};
