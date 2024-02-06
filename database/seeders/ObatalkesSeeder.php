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
            'obatalkes_id'      => 'OA-00001',
            'obatalkes_nama'    => 'Sanmol Forte',
            'supplier1_id'      => '1',
            'supplier2_id'      => '2',
            'satuan'            => 'Tablet',
            'hargabeliterakhir' => '500',
            'margin1'           => '5',
            'margin2'           => '10',
            'margin3'           => '15',
            'stok'              => '10',
            'user_id'           => '1',
        ]);
        
        m_obatalkes::create([
            'obatalkes_id'      => 'OA-00002',
            'obatalkes_nama'    => 'Sanmol',
            'supplier1_id'      => '2',
            'satuan'            => 'Tablet',
            'hargabeliterakhir' => '300',
            'margin1'           => '5',
            'margin2'           => '10',
            'margin3'           => '15',
            'stok'              => '5',
            'user_id'           => '1',
        ]);
        
        m_obatalkes::create([
            'obatalkes_id'      => 'OA-00003',
            'obatalkes_nama'    => 'Zypraz 25mg',
            'supplier1_id'      => '2',
            'satuan'            => 'Tablet',
            'hargabeliterakhir' => '7500',
            'margin1'           => '5',
            'margin2'           => '10',
            'margin3'           => '15',
            'stok'              => '5',
            'wajibresep'        => '1',
            'user_id'           => '1',
        ]);
    }
}
