<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Discipline;
use App\Student;
use App\Value;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $disciplineId, string $group)
    {
        $studentCount = Student::students($group)->get()->count();

        for($i = 0; $i < $studentCount; $i++){
            $getCur = "e" . $i;

            if($request->$getCur != null){
                Value::generateValue($request->$getCur, $group, $i, $disciplineId);
            }
        }

        $result = Value::where('created_at', '>', (Carbon::now()->subSeconds(30)->toDateTimeString()))
            ->where('teacher_id', '=', \Auth::user()->id)
            ->with('student')
            ->get();

        $orderedResult = $this->orderScores($result, $disciplineId);
        $discipline = Discipline::where('id', '=', $disciplineId)->first();

        $pdf = PDF::loadView('pdf', compact('orderedResult', 'discipline'));
        Storage::put('latest/' . Auth::User()->name . '_LAST_RESULT.pdf', $pdf->output());

        $pdf->download();

        return view('entry.wantPDF');

    }

    private function orderScores($valueInput, $discipline_id){

        $best_high = Discipline::where('id', '=', $discipline_id)->first()->best_high;
        if($best_high == 1) $ordered = $valueInput->sortByDesc('value');
        else if($best_high == 0) $ordered = $valueInput->sortBy('value');
        else $ordered = "ERROR";
        return $ordered;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function show(Value $value)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function edit(Value $value)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Value $value)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Value  $value
     * @return \Illuminate\Http\Response
     */
    public function destroy(Value $value)
    {
        //
    }
}
