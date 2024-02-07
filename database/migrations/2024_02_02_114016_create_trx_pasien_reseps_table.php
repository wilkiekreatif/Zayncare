<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW trx_pasien_reseps AS SELECT DISTINCT
            trx_obatalkes.trx_id,
            trx_obatalkes.id,
            m_pasiens.no_rm,
						trx_pasiens.kelastarif,
            m_pasiens.label,
            m_pasiens.gelardepan,
            m_pasiens.pasien_nama,
            m_pasiens.gelarbelakang,
            m_pasiens.jeniskelamin,
						m_pasiens.no_telp,
            m_pasiens.alamat,
            m_pasiens.desa,
            m_pasiens.kecamatan,
            m_pasiens.kota,
            m_pasiens.nik,
            m_pasiens.tgllahir,
            m_pasiens.agama,
            m_pasiens.pendidikan,
            m_pasiens.alergi,

						m_polis.poli_nama,

						m_obatalkes.obatalkes_nama,
            trx_obatalkes.racikan,
            trx_obatalkes.racikanke,
            trx_obatalkes.qty,
            m_obatalkes.stok,
            m_obatalkes.satuan,
            trx_obatalkes.signa,
            trx_obatalkes.etiket,
						trx_pasiens.status AS statusPasien,
						trx_obatalkes.`status` AS statusResep,
            trx_obatalkes.created_at

            FROM trx_obatalkes

            LEFT JOIN trx_pasiens ON trx_pasiens.trx_id = trx_obatalkes.trx_id
            LEFT JOIN m_pasiens ON m_pasiens.id = trx_pasiens.pasien_id
						LEFT JOIN m_obatalkes ON trx_obatalkes.obatalkes_id = m_obatalkes.id
						LEFT JOIN m_polis ON trx_pasiens.poli_id = m_polis.id 
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS trx_pasien_reseps");
    }
};
