<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penghapusan extends Model
{
    protected $table ='penghapusan';
    protected $fillable = ['id_penghapusan','id_tempat','tgl_hapus','nama','ttl_tunggakan','updated_at','created_at'];
}
