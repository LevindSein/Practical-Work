<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif_kebersihan extends Model
{
    protected $table ='tarif_kebersihan';
    protected $fillable = ['id_trfkebersihan','trf_kebersihan','updated_at','created_at'];
}
