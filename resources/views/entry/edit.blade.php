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

<div class="title text-center">
    <h1>Datensatz für {{$student->name}} {{$student->surname}} ändern</h1>
</div>

<div class="container">
    <form action="{{route('entry.next', ['discipline'=>$discipline, 'group'=>$group, 'student'=>$i, 'skipFlag'=>1])}}" method="POST" enctype="multipart/form-data">
        @include('entry.form')
        <div class="container">
            <button type="submit" class="btn btn-primary btn-lg btn-block fixed-bottom py-3">Änderungen bestätigen</button>
        </div>
    </form>
</div>