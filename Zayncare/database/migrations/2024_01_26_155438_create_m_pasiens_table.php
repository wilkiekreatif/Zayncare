<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique();
            $table->string('nik')->unique()->nullable();
            $table->enum('label',['Tn','Ny','Nn','An']);
            $table->string('gelardepan')->nullable();
            $table->string('pasien_nama');
            $table->string('gelarbelakang')->nullable();
            $table->date('tgllahir');
            $table->enum('jeniskelamin',[0,1])->default(0)->comment('0: pria, 1:wanita');
            $table->string('alamat');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('no_telp');
            $table->enum('agama',[0,1,2,3,4,5])->nullable()->comment('0: Islam, 1: Katolik, 2:Protestan, 3:Hindu, 4:Budha,5:Lainnya');
            $table->string('pendidikan')->nullable()->comment('0:dibawah SD, 1: SD Sederajat, 2: SMP Sederajat, 3: SMA Sederajat, 4: DIII Sederajat, 5: S1 Sederajat, 6: S2 Sederajat, 7: S3 Sederajat, 8: diatas S3');
            $table->string('alergi')->nullable();
            $table->string('asuransi1');
            $table->string('asuransi2')->nullable();
            $table->string('asuransi3')->nullable();
            $table->foreignId('user_id')->constrained('users')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_pasiens');
    }
};
