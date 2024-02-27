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
            $table->foreignId('pasien_id')->constrained('m_pasiens');
            $table->string('trx_id')->references('trx_id')->on('trx_pasiens')->nullable();
            $table->integer('detakjantung')->nullable();
            $table->integer('tensi1')->nullable();
            $table->integer('tensi2')->nullable();
            $table->integer('suhu')->nullable();
            $table->integer('tinggibadan')->nullable();
            $table->integer('beratbadan')->nullable();
            $table->foreignId('user_id')->constrained('users')->default(1)->onDelete('cascade');
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
