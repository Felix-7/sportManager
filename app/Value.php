<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Value extends Model
{

    protected $fillable = ['value', 'discipline_id', 'student_id', 'class', 'year', 'teacher_id', 'datetime', 'age'];

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

    public static function getLastResults(int $disciplineId, $studentList, $mode)
    {
        $lastResults = array();
        foreach ($studentList as $key => $student) {
            $query = Value::where('student_id', '=', $student->id)->where('discipline_id', '=', $disciplineId)->orderBy('created_at', 'DESC');
            if ($query->first() == null) {
                $result = -1;
            } else {
                $result = $query->first($mode)->$mode;
            }

            $lastResults = Arr::add($lastResults, $key, $result);
        }
        return $lastResults;
    }

    public static function generateValue(float $intVal, string $group, int $studentNr, int $disciplineId)
    {
        $studentList = Student::students($group)->get();
        $student = $studentList[$studentNr];
        $bdate = new Carbon($student->birth);
        $age = $bdate->diffInYears(Carbon::now());

        Value::create([
            'value' => $intVal,
            'student_id' => $student->id,
            'class' => $student->cur_class,
            'datetime' => date('Y-m-d H:i:s'),
            'teacher_id' => Auth::user()->id,
            'year' => date('Y'), //ToDo Schoolyears instead of years!
            'discipline_id' => $disciplineId,
            'age' => $age,
        ]);

        return;
    }
}
