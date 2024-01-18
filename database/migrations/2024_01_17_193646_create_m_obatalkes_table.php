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
            $table->string('obatalkes_nama');
            $table->integer('supplier1_id');
            $table->integer('supplier2_id')->nullable();
            $table->integer('supplier3_id')->nullable();
            $table->string('satuan');
            $table->float('hargabeliterakhir');
            $table->integer('margin1');
            $table->integer('margin2')->nullable();
            $table->integer('margin3')->nullable();
            // $table->integer('margin4')->nullable();
            // $table->integer('margin5')->nullable();
            $table->boolean('is_active')->default(1);
            $table->foreignId('user_id')->constrained('users');
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