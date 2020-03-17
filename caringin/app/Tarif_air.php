<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif_air extends Model
{
    protected $table ='tarif_air';
    protected $fillable = ['id_trfair','trf_air1','trf_air2','trf_pemeliharaan','trf_beban','trf_arkot','trf_denda','ppn_air','pasang_air'];
}
