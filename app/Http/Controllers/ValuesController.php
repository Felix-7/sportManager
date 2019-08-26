<?php

namespace App\Http\Controllers;

use App\Student;
use App\Value;
use Illuminate\Http\Request;

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

        return redirect()->route('home'); 

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
