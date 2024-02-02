<?php

namespace Database\Seeders;

use App\Models\m_poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class poliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        m_poli::create([
            'poli_nama' => 'Umum',
            'user_id'   => '1'
        ]);
        m_poli::create([
            'poli_nama' => 'Spesialis Gigi dan Mulut',
            'user_id'   => '1'
        ]);
        m_poli::create([
            'poli_nama' => 'Kebidanan',
            'user_id'   => '1'
        ]);
    }
}
