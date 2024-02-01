<?php

namespace Database\Seeders;

use App\Models\m_pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        m_pasien::create([
            'no_rm'         => '000001',
            'label'         => 'Tn',
            'gelardepan'    => '',
            'pasien_nama'   => 'Wildan Auliana',
            'gelarbelakang' => 'A.Md.Kom',
            'tgllahir'      => '1992-12-07',
            'jeniskelamin'  => '0',
            'alamat'        => 'Perum Griya Harmoni Blok F8',
            'desa'          => 'Pamekarsari',
            'kecamatan'     => 'Banyuresmi',
            'kota'          => 'GARUT',
            'no_telp'       => '6281223766271',
            'agama'         => '0',
            'pendidikan'    => '4',
            'pendidikan'    => 'Alergi Paracetamol',
            'asuransi1'     => 'BPJS KESEHATAN',
            'asuransi2'     => 'UMUM',
            'user_id'       => '1',
        ]);
        m_pasien::create([
            'no_rm'         => '000002',
            'label'         => 'Ny',
            'gelardepan'    => '',
            'pasien_nama'   => 'Kiki Zakiyah Arifin',
            'gelarbelakang' => 'S.Pd',
            'tgllahir'      => '1992-01-23',
            'jeniskelamin'  => '1',
            'alamat'        => 'Perum Griya Harmoni Blok F8',
            'desa'          => 'Pamekarsari',
            'kecamatan'     => 'Banyuresmi',
            'kota'          => 'GARUT',
            'no_telp'       => '6282117003788',
            'agama'         => '0',
            'pendidikan'    => '5',
            'asuransi1'     => 'BPJS KESEHATAN',
            'asuransi2'     => 'UMUM',
            'user_id'       => '1',
        ]);
        m_pasien::create([
            'no_rm'         => '000003',
            'label'         => 'An',
            'gelardepan'    => '',
            'pasien_nama'   => 'Muhammad Zain Abdullah',
            'gelarbelakang' => '',
            'tgllahir'      => '2020-11-13',
            'jeniskelamin'  => '0',
            'alamat'        => 'Perum Griya Harmoni Blok F8',
            'desa'          => 'Pamekarsari',
            'kecamatan'     => 'Banyuresmi',
            'kota'          => 'GARUT',
            'no_telp'       => '6281223766271',
            'agama'         => '0',
            'pendidikan'    => '0',
            'asuransi1'     => 'BPJS KESEHATAN',
            'asuransi2'     => 'UMUM',
            'user_id'       => '1',
        ]);
    }
}
