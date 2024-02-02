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
        Schema::create('trx_obatalkes', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->references('trx_id')->on('trx_pasiens');
            $table->foreignId('obatalkes_id')->constrained('m_obatalkes');
            $table->enum('racikan',[0,1])->comment('0: bukan racikan, 1 : racikan');
            $table->integer('racikanke')->nullable()->comment('jika racikan berkode 1 maka kolom ini harus diisi.');
            $table->string('embalace')->nullable()->comment('jika racikan berkode 1 maka kolom ini harus diisi.');
            $table->float('tarifembalace')->nullable()->comment('jika racikan berkode 1 maka kolom ini harus diisi.');
            $table->integer('qty');
            $table->string('signa')->nullable();
            $table->string('etiket')->nullable();
            $table->float('tarif');
            $table->float('total');
            $table->enum('status',[0,1,2])->comment('0: belum dibayar, 1: sudah dibayar, 2: sudah di verifikasi');
            $table->foreignId('user_id')->constrained('users')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_obatalkes');
    }
};
