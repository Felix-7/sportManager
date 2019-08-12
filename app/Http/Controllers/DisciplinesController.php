<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Student;
use Illuminate\Http\Request;

class DisciplinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplines = Discipline::all();

        return view('disciplines.index', compact('disciplines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discipline = new Discipline();
        return view('disciplines.create', compact('discipline'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $discipline = Discipline::create($this->validateRequest());


        return redirect('disciplines');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function show(Discipline $discipline)
    {
        $groups = Student::select('group')->groupBy('group')->get();

        return view('disciplines.show', compact('discipline', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function edit(Discipline $discipline)
    {
        return view('disciplines.edit', compact('discipline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function update(Discipline $discipline)
    {
        $discipline->update($this->validateRequest());

        return redirect('disciplines/' . $discipline->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discipline $discipline)
    {
        //
    }

    private function validateRequest(){

        return request()->validate([
            'name' => 'required|min:3',
            'unit' => 'required',
            'active' => 'required',
            'best_high' => 'required',
        ]);
    }
}
