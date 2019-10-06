@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modus</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Modus wählen</h1>
</div>


<div class="container">
    <div class="card-deck text-center py-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Suche nach Schüler</h5>
                <a href="/home" class="btn btn-success">Suchen!</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Suche nach Disziplin</h5>
                <a href="{{route('stats.searchdis')}}" class="btn btn-success">Suchen!</a>
            </div>
        </div>

    </div>
</div>
