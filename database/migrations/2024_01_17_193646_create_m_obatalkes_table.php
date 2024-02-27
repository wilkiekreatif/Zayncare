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
        Schema::create('m_obatalkes', function (Blueprint $table) {
            $table->id();
            $table->string('obatalkes_id')->unique();
            $table->boolean('obatalkes_jenis')->default(0)->comment('0: Obat, 1:Alkes');
            $table->string('obatalkes_nama');
            $table->integer('supplier1_id');
            $table->integer('supplier2_id')->nullable();
            $table->integer('supplier3_id')->nullable();
            $table->string('satuan');
            $table->float('hargabeliterakhir');
            $table->integer('margin1');
            $table->integer('margin2')->nullable();
            $table->integer('margin3')->nullable();
            $table->float('stok')->default(0);
            $table->enum('wajibresep',[0,1])->default(0)->comment('0:boleh tanpa resep, 1: wajib resep');
            $table->enum('is_active',[0,1,99])->default(1)->comment('0: nonaktif, 1:aktif, 99:deleted');
            $table->foreignId('user_id')->constrained('users')->default(1)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_obatalkes');
    }
};
