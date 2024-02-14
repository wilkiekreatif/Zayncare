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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->enum('sysadmin',['on','off'])->nullable();
            $table->enum('gudangfarmasi',['on','off'])->nullable();
            $table->enum('register',['on','off'])->nullable();
            $table->enum('poliklinik',['on','off'])->nullable();
            $table->enum('apotek',['on','off'])->nullable();
            $table->enum('kasir',['on','off'])->nullable();
            $table->enum('is_active',[0,1,99])->default(1)->comment('0: nonaktif, 1:aktif, 99:deleted');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
