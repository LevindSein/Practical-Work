<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $table ='nasabah';
    protected $fillable = ['id_nasabah','nm_nasabah','no_anggota','no_ktp','no_npwp','no_tlp','updated_at','created_at'];
}
