<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    protected $table = 'blok';
    protected $fillable = ['id_blok','nm_blok','updated_at','created_at'];
}
