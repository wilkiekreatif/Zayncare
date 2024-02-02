<?php

namespace Database\Seeders;

use App\Models\m_supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        m_supplier::create([
            'supplier_id'       => 'S-00001',
            'supplier_nama'     => 'Wilkie Creativa Medika',
            'supplier_alamat'   => 'Perum Griya Harmoni Blok F8 Pamekarsari Banyuresmi Garut',
            'supplier_telp'     => '6281223766271',
            'user_id'           => '1',
        ]);
        m_supplier::create([
            'supplier_id'       => 'S-00002',
            'supplier_nama'     => 'Jacks Collections Medika',
            'supplier_alamat'   => 'Kp. Maleer Sukasenang Banyuresmi Garut',
            'supplier_telp'     => '6281223766271',
            'user_id'           => '1',
        ]);
    }
}
