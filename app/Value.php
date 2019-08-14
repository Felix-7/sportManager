<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{


    public function teacher()
    {
        return $this->belongsTo(\App\Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Student::class);
    }

    public function discipline()
    {
        return $this->belongsTo(\App\Discipline::class);
    }
}
