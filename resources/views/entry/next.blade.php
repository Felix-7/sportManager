@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Disziplinen</li>
        <li class="breadcrumb-item">{{$discipline->name}}</li>
        <li class="breadcrumb-item">{{$group}}</li>
        <li class="breadcrumb-item active" aria-current="page">{{$student->name}} {{$student->surname}}</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>