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
        Schema::create('trx_kasir_umums', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_transaksi');
            $table->string('id_transaksi');
            $table->integer('total_transaksi');
            $table->foreignId('user_id')->constrained('users')->default(1)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_kasir_umums');
    }
};
