<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tunggakan extends Model
{
    protected $table ='tunggakan';
    protected $fillable = ['id_tunggakan','id_tagihanku','tgl_tunggakan','updated_at','created_at'];
}
