<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meteran_air extends Model
{
    protected $table ='meteran_air';
    protected $fillable = ['id_mair','nomtr_air','makhir_air','updated_at','created_at'];
}