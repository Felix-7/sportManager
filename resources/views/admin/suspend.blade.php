@extends('layouts.layout')

<div class="jumbotron">
    <h1 class="display-4">Aber hallo! Der Account von {{$teacher->name}} wurde erfolgreich suspendiert.</h1>
    <p class="lead">Der Account kann im ACCOUNT-Panel bei Bedarf erneut aktiviert werden.</p>
    <hr class="my-4">
    <p>Aufgenommene Sportdaten der Gruppen dieses Lehrers sind weiterhin im Statistik-Bereich verfügbar.</p>
    <a class="btn btn-primary btn-lg" href="{{route('home')}}" role="button">Zurück zur Startseite</a>
</div>