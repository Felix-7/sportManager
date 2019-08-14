<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['tempValue'];

    public function values()
    {
        return $this->hasMany(\App\Value::class);
    }

    public function scopeStudents($query, $group)
    {
        return $query->where('group', '=', $group);
        dd($query);
    }
}
