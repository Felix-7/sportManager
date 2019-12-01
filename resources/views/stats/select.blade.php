@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modus</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Modus wählen</h1>
</div>


<div class="container">
    @if($last == true)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Letzte Messung</h5>
            <a href="{{route('stats.downloadLatest')}}" class="btn btn-success"> PDF herunterladen </a>
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Hall of Fame</h5>
            <a href="{{route('stats.discipline', ['mode' => 1])}}" class="btn btn-success">Fortfahren</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bestehendes Schuljahr</h5>
            <a href="{{route('stats.discipline', ['mode' => 2])}}" class="btn btn-success">Fortfahren</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Ober-/ Unterstufe</h5>
            <a href="{{route('stats.discipline', ['mode' => 3])}}" class="btn btn-success">Fortfahren</a>
        </div>
    </div>
</div>
