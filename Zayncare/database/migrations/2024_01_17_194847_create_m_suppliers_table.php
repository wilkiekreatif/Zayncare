<?php

use App\Models\m_obatalkes;
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
        Schema::create('m_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_id')->unique();
            $table->string('supplier_nama')->unique();
            $table->string('supplier_alamat')->nullable();
            $table->string('supplier_telp')->nullable();
            $table->enum('is_active',[0,1,99])->default(1)->comment('0: nonaktif, 1:aktif, 99:deleted');
            $table->foreignId('user_id')->constrained('users')->default('1');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_suppliers');
    }
};
