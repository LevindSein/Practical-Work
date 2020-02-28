<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meteran_listrik extends Model
{
    protected $table ='meteran_listrik';
    protected $fillable = ['id_mlistrik','nomtr_listrik','makhir_listrik','updated_at','created_at'];
}