<?php

namespace App\Http\Controllers;

use App\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    public function startEntries(Discipline $discipline, int $group){
        return view('entry.action', compact('discipline', 'group'));
    }

    public function nextEntry(Discipline $discipline, int $group, int $i, Request $request){
        $studentList = DB::table('students')->where('group', '=', $group)->get();
        $count = count($studentList);
        if($i == 0){
            foreach($studentList as $student){
                $student->tempValue = 0;
            }
        }

        if($i < $count-1){
            if($i != -1) {
                DB::table('students')->where('id', $studentList[$i]->id)->update(['tempValue' => $request->value]);
                $student = $studentList[++$i];
            }
            else{
                $i = 0;
                $student = $studentList[0];
            }
            return view('entry.next', compact('discipline', 'group', 'i', 'student'));
        }
        return view('entry.summary', compact('discipline', 'group', 'studentList'));
    }

}
