<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Student;
use App\Value;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function searchByDiscipline()
    {
        $disciplines = Discipline::all();
        $groups = Student::select('group')->whereNotNull('group')->groupBy('group')->get();
        return view('stats.searchdis', compact('disciplines', 'groups'));
    }

    public function deliver(Request $request)
    {
        $search = (object) $this->validateRequest();
        $result = Value::all()->where('discipline_id', '=', $search->discipline_id);
        //  if(defined($search->group)) $result = $result->where('group', '=', $search->group);


        dd($result);




        return view('stats.summary');
    }

    private function validateRequest(){

        return request()->validate([
            'discipline_id' => 'required',
            'group' => 'filled',
        ]);
    }

}
