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
    <h1>Datensatz für {{$student->name}} {{$student->surname}}</h1>
</div>


<div class="container">
    <form action="{{route('entry.next', ['discipline'=>$discipline, 'group'=>$group, 'student'=>$i])}}" method="POST" enctype="multipart/form-data">
        <div class="form-row my-5">
            <div class="col-10">
                <input type="text" class="form-control" placeholder="Wert" name="value">
            </div>
            <div class="col-2">
                <input type="text" class="form-control" value="{{$discipline->unit}}" disabled>
            </div>
        </div>

        <div class="container">
            <button type="submit" class="btn btn-primary btn-lg btn-block fixed-bottom py-3">Nächster Schüler</a>
        </div>
        @csrf
    </form>
</div>


