<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa_listrik extends Model
{
    protected $table = 'jasa_listrik';
    protected $fillable = ['id_jslistrik','id_tempat','tgl_jslistrik'];
}
