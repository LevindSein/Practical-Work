<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table ='tagihanku';
    protected $fillable = [
        'id_tagihanku',
        'id_tempat',
        'tgl_tagihan',
        'stt_bayar',
        'awal_air',
        'akhir_air',
        'pakai_air',
        'byr_air',
        'byr_pemeliharaan',
        'byr_beban',
        'byr_arkot',
        'ttl_air',
        'realisasi_air',
        'selisih_air',
        'awal_listrik',
        'akhir_listrik',
        'pakai_listrik',
        'byr_listrik',
        'rek_min',
        'b_blok1',
        'b_blok2',
        'b_beban',
        'bpju',
        'ttl_listrik',
        'realisasi_listrik',
        'selisih_listrik',
        'byr_ipk',
        'byr_keamanan',
        'ttl_ipkeamanan',
        'realisasi_ipkeamanan',
        'selisih_ipkeamanan',
        'byr_kebersihan',
        'ttl_kebersihan',
        'realisasi_kebersihan',
        'selisih_kebersihan',
        'bulan',
        'updated_at',
        'created_at'
    ];
}
