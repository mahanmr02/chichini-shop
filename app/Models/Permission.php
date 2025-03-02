<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{

    use HasFactory,SoftDeletes;

    protected $fillable = ['name','description','status'];


    public function roles(){
        return $this->belongsToMany(Role::class)->withPivot('permission_id','role_id');
    }
}
