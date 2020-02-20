<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa_ipkeamanan extends Model
{
    protected $table = 'jasa_ipkeamanan';
    protected $fillable = ['id_jsipkeamanan','id_tempat','tgl_jsipkeamanan'];
}
