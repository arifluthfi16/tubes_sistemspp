<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = ['id','name', 'address'];
}
