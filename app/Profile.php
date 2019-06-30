<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profile';
    protected $fillable = ['address', 'image', 'Orangtua_wali'];
}
