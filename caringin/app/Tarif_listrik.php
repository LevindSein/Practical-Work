<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif_listrik extends Model
{
    protected $table ='tarif_listrik';
    protected $fillable = ['id_trflistrik','var_beban','var_blok1','var_blok2','var_standar','var_bpju','var_denda','denda_lebih','ppn_listrik'];
}
