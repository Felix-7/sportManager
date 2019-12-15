@extends('layouts.layout')

<div class="title text-center">
    <h1>{{$discipline->name}}, Stand {{Carbon\Carbon::now()->format('d.m.Y')}}</h1>
</div>

<table class="table table-striped table-bordered" cellspacing="0" cellpadding="1" border="1">
    <thead>
        <tr>
            <th style="text-align:center" scope="col">Name</th>
            <th style="text-align:center" scope="col">Wert</th>
            <th style="text-align:center" scope="col">Klasse</th>
            <th style="text-align:center" scope="col">Alter</th>
            <th style="text-align:center" scope="col">Datum</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderedResult as $value)
        <tr>
            <td style="text-align:center">{{$value->student->name}} {{$value->student->surname}}</td>
            <td style="text-align:center">{{$value->value}} {{$discipline->unit}}</td>
            <td style="text-align:center">{{$value->class}}</td>
            <td style="text-align:center">{{$value->age}}</td>
            <td style="text-align:center">{{date('d.m.Y', strtotime($value->datetime))}}</td>
        </tr>
    @endforeach
    </tbody>
</table>