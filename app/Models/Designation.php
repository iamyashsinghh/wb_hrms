<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'department_id','name','created_by'
    ];

    public function department(){
        return $this->hasOne('App\Models\Department','id','department_id');
    }
}
