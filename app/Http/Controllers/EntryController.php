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

    public function nextEntry(Discipline $discipline, int $group, int $i){
        $studentList = DB::select('select * from students where [group] = ?', [$group]);
        $count = count($studentList);

        if($i < $count){
            $student = ($studentList[$i++]); //Increment AFTER Operation
            return view('entry.next', compact('discipline', 'group', 'i', 'student'));
        }
        return "Redirect to Overview";
    }

}
