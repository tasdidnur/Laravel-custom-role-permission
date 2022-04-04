<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function permissionInfo()
    {
       return $this->hasOne('App\Models\Permission','role','id');
    }

    public function userInfo()
    {
        return $this->hasOne('App\Models\User','role','id');
    }
}
