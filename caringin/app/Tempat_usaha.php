<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempat_usaha extends Model
{
    protected $table ='tempat_usaha';
    protected $fillable = ['id_tempat','id_trfkebersihan','id_trfkeamanan','id_trfipk','id_nasabah','kd_kontrol','no_alamat','jml_alamat','nomtr_listrik','nomtr_air','bentuk_usaha'];
}
