<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa_air extends Model
{
    protected $table = 'jasa_air';
    protected $fillable = ['id_jsair','id_tempat','tgl_jsair'];
}
