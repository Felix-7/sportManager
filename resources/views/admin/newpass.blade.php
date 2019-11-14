@extends('layouts.layout')

<div class="jumbotron">
    <h1 class="display-4">Aber hallo! Das Passwort von {{$teacher->name}} wurde erfolgreich zurückgesetzt.</h1>
    <p class="lead">Das neue Passwort lautet: {{$newPass}}</p>
    <hr class="my-4">
    <p>{{$teacher->name}} wird automatisch aufgefordert, sein Passwort beim nächsten Log-In zu ändern. Bitte vergessen Sie nicht, das neue Passwort zu notieren.</p>
    <a class="btn btn-primary btn-lg" href="{{route('home')}}" role="button">Zurück zur Startseite</a>
</div>