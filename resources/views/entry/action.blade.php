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

    <div class="container">
        Hier befindet sich später eine Übersicht der Schülergruppe, des zuständigen Lehrers und evt. der letzte Durchlauf dieser Disziplin. !ToDo!
        <a href="{{route('entry.next', ['discipline'=>$discipline, 'group'=>$group, 'student'=>1])}}" class="btn btn-success">Start</a>
    </div>

</div>