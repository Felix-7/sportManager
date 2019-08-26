<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['skn', 'name', 'surname', 'cur_class', 'gender', 'birth', 'active', 'tempValue'];

    public function values()
    {
        return $this->hasMany(\App\Value::class);
    }

    public function scopeStudents($query, string $group)
    {
        return $query->where('group', '=', $group);
    }

    public function scopeSkn($query, $skn)
    {
        return $query->where('skn', '=', $skn)->get();
    }
}
