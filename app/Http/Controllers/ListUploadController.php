<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListUploadController extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest();
        $request->studentList->storeAs('studentLists', 'students.txt');
        $request->groupList->storeAs('studentLists', 'groups.txt');
        $request->teacherList->storeAs('studentLists', 'teachers.txt');

        $file = fopen('../storage/app/studentLists/students.txt', 'r') or exit("Datei konnte nicht geöffnet werden!");
        while(!feof($file)) {
            $rawStudent = explode(';', fgets($file));
            if(count($rawStudent) == 7){
                $rawStudent[6] = str_replace(array("\r", "\n"), "", $rawStudent[6]);
                Student::updateOrCreate([
                    'skn' => $rawStudent[2]
                ], [
                    'name' => $rawStudent[3],
                    'surname' => $rawStudent[4],
                    'cur_class' => $rawStudent[0],
                    'gender' => $rawStudent[5],
                    'birth' => $rawStudent[6],
                    'active' => true,
                ]);
            }
        }
        fclose($file);

        $file = fopen('../storage/app/studentLists/groups.txt','r') or exit("Datei konnte nicht geöffnet werden!");
        while(!feof($file)){
            $rawGroup = explode("\t", fgets($file));
            if(count($rawGroup) > 4){
                $student = Student::skn($rawGroup[0])->first();
                $student->group = $rawGroup[3];
                $student->save();
            }
        }

        $file = fopen('../storage/app/studentLists/teachers.txt','r') or exit("Datei konnte nicht geöffnet werden!");
        while(!feof($file)){
            $rawTeacher = explode(";", fgets($file));

            if(array_key_exists(3, $rawTeacher) == true) {
                $rawClasses = explode(',', $rawTeacher[3]);

                foreach ($rawClasses as $class) {
                    $students = Student::class($rawTeacher[2], $class)->get();
                    foreach ($students as $student) {
                        $student->teacher = $rawTeacher[1];
                        $student->save();
                    }
                }
            }
        }

        return redirect()->route('home');
    }

    private function validateRequest(){

        return request()->validate([
            'studentList' => 'required|mimes:txt,csv',
            'groupList' => 'required|mimes:txt,csv',
            'teacherList' => 'required|mimes:txt,csv'
        ]);
    }


}
