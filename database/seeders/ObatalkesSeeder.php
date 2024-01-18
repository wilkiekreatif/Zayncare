<?php

namespace Database\Seeders;

use App\Models\m_obatalkes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatalkesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        m_obatalkes::create([
            'obatalkes_id'      => 'O-00001',
            'obatalkes_nama'    => 'Sanmol Forte',
            'supplier1_id'      => '1',
            'supplier2_id'      => '2',
            'satuan'            => 'Tablet',
            'hargabeliterakhir' => '500',
            'margin1'           => '10',
            'user_id'           => '1',
        ]);
    }
}
