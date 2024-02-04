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
        Schema::create('anamnesas', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->references('trx_id')->on('trx_pasiens');
            $table->string('detak_j');
            $table->string('tensi1');
            $table->string('tensi2');
            $table->string('suhu');
            $table->string('bb');
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
