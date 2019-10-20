@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('disciplines.index')}}">Disziplinen</a></li>
        <li class="breadcrumb-item"><a href="{{route('disciplines.show', ['discipline'=>$discipline])}}">{{$discipline->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$group}}</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Übersicht</h1>
</div>

<div class="container text-center">

    @if($lastDate > 0)
    <p>Zuletzt durchgeführt am {{$lastDate}} </p>
    @else
        <p>Keine aufgezeichneten Daten</p>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Reihenfolge</th>
        </tr>
        </thead>
        @foreach($studentList as $key => $student)
            <tr>
                <td>{{$student->name}} {{$student->surname}}</td>
                <td>{{$key+1}}</td>
            </tr>
        @endforeach

    </table>

    <a href="{{route('entry.next', ['discipline'=>$discipline, 'group'=>$group, 'i'=>-1, 'skipFlag' =>0])}}" class="btn btn-success">Start</a>
</div>
<footer>
    <div class="container">
        <a href="{{route('disciplines.show', ['discipline' => $discipline])}}" class="btn btn-info fixed-bottom btn-lg btn-block py-3">Zurück</a>
    </div>
</footer>