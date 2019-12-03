@extends('layouts.layout')

<div class="title text-center">
    <h1>{{$discipline->name}}, Stand {{Carbon\Carbon::now()->format('d.m.Y')}}</h1>
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