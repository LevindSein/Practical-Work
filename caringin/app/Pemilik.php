<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table ='pemilik';
    protected $fillable = ['id_pemilik','nm_pemilik','no_anggota','no_ktp','no_npwp','no_tlp','updated_at','created_at'];
}
