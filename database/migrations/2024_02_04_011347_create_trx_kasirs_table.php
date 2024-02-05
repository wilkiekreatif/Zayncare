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
        Schema::create('trx_kasirs', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi');
            $table->date('tanggal_transaksi');
            $table->string('no_rekmed');
            $table->string('nama_pasien');
            $table->string('asal_poli');
            $table->string('kelas_tarif');
            $table->integer('total_tindakan');
            $table->integer('total_obat_alkes');
            $table->integer('total_transaksi');
            $table->foreignId('user_id')->constrained('users')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_kasirs');
    }
};
