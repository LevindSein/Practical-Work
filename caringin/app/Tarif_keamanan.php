<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif_keamanan extends Model
{
    protected $table ='tarif_keamanan';
    protected $fillable = ['id_trfkeamanan','trf_keamanan','updated_at','created_at'];
}
