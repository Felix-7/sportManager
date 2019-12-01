<?php

namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ListUploadController extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest();
        $request->studentList->storeAs('studentLists', 'students.txt');
        $request->groupList->storeAs('studentLists', 'groups.txt');
        $request->teacherList->storeAs('studentLists', 'teachers.txt');

        $file = fopen('../storage/app/studentLists/students.txt', 'r') or exit("Datei konnte nicht geöffnet werden!");
        $this->remove_utf8_bom($file);
        while(!feof($file)) {
            $rawStudent = explode(';', fgets($file));
            if(count($rawStudent) == 6){
                $rawStudent[5] = str_replace(array("\r", "\n"), "", $rawStudent[5]);
                Student::updateOrCreate([
                    'skn' => $rawStudent[1]
                ], [
                    'name' => $rawStudent[3],
                    'surname' => $rawStudent[2],
                    'cur_class' => $rawStudent[0],
                    'gender' => $rawStudent[4],
                    'birth' => $rawStudent[5],
                    'active' => true,
                ]);
            }
        }
        fclose($file);

        $file = fopen('../storage/app/studentLists/groups.txt','r') or exit("Datei konnte nicht geöffnet werden!");
        $this->remove_utf8_bom($file);

        //RESET GROUPS
        $students = Student::all();
        foreach($students as $student){
            $student->group = null;
            $student->save;
        }

        //NEW GROUPS HERE
        while(!feof($file)){
            $rawGroup = explode(';', fgets($file));
            if(count($rawGroup) > 4) {
                $student = Student::where('skn', '=', (string) $rawGroup[0])->first();
                if(!empty($student)) {
                    $student->group = $rawGroup[4];
                    $student->save();
                }
            }
        }

        $file = fopen('../storage/app/studentLists/teachers.txt','r') or exit("Datei konnte nicht geöffnet werden!");
        $this->remove_utf8_bom($file);
        // PREPARE ARRAY FOR COLLECTING RANDOMIZED PASSWORDS:
        $login_data=[];
        $i = 0;
        while(!feof($file)){
            $rawTeacher = explode(';', fgets($file));
            if(array_key_exists(3, $rawTeacher) == true) {
                $rawClasses = explode(',', $rawTeacher[3]);

                foreach ($rawClasses as $class) {
                    $students = Student::class($rawTeacher[2], $class)->get();
                    foreach ($students as $student) {
                        $student->teacher = $rawTeacher[1];
                        $student->save();
                    }
                }

                //REGISTER NEW TEACHERS

                if(Teacher::where('name', '=', $rawTeacher[1])->get()->count() == 0){
                    $firstPass = Str::random(8);
                    $login_data[$i][0] =  strtolower($rawTeacher[1]) . '@gymgmunden.at';
                    $login_data[$i++][1] = $firstPass;
                    Teacher::generateTeacher($rawTeacher[1], $firstPass);
                }
            }
        }
        $pdf = PDF::loadView('auth.passwordpdf', compact('login_data'));
        return $pdf->download('passwords.pdf');
    }

    private function validateRequest(){

        return request()->validate([
            'studentList' => 'required|mimes:txt,csv',
            'groupList' => 'required|mimes:txt,csv',
            'teacherList' => 'required|mimes:txt,csv'
        ]);
    }

    //STACKOVERFLOW, REMOVE BOM!
    private function remove_utf8_bom($text)
    {
        $bom = pack('H*','EFBBBF');
        $text = preg_replace("/^$bom/", '', $text);
        return $text;
    }


}
