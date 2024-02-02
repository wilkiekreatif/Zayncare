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
        Schema::create('trx_tindakanpasiens', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('trx_id')->unsigned()->index();
            // $table->foreign('trx_id')->references('trx_id')->on('trx_pasiens');
            $table->string('trx_id')->references('trx_id')->on('trx_pasiens');
            $table->foreignId('tindakan_id')->constrained('m_tindakans');
            $table->integer('qty');
            $table->string('satuan');
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
        Schema::dropIfExists('trx_tindakanpasiens');
    }
};
