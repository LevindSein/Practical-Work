<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hari_libur extends Model
{
    protected $table = 'hari_libur';
    protected $fillable = ['id_hari','tgl_hari','ket_hari','updated_at','created_at'];
}
