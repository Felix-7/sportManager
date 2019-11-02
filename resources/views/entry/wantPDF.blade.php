@extends('layouts.layout')

<div class="title text-center py-3">
    <h1>Daten erfolgreich hochgeladen.</h1>
</div>
<p class="text-center">Wünschen Sie einen PDF-Download?</p>
<hr width="80%">
<a href="{{route('stats.downloadLatest')}}" class="btn btn-primary py-5 btn-lg btn-block">Ja, PDF herunterladen </a>
<hr width="80%">
<a href="{{route('home')}}" class="btn btn-secondary py-5 btn-lg btn-block">Nein, zur Startseite </a>