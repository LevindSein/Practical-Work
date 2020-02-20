<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa_kebersihan extends Model
{
    protected $table = 'jasa_kebersihan';
    protected $fillable = ['id_jskebersihan','id_tempat','tgl_jskebersihan'];
}
