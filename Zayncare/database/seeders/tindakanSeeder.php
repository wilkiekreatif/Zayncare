<?php

namespace Database\Seeders;

use App\Models\mTindakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tindakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mTindakan::create([
            'tindakan_nama' => 'Konsultasi Dokter Umum',
            'jenis'         => '0',
            'tarifdasar'    => '50000',
            'margin1'       => '10',
            'margin2'       => '15',
            'margin3'       => '20',
            'is_active'     => '1',
            'user_id'       => '1',
        ]);
        mTindakan::create([
            'tindakan_nama' => 'Konsultasi Dokter Spesialis',
            'jenis'         => '0',
            'tarifdasar'    => '70000',
            'margin1'       => '10',
            'margin2'       => '15',
            'margin3'       => '20',
            'is_active'     => '1',
            'user_id'       => '1',
        ]);
    }
}
