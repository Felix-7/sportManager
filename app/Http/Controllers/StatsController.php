<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Student;
use App\Value;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function searchByDiscipline($mode)
    {
        $disciplines = Discipline::all();
        $groups = Student::select('group')->whereNotNull('group')->groupBy('group')->get();
        return view('stats.searchdis', compact('disciplines', 'groups', 'mode'));
    }

    public function deliver()
    {
        $search = (object) $this->validateRequest();
        $result = Value::all()
            ->where('discipline_id', '=', $search->discipline_id)
            ->load('student')
            ->where('student.gender', '=', $search->gender);
        $groupAssist = Student::all()
            ->where('gender', '=', $search->gender)->unique('group');
        $mode = $search->mode;
        $gender = $search->gender;
        $discipline = Discipline::all()
            ->where('id', '=', $search->discipline_id)->first();

        //HALL OF FAME
        if($mode == 1){
            $orderedResult = $this->orderScores($result, $search->discipline_id);
            return view('stats.halloffame', compact('orderedResult', 'discipline', 'mode', 'gender'));
        }
        //LOWER / HIGHER SCHOOL
        if($mode == 3){
            if($search->upper == 1) $gap = ">"; //HIGHER
            else $gap = "<="; //LOWER

            $result = Value::where('class', $gap, '4')
                ->where('discipline_id', '=', $search->discipline_id)
                ->with('student')
                ->whereHas('student', function($q) use($gender){
                    $q->where('gender', $gender);
                })->get();

            $orderedResult = $this->orderScores($result, $search->discipline_id);
            return view('stats.summary', compact('orderedResult', 'discipline', 'mode'));

        }

        return view('stats.summary', compact('result', 'groupAssist', 'mode'));
    }

    public function deliverDetail(Request $request){
        $search = (object) $this->validateDetailedRequest();

        $gender = $search->gender;
        $mode = $search->mode;
        $class = $search->class;
        $discipline = Discipline::where('id', '=', $search->discipline_id)->first();
        $age = $search->age;

        $result = Value::all()
            ->where('discipline_id', '=', $search->discipline_id)
            ->load('student')
            ->where('student.gender', '=', $search->gender);
        if($search->useAge == 1){
            $result = Value::query()
                ->whereHas('student', function($q) use($age) {
                $q->whereRaw(
                    'TIMESTAMPDIFF(YEAR, students.birth, values.datetime) < ?', [$age]
                    );
                })
                ->get();

            dd($result);
        }


        //SORT BY CLASS

        else if($search->useAge == 0){
            $result = Value::where('class', 'like', '%'.$class.'%')->where('discipline_id', '=', $search->discipline_id)
                ->with('student')
                ->whereHas('student', function($q) use($gender) {
                    $q->where('gender', $gender);
                })->get();
        }


        //HALL OF FAME
        if($mode == 1){
            $orderedResult = $this->orderScores($result, $search->discipline_id);
            return view('stats.summary', compact('orderedResult', 'discipline', 'mode'));
        }

    }

    public function detailSearch(Request $request){
        $gender = $request->gender;
        $useAge = $request->useAge;
        $mode = $request->mode;
        $discipline_id = $request->discipline_id;

        return view('stats.searchdet', compact('useAge', 'mode', 'discipline_id', 'gender'));
    }

    private function validateRequest(){

        return request()->validate([
            'discipline_id' => 'required',
            'gender' => 'required',
            'mode' => 'required',
            'upper' => 'required', //ToDo Change to required if...
        ]);
    }

    private function validateDetailedRequest(){

        return request()->validate([
            'gender' => 'required',
            'useAge' => 'required',
            'mode' => 'required',
            'discipline_id' => 'required',
            'class' => 'required',
            'age' => 'required',
        ]);
    }

    private function orderScores($valueInput, $discipline_id){

        $best_high = Discipline::where('id', '=', $discipline_id)->first()->best_high;
        if($best_high == 1) $ordered = $valueInput->sortByDesc('value');
        else if($best_high == 0) $ordered = $valueInput->sortBy('value');
        else $ordered = "ERROR";
        return $ordered;
    }

}
