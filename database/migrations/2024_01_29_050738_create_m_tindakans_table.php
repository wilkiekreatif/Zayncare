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
        Schema::create('m_tindakans', function (Blueprint $table) {
            $table->id();
            $table->string('tindakan_nama')->unique();
            $table->enum('jenis',[0,1])->comment('0: Pemeriksaan, 1: Tindakan');
            $table->float('tarifdasar');
            $table->integer('margin1');
            $table->integer('margin2')->nullable();
            $table->integer('margin3')->nullable();
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
        Schema::dropIfExists('m_tindakans');
    }
};
