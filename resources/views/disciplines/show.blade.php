@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('disciplines.index')}}">Disziplinen</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$discipline->name}}</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="col-12 text-center py-3">
    <h1>Gruppe für {{$discipline->name}} wählen</h1>
</div>




<div class="container">
    <a href="/disciplines/{{$discipline->id}}/edit" role="button" class="btn btn-warning btn-lg btn-block fixed-bottom py-3">Disziplin bearbeiten</a>
</div>