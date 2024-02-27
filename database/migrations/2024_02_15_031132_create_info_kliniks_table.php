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
        Schema::create('info_kliniks', function (Blueprint $table) {
            $table->id();
            $table->string('klinik_nama');
            $table->string('klinik_subnama')->nullable();
            $table->string('sip');
            $table->string('alamat');
            $table->string('tagline')->nullable();
            $table->string('email')->nullable();
            $table->string('notelp');
            $table->string('notelp2')->nullable();
            $table->string('website')->nullable();
            $table->foreignId('user_id')->constrained('users')->default(1)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_kliniks');
    }
};
