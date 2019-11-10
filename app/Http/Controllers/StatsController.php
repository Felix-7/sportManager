<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Student;
use App\Value;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StatsController extends Controller
{
    public function downloadPDF($discipline_id, $mode, $gender, $useAge, $age, $class, $limit, $upper)
    {
        if($mode == 2) $result = $this->getDetailResult($discipline_id, $gender, $useAge, $age, $class, true);
        else if($mode == 3) $result = $this->getUpperLower($upper, $discipline_id, $gender);
        else $result = $this->getDetailResult($discipline_id, $gender, $useAge, $age, $class, false);
        $discipline = Discipline::where('id', '=', $discipline_id)->first();
        $orderedResult = $this->orderScores($result, $discipline_id);
        $orderedResult = $this->limitEntries($orderedResult, $limit);
        $pdf = PDF::loadView('pdf', compact('orderedResult', 'discipline'));
        return $pdf->download('result.pdf');

    }

    public function downloadLatestPDF()
    {
        return Storage::download('latest/' . Auth::User()->name . '_LAST_RESULT.pdf');
    }

    public function searchByDiscipline($mode)
    {
        $disciplines = Discipline::all();
        $groups = Student::select('group')->whereNotNull('group')->groupBy('group')->get();
        return view('stats.searchdis', compact('disciplines', 'groups', 'mode'));
    }

    public function deliver()
    {
        $useAge = 0; $age = -1; $class = -1; // TO GIVE A MODULAR DESIGN, THESE VARIABLES NEED TO BE DEFINED

        $search = (object) $this->validateRequest();
        $mode = $search->mode;
        $gender = $search->gender;
        $discipline = Discipline::all()
            ->where('id', '=', $search->discipline_id)->first();
        $limit = $search->limit;

        //HALL OF FAME
        if($mode == 1){
            $result = Value::all()
                ->where('discipline_id', '=', $search->discipline_id)
                ->load('student')
                ->where('student.gender', '=', $search->gender);
            $orderedResult = $this->orderScores($result, $search->discipline_id);
            $orderedResult = $this->limitEntries($orderedResult, $limit);
            $upper = -1;
            return view('stats.halloffame', compact('orderedResult', 'discipline', 'mode', 'gender', 'limit', 'upper'));
        }

        //CURRENT SCHOOL YEAR
        if($mode == 2){
            $schoolyear = $this->getSchoolYear();
            $upper = -1;

            $result = Value::all()
                ->where('discipline_id', '=', $search->discipline_id)
                ->load('student')
                ->where('student.gender', '=', $search->gender)
                ->where('created_at', '>', $schoolyear);
            $orderedResult = $this->orderScores($result, $search->discipline_id);
            $orderedResult = $this->limitEntries($orderedResult, $limit);

            return view('stats.halloffame', compact('orderedResult', 'discipline', 'mode', 'gender', 'limit', 'upper'));

        }

        //LOWER / HIGHER SCHOOL
        if($mode == 3){
            $upper = $search->upper;

            $result = $this->getUpperLower($upper, $search->discipline_id, $gender);
            $orderedResult = $this->orderScores($result, $search->discipline_id);
            $orderedResult = $this->limitEntries($orderedResult, $limit);

            return view('stats.summary', compact('orderedResult', 'discipline', 'mode', 'gender', 'useAge', 'age', 'class', 'limit', 'upper'));

        }
        return view('home'); //IN CASE THERE HAPPENS SOMETHING TO THE MODE-PARAM
    }

    public function selection()
    {
        if(Storage::exists('latest/' . Auth::User()->name . '_LAST_RESULT.pdf') == true) $last = true;
        else $last = false;
        return view('stats.select', compact('last'));
    }

    public function deliverDetail(Request $request){
        $search = (object) $this->validateDetailedRequest();
        $mode = $search->mode;
        $gender = $search->gender;
        $useAge = $search->useAge;
        $class = $search->class;
        $age = $search->age;
        $limit = $search->limit;
        $discipline = Discipline::where('id', '=', $search->discipline_id)->first();

        $upper = -1; //NEEDED NOT IN THIS MODE, BUT IN ANOTHER --> PDF GENERATION!


        //HALL OF FAME
        if($mode == 1){
            $result = $this->getDetailResult($discipline->id, $gender, $useAge, $age, $class, false);
            $orderedResult = $this->orderScores($result, $search->discipline_id);
            $orderedResult = $this->limitEntries($orderedResult, $limit);
            return view('stats.summary', compact('orderedResult', 'discipline', 'mode', 'gender', 'useAge', 'age', 'class', 'limit', 'upper'));
        }

        //CURRENT SCHOOL YEAR
        if($mode == 2){
            $result = $this->getDetailResult($discipline->id, $gender, $useAge, $age, $class, true);
            $orderedResult = $this->orderScores($result, $search->discipline_id);
            $orderedResult = $this->limitEntries($orderedResult, $limit);
            return view('stats.summary', compact('orderedResult', 'discipline', 'mode', 'gender', 'useAge', 'age', 'class', 'limit', 'upper'));
        }

    }

    public function detailSearch(Request $request){
        $gender = $request->gender;
        $useAge = $request->useAge;
        $mode = $request->mode;
        $discipline_id = $request->discipline_id;
        $limit = $request->limit;

        return view('stats.searchdet', compact('useAge', 'mode', 'discipline_id', 'gender', 'limit'));
    }

    private function validateRequest(){

        return request()->validate([
            'discipline_id' => 'required',
            'gender' => 'required',
            'mode' => 'required',
            'upper' => 'required',
            'limit' => 'required'
        ]);
    }

    private function validateDetailedRequest(){

        return request()->validate([
            'gender' => 'required',
            'limit' => 'required',
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

    private function getDetailResult($discipline_id, $gender, $useAge, $age, $class, $useDate)
    {

        //IF NOT DATE RESTRICTED
        if ($useDate == false) {
            //SORT BY AGE

            if ($useAge == 1) {
                $result = Value::where('discipline_id', '=', $discipline_id)
                    ->where('age', '<=', $age)
                    ->get();
            } //SORT BY CLASS
            else {
                $result = Value::where('class', 'like', '%' . $class . '%')
                    ->where('discipline_id', '=', $discipline_id)
                    ->with('student')
                    ->whereHas('student', function ($q) use ($gender) {
                        $q->where('gender', $gender);
                    })->get();
            }
            return $result;
        }

        //IF DATE RESTRICTED
        else {
            $schoolyear = $this->getSchoolYear();
            //SORT BY AGE
            if ($useAge == 1) {
                $result = Value::query()
                    ->where('created_at', '>', $schoolyear)
                    ->where('discipline_id', '=', $discipline_id)
                    ->where('age', '<=', $age)
                    ->get();
            } //SORT BY CLASS
            else {
                $result = Value::where('class', 'like', '%' . $class . '%')->where('discipline_id', '=', $discipline_id)
                    ->with('student')
                    ->whereHas('student', function ($q) use ($gender) {
                        $q->where('gender', $gender);
                    })
                    ->where('created_at', '>', $schoolyear)
                    ->get();
            }
            return $result;
        }
    }

    private function getUpperLower($upper, $discipline_id, $gender){
        if($upper == 1) $gap = ">"; //HIGHER
        else $gap = "<="; //LOWER

        $result = Value::where('class', $gap, '4')
            ->where('discipline_id', '=', $discipline_id)
            ->with('student')
            ->whereHas('student', function($q) use($gender){
                $q->where('gender', $gender);
            })->get();

        return $result;
    }

    private function getSchoolYear(){
        $month = Carbon::now()->format('m');
        if($month >= 9)
            $year = Carbon::now()->format('Y')+1;
        else $year = Carbon::now()->format('Y')-1;
        return new Carbon($year . '-09-01 00:00:00');
    }

    private function limitEntries($orderedResult, $limit){
        if($limit > 0){
            $orderedResult = $orderedResult->slice(0, $limit);
        }
        return $orderedResult;
    }

}
