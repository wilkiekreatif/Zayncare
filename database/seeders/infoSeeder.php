<?php

namespace Database\Seeders;

use App\Models\infoKlinik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class infoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        infoKlinik::create([
            'id'            => '1',
            'klinik_nama'   => 'PRAKTEK DOKTER',
            'klinik_subnama'=> 'dr. Dian Andriani Suwinda',
            'sip'           => '503/19246/282.dr.u/Dinkes/2022',
            'alamat'        => 'Jl. Munjul km 5 - Garut',
            'tagline'       => 'Your health is our priority',
            'email'         => 'info@praktekdrdian.com',
            'website'       => 'praktekdrdian.com',
            'user_id'       => '1',
        ]);
    }
}
