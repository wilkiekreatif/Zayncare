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
        Schema::create('trx_umums', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->unique();
            $table->float('total');
            $table->enum('status',[0,1,2,3,99])->default(0)->comment('0: belum dibayar, 1: sudah dibayar, 2: batal transaksi, 3: sudah diserahkan ke pasien, 99:dihapus');
            $table->foreignId('user_id')->constrained('users')->default(1)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_umums');
    }
};
