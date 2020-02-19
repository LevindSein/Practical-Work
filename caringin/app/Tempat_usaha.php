<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempat_usaha extends Model
{
    protected $table ='tempat_usaha';
    protected $fillable = ['id_tempat','id_trfkebersihan','id_trfipk','id_trfkeamanan','id_trflistrik','id_trfair','id_nasabah','kd_kontrol','no_alamat','jml_alamat','bentuk_usaha','nomtr_air','nomtr_listrik','updated_at','created_at'];
}
