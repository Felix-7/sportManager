@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Disziplinen</li>
        <li class="breadcrumb-item">{{$discipline->name}}</li>
        <li class="breadcrumb-item">{{$group}}</li>
        <li class="breadcrumb-item active" aria-current="page">Zusammenfassung</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>


<table class="table">
    <thead>
        <th scope="col">Name</th>
        <th scope="col">Wert</th>
        <th scope="col">Letzter Wert</th>
        <th scope="col">Edit</th>
    </thead>
    <tbody>
    @foreach($studentList as $key => $student)
        <tr>
            <td>{{$student->name}} {{$student->surname}}</td>
            <td>@if(is_null($student->tempValue)) N/A @else{{$student->tempValue}} {{$discipline->unit}}@endif</td>
            <td>@if($lastResults[$key] == -1) N/A @else{{$lastResults[$key]}} {{$discipline->unit}}@endif</td>
            <td><a href="{{route('entry.edit', ['discipline' => $discipline, 'group' => $group, 'i' => $key])}}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="container">
    <form action="{{route('entry.store', ['group'=>$group, 'discipline'=>$discipline->id])}}" method="POST" enctype="multipart/form-data">

        @foreach($studentList as $key => $student)
            <input type="hidden" name="e{{$key}}" value="{{$student->tempValue}}">
        @endforeach

        <button type="submit" class="btn btn-success btn-lg btn-block fixed-bottom py-3">Daten bestätigen</button>
        @csrf
    </form>
</div>
