<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Roles extends Model
{
    use HasFactory;

    protected $fillable = ['key','name','role_status'];


    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    public function getUsers(){
      return $this->hasMany(\App\Models\UserRoles::class,"role_id","id");
    }
}
