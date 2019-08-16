<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Value extends Model
{

    protected $fillable = ['value', 'discipline_id', 'student_id', 'class', 'year', 'teacher_id', 'datetime'];

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

    public static function generateValue(int $intVal, int $group, int $studentNr, int $disciplineId){
        $studentList = Student::students($group)->get();
        $student = $studentList[$studentNr];

        Value::create([
        'value' => $intVal,
        'student_id' => $student->id,
        'class' => $student->cur_class,
        'datetime' => date('Y-m-d H:i:s'),
        'teacher_id' => Auth::user()->id,
        'year' => date('Y'), //ToDo Schoolyears instead of years!
        'discipline_id' => $disciplineId,
        ]);

        return;
    }
}
