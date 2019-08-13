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
        <th scope="col">WERT</th>
        <th scope="col">Steigerung</th>
        <th scope="col">Edit</th>
    </thead>
    <tbody>
    @foreach($studentList as $student)
        <tr>
            <td>{{$student->name}} {{$student->surname}}</td>
            <td>@if(is_null($student->tempValue)) N/A @else{{$student->tempValue}}{{$discipline->unit}}@endif</td>
            <td>LETZTER</td>
            <td>EDIT</td>
        </tr>
    @endforeach
    </tbody>
</table>



<div class="container">
    <a href="{{route('home')}}" role="button" class="btn btn-success btn-lg btn-block fixed-bottom py-3">Daten bestätigen</a>
</div>