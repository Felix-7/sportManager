<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Student;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function search()
    {
        $disciplines = Discipline::all();
        $groups = Student::select('group')->whereNotNull('group')->groupBy('group')->get();
        return view('stats.select', compact('disciplines', 'groups'));
    }

    public function deliver(Request $request)
    {
        dd("hi");
    }
}
