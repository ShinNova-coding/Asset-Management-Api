<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     use HasFactory;

    protected $guarded=[];

    public function users(){
        return $this->belongsToMany(User::class);
    }

   // app/Models/Role.php
public function permissions()
{
    return $this->belongsToMany(Permissions::class, 'role_has_permission', 'role_id', 'permission_id');
}
}
