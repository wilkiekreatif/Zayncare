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
        Schema::create('trx_anamnesapasiens', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->references('trx_id')->on('trx_pasiens');
            $table->integer('detakjantung');
            $table->integer('tensi1');
            $table->integer('tensi2');
            $table->integer('suhu');
            $table->integer('beratbadan');
            $table->foreignId('user_id')->constrained('users')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamnesas');
    }
};
