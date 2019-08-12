<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $fillable = ['name', 'unit', 'best_high', 'active'];

    protected $attributes = [
        'best_high' => 1,
        'active' => 1
    ];

    public function activeOptions(){
        return [
            0 => 'Inactive',
            1 => 'Active'
        ];
    }

    public function getActiveAttribute($attribute)
    {
        return $this->activeOptions()[$attribute];
    }
}
