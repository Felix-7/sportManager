@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('stats.select')}}">Modus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ergebnis</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Suche verfeinern:</h1>
</div>
<div class="container">
    <form action="{{route('stats.detail')}}" method="POST">
        <input type="hidden" name="mode" value="{{$mode}}">
        <input type="hidden" name="discipline_id" value="{{$discipline->id}}">
        <input type="hidden" name="gender" value="{{$gender}}">
        <div class="form-row my-3">
            <div class="col-6">
                <button type="submit" name="useAge" value="1" class="btn btn-secondary btn-lg btn-block" >Alter</button>
            </div>
            <div class="col-6">
                <button type="submit" name="useAge" value="0" class="btn btn-secondary btn-lg btn-block" >Schulstufe</button>
            </div>
        </div>

        @csrf
    </form>
</div>
<div class="title text-center">
    <h1>Alle Ergebnisse:</h1>
</div>

<table class="table">
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



