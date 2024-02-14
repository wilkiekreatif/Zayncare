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
        Schema::create('trx_pembelian_farmasis', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->unique();
            $table->string('obatalkes_id')->constrained('m_obatalkes')->default('1');;
            $table->foreignId('supplier_id')->constrained('m_suppliers')->on('m_suppliers')->default('1');
            $table->string('hargabeli')->comment('Estimasi dengan menggunakan harga beli sebelumnya');
            $table->string('hargabelisetelahfaktur')->nullable()->comment('harga fix setelah datang faktur');
            $table->integer('qty');
            $table->integer('qtysetelahfaktur')->nullable();
            $table->integer('nofaktur')->nullable();
            $table->string('diskon')->nullable();
            $table->string('ppn')->nullable();
            $table->string('totalbayar');
            $table->string('totalbayarsetelahfaktur')->nullable();
            $table->enum('is_active',[0,1,2,99])->default(1)->comment('0: dibatalkan, 1:belum diterima, 2, Selesai QTY sudah ditambahkan, 99:deleted');
            $table->foreignId('user_id')->constrained('users')->default('1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trx_pembelian_farmasis');
    }
};
