@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('stats.select')}}">Modus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ergebnis</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Alle Ergebnisse:</h1>
</div>

<table class="table table-bordered col-12">
    <thead>
    <th scope="col">Name</th>
    <th scope="col">Wert</th>
    </thead>
    <tbody>
    @foreach($orderedResult as $student)
        <tr>
            <td>{{$student->student->name}} {{$student->student->surname}}</td>
            <td>{{$student->value}} {{$discipline->unit}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="container text-center">
    <a href="{{route('stats.download', ['discipline_id' => $discipline->id, 'mode' => $mode, 'gender' => $gender, 'useAge' => $useAge, 'age' => $age, 'class' => $class, 'limit' => $limit, 'upper' => $upper])}}" class="btn btn-success ">PDF herunterladen</a>
</div>