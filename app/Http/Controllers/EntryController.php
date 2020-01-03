<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Student;
use App\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    public function startEntries(Discipline $discipline, string $group){
        $studentList = Student::students($group)->get()->sortBy('cur_class')->sortBy('name');
        $lastDate = Value::getLastResults($discipline->id, $studentList, 'datetime');

        $mostRecent= 0;
        $now = time();
        foreach($lastDate as $date){
            $curDate = strtotime($date);
            if ($curDate > $mostRecent && $curDate < $now) {
                $mostRecent = $curDate;
            }
        }

        if($mostRecent != 0) $lastDate = date('d.m.y', $mostRecent);
        else $lastDate = 0;
        $rowCount = 1;
        return view('entry.action', compact('discipline', 'group', 'lastDate', 'studentList', 'rowCount'));
    }

    public function nextEntry(Discipline $discipline, string $group, int $i, bool $skipFlag){
        $studentList = Student::students($group)->get()->sortBy('cur_class')->sortBy('name');
        $count = count($studentList);

        if($i != -1) {
            $studentList[$i]->update($this->validateEntry());
            if(++$i >= $count || $skipFlag == true){
                $studentList = Student::students($group)->get()->sortBy('cur_class')->sortBy('name');
                $lastResults = Value::getLastResults($discipline->id, $studentList, 'value');
                return view('entry.summary', compact( 'group','discipline', 'studentList', 'i', 'lastResults'));
            }
            $student = $studentList[$i];
        }
        else{
            $i = 0;
            foreach($studentList as $student){
                $student->tempValue = null;
            }
            $student = $studentList[0];
        }
        return view('entry.next', compact('discipline','group', 'i', 'student'));
    }

    public function editEntry(Discipline $discipline, string $group, int $i)
    {
        $studentList = Student::students($group)->get();
        $student = $studentList[$i];
        return view('entry.edit', compact('discipline', 'group', 'student', 'i'));
    }

    private function validateEntry(){

        return request()->validate([
            'tempValue' => 'integer|nullable',
        ]);
    }

}
