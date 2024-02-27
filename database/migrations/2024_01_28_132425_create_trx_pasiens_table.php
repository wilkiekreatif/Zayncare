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
        Schema::create('trx_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->unique();
            $table->foreignId('pasien_id')->constrained('m_pasiens');
            $table->foreignId('poli_id')->constrained('m_polis');
            $table->enum('kelastarif',[1,2,3])->default(1)->comment('1:margin1, 2:margin2, 3:margin3');
            $table->string('antrian')->comment('No urut antrian berdasarkan hari dan poliklinik');
            $table->enum('status',[1,2,3,4,5,99])->default(1)->comment('99: batal periksa, 1: antrian, 2: sedang periksa, 3: sudah periksa, 4: sudah bayar, 5: sudah pulang');
            $table->foreignId('user_id')->constrained('users')->default('1')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_pasiens');
    }
};
