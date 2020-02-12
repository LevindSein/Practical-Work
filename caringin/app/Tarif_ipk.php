<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif_ipk extends Model
{
    protected $table ='tarif_ipk';
    protected $fillable = ['id_trfipk','trf_ipk','updated_at','created_at'];
}
