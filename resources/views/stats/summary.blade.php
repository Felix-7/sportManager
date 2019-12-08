@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('stats.select')}}">Modus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ergebnis</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Alle Ergebnisse:</h1>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Wert</th>
            <th scope="col">Klasse</th>
            <th scope="col">Alter</th>
            <th scope="col">Datum</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderedResult as $value)
        <tr>
            <td>{{$value->student->name}} {{$value->student->surname}}</td>
            <td>{{$value->value}} {{$discipline->unit}}</td>
            <td>{{$value->class}}</td>
            <td>{{$value->age}}</td>
            <td>{{date('d.m.Y', strtotime($value->datetime))}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="container text-center">
    <a href="{{route('stats.download', ['discipline_id' => $discipline->id, 'mode' => $mode, 'gender' => $gender, 'useAge' => $useAge, 'age' => $age, 'class' => $class, 'limit' => $limit, 'upper' => $upper])}}" class="btn btn-success ">PDF herunterladen</a>
</div>