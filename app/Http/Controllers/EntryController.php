<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    public function startEntries(Discipline $discipline, int $group){
        return view('entry.action', compact('discipline', 'group'));
    }

    public function nextEntry(Discipline $discipline, int $group, int $i){
        $studentList = Student::students($group)->get();
        $count = count($studentList);
        
        if($i != -1) {
            $studentList[$i]->update($this->validateEntry());
            if(++$i >= $count){
                $studentList = Student::students($group)->get();
                return view('entry.summary', compact( 'group','discipline', 'studentList', 'i'));
            }
            $student = $studentList[$i];
        }
        else{
            $i = 0;
            foreach($studentList as $student){
                $student->tempValue = 0;
            }
            $student = $studentList[0];
        }
        return view('entry.next', compact('discipline','group', 'i', 'student'));
    }

    public function store(Request $request, int $group)
    {
        dd('Hi');
    }

    private function validateEntry(){

        return request()->validate([
            'tempValue' => 'integer|nullable',
        ]);
    }

}
